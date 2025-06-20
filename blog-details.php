<?php
session_start();
require 'api/Database/DatabaseConn.php'; 

// Get event ID from the URL
$event_id = isset($_GET['id']);
$db = new DatabaseConn();
$dbh = $db->connect();
// Check if the event exists

try {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("Invalid event ID.");
    }

    $eventId = $_GET['id']; 

    // Prepare query
    $query = "SELECT * FROM blog_posts WHERE blog_id = :id LIMIT 1";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $eventId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $blog = $stmt->fetch(PDO::FETCH_ASSOC);

        $blogName = htmlspecialchars($blog['blog_title']);
        $description = htmlspecialchars($blog['blog_description']);
        $category = htmlspecialchars($blog['category']);
        $body = htmlspecialchars($blog['body']);
        $date = date("M j, Y", strtotime($blog['published_at']));
        $image = !empty($blog['image']) ? "uploads/" . htmlspecialchars($blog['image']) : "assets/img/donate/donation2-1.png";
        $blogid = htmlspecialchars($blog['blog_id']);
      
    } else {
        throw new Exception("Blog not found.");
    }

    $query = "SELECT * FROM blog_images WHERE blog_id = :blog_id";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':blog_id', $eventId);
    $stmt->execute();
    
    $blog_images = [];
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $blog_images[] = [
                'img_path' => "uploads/" . htmlspecialchars($row['img_path']),
                'caption' => htmlspecialchars($row['caption'])
            ];
        }
        // Shuffle the images for random placement
        shuffle($blog_images);
    }
} catch (Exception $e) {
    die("<p>Error: " . $e->getMessage() . "</p>");
}
?>

<?php

    $page_title = "Ogeri Health Foundation - Blog Details";

    $page_author = "Olayinka!";

    $page_description = "";

    $page_rel = '';

    $page_name = 'Blog Details';

    $customs = array(
                "stylesheets" => ["assets/css/demo.css"],
                "scripts" => ["assets/js/demo.js"]
               );

    $addons = array(
                "stylesheets" => ["https://some-external-url.css"],
                "scripts" => ["https://some-external-url.js"]
               );

?>

<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">

<style>
    .nested-replies{
        margin-left: 5px;
    }

    @media (max-width: 789px){
        .nested-replies{
        margin-left: 0;
    }

   
    }

    .blog-gallery-item img{
        height: 10px;
    }
</style>

<head>
    <?php include 'include/head.php'; ?>
   

</head>

<body>

    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->


    <!--********************************
   		Code Start From Here 
	******************************** -->

    <?php include 'include/header.php'; ?>


    <!--==============================
    Breadcumb
============================== -->
<div class="breadcumb-wrapper " data-bg-src="assets/img/about/hero-img.png" data-overlay="theme">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Blog Details</h1>
            <ul class="breadcumb-menu">
                <li><a href="index.php">Home</a></li>
                <li>blog Details</li>
            </ul>
        </div>
    </div>
</div><!--==============================
    Blog Area
==============================-->
    <section class="th-blog-wrapper blog-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-xxl-8 col-lg-7">
                    <div class="th-blog blog-single">
                        <div class="blog-img">
                            <img src="<?= $image ?>" class="w-100" alt="Blog Image">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <a href="blog.php"><i class="fas fa-calendar-days"></i><?= $date ?></a>
                                <a href="blog.php"><i class="fas fa-tags"></i><?= $category ?></a>
                                
                            </div>
                            <h2 class="blog-title"><?= $blogName ?></h2>
                           
                            <blockquote class="bg-white">
    <?php
    // Only proceed with image insertion if we have images
    if (!empty($blog_images)) {
        // Parse the body text into paragraphs (splits on double newlines)
        $paragraphs = preg_split('/\r\n\r\n|\n\n|\r\r/', $body);
        
        // If very few paragraphs but multiple images, we'll need to potentially split paragraphs further
        if (count($paragraphs) < count($blog_images)) {
            $temp_paragraphs = [];
            foreach ($paragraphs as $p) {
                // Split longer paragraphs into sentences
                $sentences = preg_split('/(?<=[.!?])\s+/', $p);
                if (count($sentences) > 3) {
                    // Group sentences into smaller paragraphs (3-4 sentences each)
                    $chunks = array_chunk($sentences, rand(3, 4));
                    foreach ($chunks as $chunk) {
                        $temp_paragraphs[] = implode(' ', $chunk);
                    }
                } else {
                    $temp_paragraphs[] = $p;
                }
            }
            $paragraphs = $temp_paragraphs;
        }
        
        // Determine insertion points, avoiding consecutive insertions
        $total_paragraphs = count($paragraphs);
        $image_count = count($blog_images);
        
        // Create an array of potential insertion points (after which paragraphs to insert images)
        $insertion_points = range(0, $total_paragraphs - 1);
        // Remove first and last paragraph as insertion points to avoid awkward placement
        if ($total_paragraphs > 2) {
            array_shift($insertion_points); // Remove first paragraph
            array_pop($insertion_points);   // Remove last paragraph
        }
        // Shuffle the insertion points for randomness
        shuffle($insertion_points);
        // Take only as many insertion points as we have images
        $insertion_points = array_slice($insertion_points, 0, $image_count);
        // Sort them back in ascending order for proper content flow
        sort($insertion_points);
        
        // Output the content with images
        foreach ($paragraphs as $index => $paragraph) {
            echo "<p>" . nl2br($paragraph) . "</p>";
            
            // If this paragraph index is in our insertion points, add an image
            if (in_array($index, $insertion_points)) {
                // Find which image to insert (find position in insertion_points array)
                $img_pos = array_search($index, $insertion_points);
                if (isset($blog_images[$img_pos])) {
                    $img = $blog_images[$img_pos];
                    echo '<div class="blog-inner-img my-4">';
                    echo '<img src="' . $img['img_path'] . '" alt="Blog Image" class="w-100" style="width: 100%; height: 270px;">';
                    if (!empty($img['caption'])) {
                        echo '<figcaption class="text-center mt-2 fst-italic">' . $img['caption'] . '</figcaption>';
                    }
                    echo '</div>';
                }
            }
        }
        
        // If there are any unused images, add them at the end in a gallery style
        $unused_count = $image_count - count($insertion_points);
        if ($unused_count > 0) {
            echo '<div class="blog-gallery-section mt-4">';
            echo '<div class="row">';
            
            for ($i = count($insertion_points); $i < $image_count; $i++) {
                echo '<div class="col-md-6 mb-4">';
                echo '<div class="blog-gallery-item">';
                echo '<img src="' . $blog_images[$i]['img_path'] . '" alt="Blog Image" class="" style="width: 100%; height: 270px;">';
                if (!empty($blog_images[$i]['caption'])) {
                    echo '<figcaption class="text-center mt-2 fst-italic">' . $blog_images[$i]['caption'] . '</figcaption>';
                }
                echo '</div>';
                echo '</div>';
            }
            
            echo '</div>'; // end row
            echo '</div>'; // end gallery section
        }
    } else {
        // If no images, just display the body text as is
        echo "<p>" . nl2br($body) . "</p>";
    }
    ?>
</blockquote>
                          
                            <!-- <p>We prioritize your security. Our donation process uses the latest encryption technology to protect your personal and financial information. Donate with confidence knowing your data is secure and your contribution is directly benefiting those in need.</p> -->
                            <div class="share-links clearfix ">
                                <div class="row justify-content-between">
                                    <div class="col-md-auto">
                                        <span class="share-links-title">Tags:</span>
                                        <div class="tagcloud">
                                            <a href="blog.php"><?= $category ?></a>
                                            
                                        </div>
                                    </div>
                                    <?php
                                        $eventUrl = "https://" . $_SERVER['HTTP_HOST'] . "/event-details.php?id=" . urlencode($blogid);
                                        $encodedEventUrl = urlencode($eventUrl);
                                    ?>
                                    <div class="col-md-auto text-xl-end">
                                        <span class="share-links-title">Share:</span>
                                        <div class="th-social align-items-center">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $encodedEventUrl ?>" target="_blank">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?url=<?= $encodedEventUrl ?>" target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $encodedEventUrl ?>" target="_blank">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                            <a href="https://api.whatsapp.com/send?text=<?= $encodedEventUrl ?>" target="_blank">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </div>
                                    </div><!-- Share Links Area end -->
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <section class="th-blog-wrapper blog-details space-extra2-bottom">
    <div class="container">
        <div class="">
            <div class="">
                <div class="th-comments-wrap">
                    <h2 class="blog-inner-title h4"><i class="far fa-comments"></i> Comments (<span id="comment-count">0</span>)</h2>
                    <ul class="comment-list" id="comment-list">
                        <!-- Comments will be loaded dynamically here -->
                    </ul>
                </div> <!-- Comment end -->

                <!-- Comment Form -->
                <div class="th-comment-form" data-id="<?= $blogid ?>" id="comment-form">
                    <div class="form-title">
                        <h3 class="blog-inner-title h4 mb-2">Leave a Reply</h3>
                        <p class="form-text">Your email address will not be published. Required fields are marked</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group style-border">
                            <input type="text" id="name" placeholder="Your Name" class="form-control">
                        </div>
                        <div class="col-md-6 form-group style-border">
                            <input type="text" id="email" placeholder="Your Email" class="form-control">
                        </div>
                        <div class="col-12 form-group style-border">
                            <input type="text" id="website" placeholder="Website" class="form-control">
                        </div>
                        <div class="col-12 form-group style-border">
                            <textarea id="message" placeholder="Type Your Message" class="form-control"></textarea>
                        </div>
                        <div class="col-12 form-group mb-0">
                            <button id="submit-comment" class="th-btn btn-fw">SUBMIT COMMENT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                    
                </div>
                
                   
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">
                        <!-- <div class="widget widget_search  ">
                            <form class="search-form">
                                <input type="text" placeholder="Enter Keyword">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget_categories  ">
                            <h3 class="widget_title">Category</h3>
                            <ul>
                                <li>
                                    <a href="blog.php">Donations</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                                <li>
                                    <a href="blog.php">Educations</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                                <li>
                                    <a href="blog.php">Fundraising</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                                <li>
                                    <a href="blog.php">Foods</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                                <li>
                                    <a href="blog.php">Medical Help</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                                <li>
                                    <a href="blog.php">Water Support</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                            </ul>
                        </div> -->
                        <div class="widget">
                            <h3 class="widget_title">Recent Posts</h3>

                            <div class="recent-post-wrap">
                                <?php
                                try {
                                    if (!isset($dbh)) {
                                        throw new Exception("Database connection not found.");
                                    }

                                    // Fetch the three most recent events
                                    $query = "SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC LIMIT 3";
                                    $stmt = $dbh->prepare($query);
                                    $stmt->execute();
                                    if ($stmt->rowCount() > 0) {
                                        while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $eventName = htmlspecialchars($event['blog_title']);
                                            $eventDate = date("F, Y", strtotime($event['published_at']));
                                            $image = !empty($event['image']) ? "uploads/" . htmlspecialchars($event['image']) : "assets/img/default-image.jpg";
                                            $eventid = htmlspecialchars($event['blog_id']);
                                ?>
                                            <div class="recent-post">
                                                <div class="media-img">
                                                    <a href="blog-details.php?id=<?= $eventid ?>">
                                                        <img src="<?= $image ?>" alt="Blog Image" />
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="recent-post-meta">
                                                        <a href="events.php">
                                                            <i class="fas fa-calendar-days"></i> <?= $eventDate ?>
                                                        </a>
                                                    </div>
                                                    <h4 class="post-title">
                                                        <a class="text-inherit" href="event-details.php?id=<?= $eventid ?>">
                                                            <?= $eventName ?>
                                                        </a>
                                                    </h4>
                                                </div>
                                            </div>
                                <?php
                                        }
                                    } else {
                                        echo "<p style='font-size: 1.2rem; font-weight: 600;'>No recent posts available.</p>";
                                    }
                                } catch (Exception $e) {
                                    echo "<p>Error fetching recent posts: " . $e->getMessage() . "</p>";
                                }
                                ?>
                            </div>
                        </div>
                        <!-- <div class="widget widget_tag_cloud  ">
                            <h3 class="widget_title">Popular Tags</h3>
                            <div class="tagcloud">
                                <a href="blog.php">Donations</a>
                                <a href="blog.php">Help</a>
                                <a href="blog.php">Foods</a>
                                <a href="blog.php">Educations</a>
                                <a href="blog.php">Fundraising</a>
                                <a href="blog.php">Tips</a>
                            </div>
                        </div> -->
                    </aside>
                </div>
            </div>
        </div>
    </section>
   <script>
   document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById("comment-form");
    if (!form) {
        console.error("Comment form not found in the document");
        return;
    }
    
    const blogId = form.getAttribute("data-id");
    if (!blogId) {
        console.error("Blog ID not found in the form data-id attribute");
        return;
    }
    
    console.log("Initializing WebSocket for blog:", blogId);
    
    // Track the active reply form to ensure only one is open at a time
    let activeReplyForm = null;
    
    // Store a map of reply IDs to author names for looking up who was replied to
    const authorMap = {};
    
    // Connection status indicator
    const statusIndicator = createStatusIndicator();
    document.body.appendChild(statusIndicator);
    
    // Queue to store the comments/replies if the socket is not open yet
    let messageQueue = [];
    
    // Keep track of reconnection attempts
    let reconnectAttempts = 0;
    const MAX_RECONNECT_ATTEMPTS = 5;
    const RECONNECT_DELAY = 3000; // 3 seconds
    
    // Initialize socket variable
    let socket;

    function initializeWebSocket() {
        console.log("Initializing WebSocket connection...");
        socket = connectWebSocket('wss://websocket-production-db61.up.railway.app');
        return socket;
    }
    
    function connectWebSocket(url) {
        const ws = new WebSocket(url);
        
        ws.onopen = function() {
            console.log("WebSocket connection established");
            // Reset reconnection attempts on successful connection
            reconnectAttempts = 0;
            
            // Update connection status
            updateConnectionStatus(true);
            
            // Send blog ID as the initial message to register this client
            ws.send(JSON.stringify({ blogId, type: 'init' }));
            
            // Send any queued messages
            messageQueue.forEach(message => {
                ws.send(message);
            });
            
            // Clear the queue once the messages are sent
            messageQueue = [];
            
            // Enable submit button once connection is established
            const submitBtn = document.getElementById('submit-comment');
            if (submitBtn) {
                submitBtn.disabled = false;
            }
        };
        
        ws.onclose = function(event) {
            console.log("WebSocket connection closed", event);
            
            // Update connection status
            updateConnectionStatus(false);
            
            // Disable submit button when connection is lost
            const submitBtn = document.getElementById('submit-comment');
            if (submitBtn) {
                submitBtn.disabled = true;
            }
            
            if (!event.wasClean && reconnectAttempts < MAX_RECONNECT_ATTEMPTS) {
                reconnectAttempts++;
                console.log(`Connection died unexpectedly, attempt #${reconnectAttempts} to reconnect in ${RECONNECT_DELAY/1000} seconds`);
                
                setTimeout(() => {
                    console.log("Attempting to reconnect...");
                    socket = connectWebSocket(url);
                }, RECONNECT_DELAY);
            } else if (reconnectAttempts >= MAX_RECONNECT_ATTEMPTS) {
                console.error("Max reconnection attempts reached");
                alert("Connection lost. Please refresh the page to reconnect.");
            }
        };
        
        ws.onerror = function(error) {
            console.error("WebSocket error:", error);
            updateConnectionStatus(false);
        };
        
        ws.onmessage = handleSocketMessage;
        
        return ws;
    }
    
    // Actually initialize the socket - this was the missing call
    socket = initializeWebSocket();
    
    function createStatusIndicator() {
        const indicator = document.createElement('div');
        indicator.id = 'connection-status';
        indicator.style.position = 'fixed';
        indicator.style.bottom = '10px';
        indicator.style.right = '10px';
        indicator.style.width = '12px';
        indicator.style.height = '12px';
        indicator.style.borderRadius = '50%';
        indicator.style.backgroundColor = '#ccc';
        indicator.style.transition = 'background-color 0.3s';
        indicator.style.zIndex = '1000';
        return indicator;
    }
    
    function updateConnectionStatus(connected) {
        const indicator = document.getElementById('connection-status');
        if (indicator) {
            indicator.style.backgroundColor = connected ? '#4CAF50' : '#F44336';
            indicator.title = connected ? 'Connected' : 'Disconnected';
        }
    }
    
    // Handle main comment form submission
    const submitBtn = document.getElementById('submit-comment');
    if (submitBtn) {
        submitBtn.disabled = true; // Disable until connection is ready
        
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            submitComment();
        });
    }
    
    // Function to handle main comment submission
    function submitComment() {
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const websiteInput = document.getElementById('website');
        const messageInput = document.getElementById('message');
        
        if (!nameInput || !messageInput) {
            console.error("Required form fields not found");
            return;
        }
        
        const name = nameInput.value.trim();
        const message = messageInput.value.trim();
        
        // Validate required fields
        if (!name || !message) {
            alert("Name and comment are required");
            return;
        }
        
        const comment = { 
            type: 'comment',
            blogId, 
            name, 
            email: emailInput ? emailInput.value.trim() : '',
            website: websiteInput ? websiteInput.value.trim() : '',
            message 
        };
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Posting...';
        
        sendMessage(comment)
            .then(() => {
                // Clear form fields
                if (nameInput) nameInput.value = '';
                if (emailInput) emailInput.value = '';
                if (websiteInput) websiteInput.value = '';
                if (messageInput) messageInput.value = '';
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Post Comment <i class="fas fa-arrow-right ms-2"></i>';
            });
    }
    
    // Function to send message through WebSocket
    function sendMessage(message) {
        return new Promise((resolve, reject) => {
            const messageJson = JSON.stringify(message);
            
            // If the socket is open, send the message directly
            if (socket.readyState === WebSocket.OPEN) {
                socket.send(messageJson);
                console.log("Message sent:", message);
                resolve();
            } else {
                // Queue the message to send later
                messageQueue.push(messageJson);
                console.log("Message queued:", message);
                
                // Show notification if connection is not open
                if (socket.readyState === WebSocket.CLOSED || socket.readyState === WebSocket.CLOSING) {
                    showNotification("Connection lost. Your message will be submitted when connection is restored.", "warning");
                    reject(new Error("WebSocket connection closed"));
                } else {
                    resolve(); // Connecting state, message is queued
                }
            }
        });
    }
    
    // Listen for incoming messages (comments or replies)
    function handleSocketMessage(event) {
        try {
            const data = JSON.parse(event.data);
            console.log("Received WebSocket message:", data);
            
            if (!data || !data.type) {
                console.error("Invalid message format received");
                return;
            }
            
            // Handle different message types
            switch (data.type) {
                case 'initial_comments':
                    handleInitialComments(data);
                    break;
                    
                case 'new_comment':
                    // Store comment author in our map
                    authorMap['comment_' + data.comment_id] = data.name;
                    
                    // Handle a single new comment
                    appendComment(data);
                    incrementCommentCount();
                    
                    // Show a notification
                    showNotification("New comment posted successfully!", "success");
                    break;
                    
                case 'new_reply':
                    // Store reply author in our map
                    authorMap['reply_' + data.reply_id] = data.name;
                    
                    // Handle a new reply
                    appendReply(data);
                    
                    // Show a notification
                    showNotification("Reply posted successfully!", "success");
                    break;
                    
                case 'error':
                    console.error("Server error:", data.message);
                    showNotification("Error: " + (data.message || "Unknown error occurred"), "error");
                    break;
                    
                default:
                    console.warn("Unknown message type:", data.type);
            }
        } catch (error) {
            console.error("Error processing message:", error);
        }
    }
    
    function handleInitialComments(data) {
        if (!data.comments || !Array.isArray(data.comments)) {
            console.error("No comments array in initial data");
            return;
        }
        
        const commentList = document.getElementById('comment-list');
        if (!commentList) {
            console.error("Comment list element not found");
            return;
        }
        
        // Clear existing comments
        commentList.innerHTML = '';
        
        // First, store all comment and reply authors in our map
        data.comments.forEach(comment => {
            authorMap['comment_' + comment.comment_id] = comment.name;
        });
        
        if (data.replies && Array.isArray(data.replies)) {
            data.replies.forEach(reply => {
                authorMap['reply_' + reply.reply_id] = reply.name;
            });
        }
        
        // Now render all comments
        data.comments.forEach(comment => {
            appendComment(comment);
        });
        
        // After all comments are rendered, add all replies
        if (data.replies && Array.isArray(data.replies)) {
            // Sort replies to ensure parent replies are added before child replies
            const sortedReplies = sortRepliesByHierarchy(data.replies);
            sortedReplies.forEach(reply => {
                appendReply(reply);
            });
        }
        
        // Update comment count
        updateCommentCount(data.comments.length);
    }
    
    // Helper function to sort replies so parents come before children
    function sortRepliesByHierarchy(replies) {
        // First, separate direct replies (to comments) from nested replies (to other replies)
        const directReplies = replies.filter(reply => !reply.parent_reply_id);
        const nestedReplies = replies.filter(reply => reply.parent_reply_id);
        
        // Build a map of parent_reply_id to child replies
        const replyTree = {};
        nestedReplies.forEach(reply => {
            if (!replyTree[reply.parent_reply_id]) {
                replyTree[reply.parent_reply_id] = [];
            }
            replyTree[reply.parent_reply_id].push(reply);
        });
        
        // Start with direct replies and build the sorted array
        const sortedReplies = [...directReplies];
        
        // Helper function to recursively add child replies
        function addChildReplies(parentId) {
            const children = replyTree[parentId] || [];
            children.forEach(child => {
                sortedReplies.push(child);
                addChildReplies(child.reply_id);
            });
        }
        
        // Add all nested replies in correct order
        directReplies.forEach(reply => {
            addChildReplies(reply.reply_id);
        });
        
        return sortedReplies;
    }
    
    // Helper function to append a comment to the list
    function appendComment(comment) {
        const commentList = document.getElementById('comment-list');
        if (!commentList) return;
        
        const commentItem = document.createElement('li');
        commentItem.classList.add('th-comment-item');
        commentItem.setAttribute('data-comment-id', comment.comment_id);
        
        // Format the date
        let commentDate = 'Just now';
        if (comment.created_at) {
            try {
                const date = new Date(comment.created_at);
                commentDate = date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
            } catch (e) {
                console.warn("Could not parse date:", comment.created_at);
            }
        }
        
        commentItem.innerHTML = `
            <div class="th-post-comment">
                <div class="comment-avater">
                    <img src="assets/img/blog/comment-icon-symbol-design-illustration-vector-removebg-preview.png" alt="Comment Author">
                </div>
                <div class="comment-content">
                    <h3 class="name">${sanitizeHTML(comment.name)}</h3>
                    <span class="commented-on">${commentDate}</span>
                    <p class="text">${sanitizeHTML(comment.message)}</p>
                    <div class="reply_and_edit" style="position: absolute; top: 0; right: 0;">
                        <a href="#" class="reply-btn" data-comment-id="${comment.comment_id}" data-author="${sanitizeHTML(comment.name)}" style="display: flex; align-items: center;">
                            <i class="fas fa-reply"></i>Reply
                        </a>
                    </div>
                </div>
            </div>
            <ul class="children" id="replies-${comment.comment_id}"></ul>
            <div class="reply-form-container" id="reply-form-container-${comment.comment_id}"></div>
        `;
        
        commentList.appendChild(commentItem);
        
        // Add event listener to the reply button
        const replyBtn = commentItem.querySelector(`.reply-btn[data-comment-id="${comment.comment_id}"]`);
        if (replyBtn) {
            replyBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const commentId = this.getAttribute('data-comment-id');
                const authorName = this.getAttribute('data-author');
                toggleReplyForm(commentId, authorName, null); // null for parent_reply_id
            });
        }
    }
    
    // Helper function to append a reply to its parent comment
    function appendReply(reply) {
        // Find the parent container - either for a comment or a reply
        let parentContainer;
        let repliedToName = null;
        
        if (reply.parent_reply_id) {
            // This is a nested reply to another reply
            parentContainer = document.getElementById(`nested-replies-${reply.parent_reply_id}`);
            if (!parentContainer) {
                // Create the nested container if it doesn't exist
                const parentReply = document.querySelector(`[data-reply-id="${reply.parent_reply_id}"]`);
                if (parentReply) {
                    parentContainer = document.createElement('div');
                    parentContainer.classList.add('nested-replies');
                    parentContainer.id = `nested-replies-${reply.parent_reply_id}`;
                    parentReply.appendChild(parentContainer);
                } else {
                    console.error(`Parent reply ${reply.parent_reply_id} not found`);
                    return;
                }
            }
            
            // Get the name of the reply author being replied to
            repliedToName = authorMap['reply_' + reply.parent_reply_id];
        } else {
            // This is a first-level reply to a comment
            parentContainer = document.getElementById(`replies-${reply.parent_comment_id}`);
            if (!parentContainer) {
                console.error(`Replies container for comment ${reply.parent_comment_id} not found`);
                return;
            }
            
            // Get the name of the comment author being replied to
            repliedToName = authorMap['comment_' + reply.parent_comment_id];
        }
        
        const replyItem = document.createElement('div');
        replyItem.classList.add('th-comment-item', 'reply-item');
        replyItem.setAttribute('data-reply-id', reply.reply_id);
        
        // Format the date
        let replyDate = 'Just now';
        if (reply.created_at) {
            try {
                const date = new Date(reply.created_at);
                replyDate = date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
            } catch (e) {
                console.warn("Could not parse date:", reply.created_at);
            }
        }
        
        // Get replied to name from multiple sources with fallback chain
        const displayRepliedToName = reply.replied_to_name || repliedToName || "Unknown";
        
        replyItem.innerHTML = `
            <div class="th-post-comment">
                <div class="comment-avater">
                    <img src="assets/img/blog/discussion-icon-symbol-design-illustration-vector-removebg-preview.png" alt="Reply Author">
                </div>
                <div class="comment-content">
                    <h3 class="name">${sanitizeHTML(reply.name)}</h3>
                    <span class="replied-to">replied to ${sanitizeHTML(displayRepliedToName)}</span>
                    <span class="commented-on">${replyDate}</span>
                    <p class="text">${sanitizeHTML(reply.message)}</p>
                    <div class="reply_and_edit" style="position: absolute; top: 0; right: 0;">
                        <a href="#" class="nested-reply-btn" data-reply-id="${reply.reply_id}" data-comment-id="${reply.parent_comment_id}" data-author="${sanitizeHTML(reply.name)}">
                            <i class="fas fa-reply"></i> Reply
                        </a>
                    </div>
                    <hr width='100%'>
                </div>
            </div>
            <div class="reply-form-container" id="reply-form-container-reply-${reply.reply_id}"></div>
            <div class="nested-replies" id="nested-replies-${reply.reply_id}"></div>
        `;
        
        parentContainer.appendChild(replyItem);
        
        // Add event listener to the nested reply button
        const nestedReplyBtn = replyItem.querySelector(`.nested-reply-btn[data-reply-id="${reply.reply_id}"]`);
        if (nestedReplyBtn) {
            nestedReplyBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const replyId = this.getAttribute('data-reply-id');
                const commentId = this.getAttribute('data-comment-id');
                const authorName = this.getAttribute('data-author');
                toggleReplyForm(commentId, authorName, replyId);
            });
        }
    }
    
    // Function to toggle the reply form
    function toggleReplyForm(commentId, authorName, replyId = null) {
        // Determine the correct container ID based on whether we're replying to a comment or a reply
        const containerId = replyId ? 
            `reply-form-container-reply-${replyId}` : 
            `reply-form-container-${commentId}`;
        
        const replyFormContainer = document.getElementById(containerId);
        if (!replyFormContainer) return;
        
        // If there's already an active reply form, close it first
        if (activeReplyForm && activeReplyForm !== replyFormContainer) {
            activeReplyForm.innerHTML = '';
        }
        
        // Toggle the current reply form
        if (replyFormContainer.innerHTML === '') {
            replyFormContainer.innerHTML = `
                <div class="reply-form" style="margin-top: 30px;">
                    <a href="#" class="nested-reply-btn">
                        <i class="fas fa-reply"></i> 
                    </a>
                    <span class="" style="font-style: italic; padding: 10px; margin-bottom:50px; font-weight: 600; font-size: 17px;">Replying to ${sanitizeHTML(authorName)}</span>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" placeholder="Your Name*" class="form-control reply-name" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" placeholder="Your Email*" class="form-control reply-email" required>
                        </div>
                        <div class="col-12 form-group">
                            <textarea placeholder="Your Reply*" class="form-control reply-message" required></textarea>
                        </div>
                        <div class="col-12 form-group">
                            <button type="button" style="margin-bottom: 10px" class="th-btn submit-reply-btn" 
                                data-comment-id="${commentId}" 
                                data-replied-to="${sanitizeHTML(authorName)}"
                                ${replyId ? `data-reply-id="${replyId}"` : ''}>
                                Post Reply <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                            <button type="button" class="th-btn cancel-reply-btn">
                                Cancel <i class="fas fa-times ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // Add event listeners for the new buttons
            const submitReplyBtn = replyFormContainer.querySelector('.submit-reply-btn');
            if (submitReplyBtn) {
                submitReplyBtn.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    const replyId = this.getAttribute('data-reply-id');
                    const repliedToName = this.getAttribute('data-replied-to');
                    submitReply(commentId, replyId, repliedToName);
                });
            }
            
            const cancelReplyBtn = replyFormContainer.querySelector('.cancel-reply-btn');
            if (cancelReplyBtn) {
                cancelReplyBtn.addEventListener('click', function() {
                    replyFormContainer.innerHTML = '';
                    activeReplyForm = null;
                });
            }
            
            // Auto-focus on name field
            const nameField = replyFormContainer.querySelector('.reply-name');
            if (nameField) {
                setTimeout(() => nameField.focus(), 100);
            }
            
            activeReplyForm = replyFormContainer;
        } else {
            replyFormContainer.innerHTML = '';
            activeReplyForm = null;
        }
    }
    
    // Function to submit a reply
    function submitReply(commentId, replyId = null, repliedToName = 'Unknown') {
        const containerId = replyId ? 
            `reply-form-container-reply-${replyId}` : 
            `reply-form-container-${commentId}`;
        
        const replyFormContainer = document.getElementById(containerId);
        if (!replyFormContainer) return;
        
        const nameInput = replyFormContainer.querySelector('.reply-name');
        const emailInput = replyFormContainer.querySelector('.reply-email');
        const messageInput = replyFormContainer.querySelector('.reply-message');
        const submitButton = replyFormContainer.querySelector('.submit-reply-btn');
        
        if (!nameInput || !emailInput || !messageInput) {
            console.error("Required reply form fields not found");
            return;
        }
        
        const name = nameInput.value.trim();
        const email = emailInput.value.trim();
        const message = messageInput.value.trim();
        
        // Validate required fields
        if (!name || !email || !message) {
            alert("Name, email, and reply message are required");
            return;
        }
        
        // Show loading state
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = 'Posting...';
        }
        
        const reply = {
            type: 'reply',
            blogId,
            parent_comment_id: commentId,
            parent_reply_id: replyId, // Will be null for direct replies to comments
            name,
            email,
            message,
            replied_to_name: repliedToName // Add the name of the person being replied to
        };
        
        // Store this information locally too, even before the server responds
        authorMap[`reply_${replyId ? replyId : commentId}`] = name;
        
        sendMessage(reply)
            .catch(err => {
                console.error("Error sending reply:", err);
                showNotification("Error sending reply. Please try again.", "error");
            })
            .finally(() => {
                // Reset button state
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Post Reply <i class="fas fa-arrow-right ms-2"></i>';
                }
                
                // Clear form and hide it
                replyFormContainer.innerHTML = '';
                activeReplyForm = null;
            });
    }
    
    // Helper function to increment comment count
    function incrementCommentCount() {
        const commentCount = document.getElementById('comment-count');
        if (commentCount) {
            let count = parseInt(commentCount.textContent) || 0;
            commentCount.textContent = count + 1;
        }
    }
    
    // Helper function to set comment count
    function updateCommentCount(count) {
        const commentCount = document.getElementById('comment-count');
        if (commentCount) {
            commentCount.textContent = count;
        }
    }
    
    // Function to show notification
    function showNotification(message, type = 'info') {
        // Create notification container if it doesn't exist
        let notificationContainer = document.getElementById('notification-container');
        
        if (!notificationContainer) {
            notificationContainer = document.createElement('div');
            notificationContainer.id = 'notification-container';
            notificationContainer.style.position = 'fixed';
            notificationContainer.style.top = '20px';
            notificationContainer.style.right = '20px';
            notificationContainer.style.maxWidth = '300px';
            notificationContainer.style.zIndex = '1001';
            document.body.appendChild(notificationContainer);
        }
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;
        
        // Style based on type
        let bgColor, textColor;
        switch (type) {
            case 'success':
                bgColor = '#4CAF50';
                textColor = 'white';
                break;
            case 'error':
                bgColor = '#F44336';
                textColor = 'white';
                break;
            case 'warning':
                bgColor = '#FF9800';
                textColor = 'black';
                break;
            default:
                bgColor = '#2196F3';
                textColor = 'white';
        }
        
        // Apply styles
        notification.style.backgroundColor = bgColor;
        notification.style.color = textColor;
        notification.style.padding = '12px';
        notification.style.marginBottom = '10px';
        notification.style.borderRadius = '4px';
        notification.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.3s';
        
        // Add close button event
        const closeBtn = notification.querySelector('.notification-close');
        closeBtn.style.background = 'none';
        closeBtn.style.border = 'none';
        closeBtn.style.color = textColor;
        closeBtn.style.float = 'right';
        closeBtn.style.fontSize = '20px';
        closeBtn.style.cursor = 'pointer';
        closeBtn.style.marginLeft = '10px';
        
        closeBtn.addEventListener('click', function() {
            notification.style.opacity = '0';
            setTimeout(() => {
                notification.remove();
            }, 300);
        });
        
        // Add to container
        notificationContainer.appendChild(notification);
        
        // Fade in
        setTimeout(() => {
            notification.style.opacity = '1';
        }, 10);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.style.opacity = '0';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 300);
            }
        }, 5000);
    }
    
    // Helper function to sanitize HTML
    function sanitizeHTML(text) {
        if (!text) return '';
        const temp = document.createElement('div');
        temp.textContent = text;
        return temp.innerHTML;
    }
    
    // Add CSS for the UI elements
    const style = document.createElement('style');
    style.textContent = `
        .replied-to {
            font-size: 0.85em;
            color: #007bff;  /* Use a blue color to make it stand out */
            display: block;
            margin-top: -5px;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        
        
        /* Reply form transitions */
        .reply-form {
            opacity: 1;
            transition: opacity 0.3s ease;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        /* Connection status pulse animation */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        #connection-status.disconnected {
            animation: pulse 1s infinite;
        }
    `;
    document.head.appendChild(style);
});
   </script>

     <!--==============================
	Footer Area
==============================-->
<?php include 'include/footer.php'; ?>

    <!--********************************
			Code End  Here 
	******************************** -->

    <!-- Scroll To Top -->
    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>

    <!--==============================
    All Js File
============================== -->
    <!-- Jquery -->
    <script src="assets/js/vendor/jquery-3.7.1.min.js"></script>
    <!-- Swiper Js -->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Magnific Popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- Range Slider -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- Isotope Filter -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>

    <!-- Main Js File -->
    <script src="assets/js/main.js"></script>
</body>

</html>