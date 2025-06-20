<?php
error_reporting(E_ALL & ~E_DEPRECATED);

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require 'vendor/autoload.php';

class CommentServer implements MessageComponentInterface {
    protected $clients;
    protected $clientsBlogMap; // Maps clients to their blog IDs
    protected $pdo;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->clientsBlogMap = [];
        
        try {
            // Add error mode for better error handling
            $this->pdo = new \PDO(
                "mysql:host=127.0.0.1;dbname=ohfwebsite", 
                "root", 
                "",
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );
            echo "Database connection established\n";
            
            // Ensure the reply_comments table exists with parent_reply_id field
            $this->ensureReplyCommentsTable();
        } catch (\PDOException $e) {
            echo "Database connection failed: " . $e->getMessage() . "\n";
        }
    }
    
    // Create/update reply_comments table with parent_reply_id field
    private function ensureReplyCommentsTable() {
        try {
            // First check if the table exists
            $tableExists = $this->pdo->query("SHOW TABLES LIKE 'reply_comments'")->rowCount() > 0;
            
            if (!$tableExists) {
                // Create the table with parent_reply_id field
                $this->pdo->exec("
                    CREATE TABLE IF NOT EXISTS reply_comments (
                        reply_id VARCHAR(36) PRIMARY KEY,
                        parent_comment_id VARCHAR(36) NOT NULL,
                        parent_reply_id VARCHAR(36) NULL,
                        blogId VARCHAR(255) NOT NULL,
                        name VARCHAR(255) NOT NULL,
                        email VARCHAR(255),
                        message TEXT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (parent_comment_id) REFERENCES comments(comment_id) ON DELETE CASCADE
                    )
                ");
                echo "Reply comments table created with parent_reply_id field\n";
            } else {
                // Check if parent_reply_id column exists
                $columnExists = $this->pdo->query("SHOW COLUMNS FROM reply_comments LIKE 'parent_reply_id'")->rowCount() > 0;
                
                if (!$columnExists) {
                    // Add the parent_reply_id column
                    $this->pdo->exec("ALTER TABLE reply_comments ADD COLUMN parent_reply_id VARCHAR(36) NULL AFTER parent_comment_id");
                    echo "Added parent_reply_id column to reply_comments table\n";
                }
            }
        } catch (\PDOException $e) {
            echo "Error ensuring reply_comments table structure: " . $e->getMessage() . "\n";
        }
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
        
        // We'll handle blog ID association when the client sends their first message
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        if (!$data) {
            echo "Received invalid JSON\n";
            return;
        }

        echo "Received message: " . $msg . "\n";

        // If this is a message with a blogId, associate this client with that blog
        if (isset($data['blogId'])) {
            $this->clientsBlogMap[$from->resourceId] = $data['blogId'];
            
            // If this appears to be an initialization message (no type or just blogId)
            if (!isset($data['type']) || (isset($data['type']) && $data['type'] === 'init')) {
                echo "Client {$from->resourceId} associated with blog {$data['blogId']}\n";
                
                // Send existing comments and replies for this blog
                $this->sendInitialCommentsAndReplies($from, $data['blogId']);
                return;
            }
        }

        // Handle different message types
        if (isset($data['type'])) {
            switch ($data['type']) {
                case 'comment':
                    $this->handleNewComment($from, $data);
                    break;
                    
                case 'reply':
                    $this->handleNewReply($from, $data);
                    break;
                    
                default:
                    echo "Unknown message type: {$data['type']}\n";
            }
        }
    }
    
    private function sendInitialCommentsAndReplies(ConnectionInterface $conn, $blogId) {
        try {
            // Get all comments for this blog
            $stmt = $this->pdo->prepare("
                SELECT * FROM comments 
                WHERE blog_id = :blogId 
                ORDER BY created_at ASC
            ");
            $stmt->execute(['blogId' => $blogId]);
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Get all replies for this blog
            $stmt = $this->pdo->prepare("
                SELECT r.* FROM reply_comments r
                JOIN comments c ON r.parent_comment_id = c.comment_id
                WHERE c.blog_id = :blogId
                ORDER BY r.created_at ASC
            ");
            $stmt->execute(['blogId' => $blogId]);
            $replies = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Send both comments and replies
            $conn->send(json_encode([
                'type' => 'initial_comments',
                'blogId' => $blogId,
                'comments' => $comments,
                'replies' => $replies
            ]));
            
            echo "Sent " . count($comments) . " comments and " . count($replies) . " replies to client {$conn->resourceId}\n";
        } catch (\PDOException $e) {
            echo "Database error: " . $e->getMessage() . "\n";
            $conn->send(json_encode([
                'type' => 'error',
                'message' => 'Failed to load comments'
            ]));
        }
    }
    
    private function handleNewComment(ConnectionInterface $from, $data) {
        if (!isset($data['blogId']) || !isset($data['name']) || !isset($data['message'])) {
            echo "Missing required fields for comment\n";
            return;
        }
        
        try {
            $comment_id = bin2hex(random_bytes(6));
            $currentTime = date('Y-m-d H:i:s');
            
            // Save the comment to the database with timestamp
            $stmt = $this->pdo->prepare(
                "INSERT INTO comments (comment_id, blog_id, name, email, website, message, created_at) 
                 VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->execute([
                $comment_id, 
                $data['blogId'], 
                $data['name'], 
                $data['email'] ?? '', 
                $data['website'] ?? '',
                $data['message'],
                $currentTime
            ]);
            
            echo "Comment saved to database\n";
            
            // Create the response with all needed fields
            $commentData = [
                'type' => 'new_comment',
                'comment_id' => $comment_id,
                'blogId' => $data['blogId'],
                'name' => $data['name'],
                'email' => $data['email'] ?? '',
                'website' => $data['website'] ?? '',
                'message' => $data['message'],
                'created_at' => $currentTime
            ];

            // Broadcast the new comment to all clients connected to the same blogId
            $this->broadcastToBlog($data['blogId'], $commentData);
        } catch (\Exception $e) {
            echo "Error saving comment: " . $e->getMessage() . "\n";
            $from->send(json_encode([
                'type' => 'error',
                'message' => 'Failed to save comment'
            ]));
        }
    }
    
    private function handleNewReply(ConnectionInterface $from, $data) {
        if (!isset($data['blogId']) || !isset($data['parent_comment_id']) || 
            !isset($data['name']) || !isset($data['email']) || !isset($data['message'])) {
            echo "Missing required fields for reply\n";
            return;
        }
        
        try {
            // Verify the parent comment exists
            $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE comment_id = ? AND blog_id = ?");
            $stmt->execute([$data['parent_comment_id'], $data['blogId']]);
            $parentComment = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$parentComment) {
                echo "Parent comment not found\n";
                $from->send(json_encode([
                    'type' => 'error',
                    'message' => 'Parent comment not found'
                ]));
                return;
            }
            
            // Check if this is a reply to another reply
            if (isset($data['parent_reply_id']) && $data['parent_reply_id']) {
                // Verify the parent reply exists
                $stmt = $this->pdo->prepare("SELECT * FROM reply_comments WHERE reply_id = ? AND parent_comment_id = ?");
                $stmt->execute([$data['parent_reply_id'], $data['parent_comment_id']]);
                $parentReply = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$parentReply) {
                    echo "Parent reply not found\n";
                    $from->send(json_encode([
                        'type' => 'error',
                        'message' => 'Parent reply not found'
                    ]));
                    return;
                }
            }
            
            $reply_id = bin2hex(random_bytes(6));
            $currentTime = date('Y-m-d H:i:s');
            
            // Save the reply to the database - now including parent_reply_id
            $stmt = $this->pdo->prepare(
                "INSERT INTO reply_comments (reply_id, parent_comment_id, parent_reply_id, blogId, name, email, message, created_at) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->execute([
                $reply_id,
                $data['parent_comment_id'],
                $data['parent_reply_id'] ?? null,
                $data['blogId'],
                $data['name'],
                $data['email'],
                $data['message'],
                $currentTime
            ]);
            
            echo "Reply saved to database\n";
            
            // Create the response with all needed fields
            $replyData = [
                'type' => 'new_reply',
                'reply_id' => $reply_id,
                'parent_comment_id' => $data['parent_comment_id'],
                'parent_reply_id' => $data['parent_reply_id'] ?? null,
                'blogId' => $data['blogId'],
                'name' => $data['name'],
                'email' => $data['email'],
                'message' => $data['message'],
                'created_at' => $currentTime
            ];
            
            // Broadcast the new reply to all clients connected to the same blogId
            $this->broadcastToBlog($data['blogId'], $replyData);
        } catch (\Exception $e) {
            echo "Error saving reply: " . $e->getMessage() . "\n";
            $from->send(json_encode([
                'type' => 'error',
                'message' => 'Failed to save reply: ' . $e->getMessage()
            ]));
        }
    }
    
    // Helper function to broadcast a message to all clients connected to a specific blog
    private function broadcastToBlog($blogId, $data) {
        foreach ($this->clients as $client) {
            $clientBlogId = $this->clientsBlogMap[$client->resourceId] ?? null;
            
            if ($clientBlogId === $blogId) {
                $client->send(json_encode($data));
                echo "Message broadcast to client {$client->resourceId}\n";
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        
        // Clean up the blog mapping
        if (isset($this->clientsBlogMap[$conn->resourceId])) {
            unset($this->clientsBlogMap[$conn->resourceId]);
        }
        
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Setup the server
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new CommentServer()
        )
    ),
    8080
);

echo "Comment WebSocket server started on port 8080\n";
$server->run();