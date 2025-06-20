<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use PDO;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
require 'vendor/autoload.php';

class CommentServer implements MessageComponentInterface {
    protected $clients;
    protected $pdo;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        try {
            // Connect to the database
            $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=ohfwebsite", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to database.\n";
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection: " . $conn->resourceId . "\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Message received";

        // Decode the message
        $data = json_decode($msg, true);
        if (!$data) {
            echo "Invalid JSON received\n";
            return;
        }

        // Save to DB
        try {
            $stmt = $this->pdo->prepare("INSERT INTO comments (name, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$data['name'], $data['email'], $data['message']]);
            echo "Comment saved to DB.\n";
        } catch (PDOException $e) {
            echo "Error saving comment to DB: " . $e->getMessage();
        }

        // Broadcast the comment to all connected clients
        foreach ($this->clients as $client) {
            $client->send(json_encode([
                "name" => $data['name'],
                "message" => $data['message']
            ]));
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection closed: " . $conn->resourceId . "\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
        echo "Error occurred: " . $e->getMessage() . "\n";
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

echo "WebSocket server started...\n";
$server->run();
