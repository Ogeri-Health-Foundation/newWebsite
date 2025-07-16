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
    .nested-replies {
        margin-left: 5px;
    }

    @media (max-width: 789px) {
        .nested-replies {
            margin-left: 0;
        }


    }

    .blog-gallery-item img {
        height: 10px;
    }
</style>

<head>
    <?php include 'include/head.php'; ?>
    <script src="https://kit.fontawesome.com/706f90924a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/blog.css">

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
    <!-- header section starts -->
    <section class="headers">
        <img src="<?= $image ?>" class="header-img img-fluid img-responsive" alt="header-img" style="object-fit:cover;object-position:bottom">

        <div class="header-details" class="text-danger">
            <a href="./" class="text-white text-decoration-none">Home &gt;</a>
            <span>Blog</span>
            <h1 class="ohf_font text-white"><?= $blogName ?></h1>
        </div>
    </section>






    <!-- header section ends --><!--==============================
    Blog Area
==============================-->
    <section class="blog-container container my-5">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 mt-5">
                <!-- BLOG LIST starts -->
                <div class="row">
                    <div class="col-12">
                        <style>
                            .img-section img {
                                width: 100%;
                                height: 300px !important;
                                object-fit: cover;
                            }

                            @media (max-width: 768px) {
                                .img-section img {
                                    height: 250px !important;
                                }
                            }

                            @media (max-width: 576px) {
                                .img-section img {
                                    height: 250px !important;
                                }
                            }
                        </style>
                        <div class="card h-100" style="border: none;border-bottom: 1px solid #c7c7c7;">
                            <div class="img-section">
                                <img src="<?= $image ?>" class="img-fluid w-100" alt="..."
                                    style="border-bottom: 4px solid sandybrown; object-fit: cover; height: 400px;">
                            </div>
                            <div class="card-body">
                                <div class="single-date">
                                    <i class="fa-solid fa-calendar-days text-orange"></i>
                                    <span class="me-3"><?= $date ?></span>
                                    <i class="fa-solid fa-square-plus text-orange"></i>
                                    <span><?= $category ?></span>
                                </div>
                                <h5 class="card-title ohf_font mt-3"><?= $blogName ?></h5>
                                <div class="card-text mt-2">
                                    <?= htmlspecialchars_decode($body); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BLOG LIST ends -->

                <!-- links and social media -->
                <div class="row mt-4 px-4">
                    <div class="col-12 col-md-6">
                        <div class="blog-tags d-flex flex-sm-row flex-column align-items-start">
                            <h4 class="me-2">Tags:</h4>
                            <div class="tags">
                                <a href="blog.php?category=<?= urlencode($category) ?>" class="tag btn text-muted"><?= $category ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php
                        $eventUrl = "https://" . $_SERVER['HTTP_HOST'] . "/event-details.php?id=" . urlencode($blogid);
                        $encodedEventUrl = urlencode($eventUrl);
                        ?>
                        <div class="blog-tags d-flex flex-sm-row flex-column align-items-start">
                            <h4 class="me-2">Share:</h4>
                            <div class="tags d-flex">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $encodedEventUrl ?>"
                                    class="tag btn btn p-0 d-flex align-items-center justify-content-center me-2 rounded-circle btn-1 btn-brands"
                                    target="_blank">
                                    <i class="fa-brands fa-facebook-f fs-6"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?= $encodedEventUrl ?>"
                                    class="tag btn btn p-0 d-flex align-items-center justify-content-center me-2 rounded-circle btn-1 btn-brands"
                                    target="_blank">
                                    <i class="fa-brands fa-x-twitter fs-6"></i>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $encodedEventUrl ?>"
                                    class="tag btn btn p-0 d-flex align-items-center justify-content-center me-2 rounded-circle btn-1 btn-brands"
                                    target="_blank">
                                    <i class="fa-brands fa-linkedin fs-6"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text=<?= $encodedEventUrl ?>"
                                    class="tag btn btn p-0 d-flex align-items-center justify-content-center me-2 rounded-circle btn-1 btn-brands"
                                    target="_blank">
                                    <i class="fa-brands fa-whatsapp fs-6"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- comments section -->
                <div class="row mt-4 px-4">
                    <div class="col-12">
                        <h4>Comments (<span class="count" id="comment-count">0</span>)</h4>

                        <div class="comment-list" id="comment-list">
                            <!-- Comments will be loaded dynamically here -->
                        </div>
                    </div>
                </div>

                <!-- leave a reply -->
                <div class="row my-4">
                    <div class="col-12 box-shadow p-4">
                        <h4>Leave a Reply</h4>
                        <p>Your email address will not be published. Required fields are marked</p>
                        <form id="comment-form" data-id="<?= $blogid ?>">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" id="name" placeholder="Your Name" name="name" class="form-controls" required aria-label="Your Name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" id="email" placeholder="Your Email" name="email" class="form-controls" required aria-label="Your Email">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="url" id="website" placeholder="Your Website" name="website" class="form-controls" aria-label="Your Website (optional)">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="message" class="form-controls" id="message" rows="6"
                                        placeholder="Type a message ..." required aria-label="Your Comment"></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <button type="submit" id="submit-comment" class="form-controls btn-3">SUBMIT COMMENT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-4 col-lg-4">


                <div class="blog-search" style=" margin-top: 62px;">
                    <form action="blog.php" method="GET" class="searchForm">
                        <input type="search" name="search" id="search" placeholder="Enter Keyword..."
                            class="searchInput" value="">
                        <button type="submit" id="blog-search-btn" class="btn" name="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>

                <div class="blog-search blog-categories mt-4">
                    <h4 class="ohf_font text-orange">Categories</h4>
                    <?php
                    $categories = [
                        'Community Health Stories',
                        'Hypertension & Heart Health',
                        'Health Education & Lifestyle',
                        'Digital Health & Innovation',
                        'Outreach Highlights',
                        'Research & Insights',
                        'Volunteer & Partner Spotlights',
                        'Events & Announcements',
                        'Health Centre Strengthening',
                        'Funding & Support'
                    ];
                    ?>

                    <div class="category-lists">

                        <?php foreach ($categories as $cat): ?>

                            <a href="blog.php?category=<?= urlencode($cat) ?>" class=" d-flex justify-content-between cat-link btn my-3 <?= ($selectedCategory === $cat) ? 'active-cat' : '' ?>">
                                <div class="cat-title"><?= $cat ?></div>
                                <div class="cat-icon">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>
                            </a>
                        <?php endforeach; ?>

                    </div>
                </div>

                <div class="blog-search mt-4">
                    <h4 class="ohf_font text-orange">Recent Posts</h4>

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

                                <div class="related-container-list my-3">
                                    <a href="blog-details.php?id=<?= $eventid ?>">
                                        <div class="related-img">
                                            <img src="<?= $image ?>" alt="" class="img-fluid">
                                        </div>
                                    </a>

                                    <div class="related-content">
                                        <div class="related-date">
                                            <i class="fa-solid fa-calendar-days text-orange"></i> &nbsp;
                                            <span class="date-text"><?= $eventDate ?></span>
                                        </div>
                                        <a href="blog-details.php?id=<?= $eventid ?>" class="text-decoration-none">
                                            <h6 class="related-title text-dark text_hover"><?= $eventName ?></h6>
                                        </a>
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

                <div class="blog-search my-4">
                    <h4 class="ohf_font text-orange">Popular Tags</h4>

                    <div class="tags mt-3">
                        <a href="" class="tag btn text-muted">Donations</a>
                        <a href="" class="tag btn text-muted">Food</a>
                        <a href="" class="tag btn text-muted">Help</a>
                        <a href="" class="tag btn text-muted">Education</a>
                        <a href="" class="tag btn text-muted">Fundraising</a>
                        <a href="" class="tag btn text-muted">Tips</a>
                    </div>



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

            // Track last submit time for rate limiting
            let lastSubmitTime = 0;

            // Initialize socket variable
            let socket;

            function initializeWebSocket() {
                console.log("Initializing WebSocket connection...");
                try {
                    socket = connectWebSocket('wss://websocket-production-db61.up.railway.app');
                    return socket;
                } catch (error) {
                    console.error("WebSocket initialization failed:", error);
                    showNotification("Failed to initialize connection. Please refresh the page.", "error");
                    return null;
                }
            }

            function connectWebSocket(url) {
                const ws = new WebSocket(url);
                let heartbeatInterval;

                ws.onopen = function() {
                    console.log("WebSocket connection established");
                    reconnectAttempts = 0;
                    updateConnectionStatus(true);

                    // Send blog ID as the initial message to register this client
                    ws.send(JSON.stringify({
                        blogId,
                        type: 'init'
                    }));

                    // Send any queued messages
                    messageQueue.forEach(message => {
                        ws.send(message);
                    });

                    messageQueue = [];

                    // Enable submit button once connection is established
                    const submitBtn = document.getElementById('submit-comment');
                    if (submitBtn) {
                        submitBtn.disabled = false;
                    }

                    // Start heartbeat
                    heartbeatInterval = setInterval(() => {
                        if (ws.readyState === WebSocket.OPEN) {
                            ws.send(JSON.stringify({
                                type: 'heartbeat'
                            }));
                        }
                    }, 30000); // 30 seconds
                };

                ws.onclose = function(event) {
                    console.log("WebSocket connection closed", event);
                    updateConnectionStatus(false);
                    clearInterval(heartbeatInterval);

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
                        showNotification("Connection lost. Please refresh the page to reconnect.", "error");
                    }
                };

                ws.onerror = function(error) {
                    console.error("WebSocket error:", error);
                    updateConnectionStatus(false);
                };

                ws.onmessage = handleSocketMessage;

                return ws;
            }

            // Actually initialize the socket
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
                indicator.setAttribute('aria-live', 'polite');
                return indicator;
            }

            function updateConnectionStatus(connected) {
                const indicator = document.getElementById('connection-status');
                if (indicator) {
                    indicator.style.backgroundColor = connected ? '#4CAF50' : '#F44336';
                    indicator.title = connected ? 'Connected' : 'Disconnected';
                    indicator.setAttribute('aria-label', connected ? 'Connected to server' : 'Disconnected from server');
                }
            }

            // Handle main comment form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                submitComment();
            });

            // Function to handle main comment submission
            function submitComment() {
                const now = Date.now();
                if (lastSubmitTime && now - lastSubmitTime < 5000) { // 5 second cooldown
                    showNotification("Please wait a moment before posting again", "warning");
                    return;
                }
                lastSubmitTime = now;

                const nameInput = document.getElementById('name');
                const emailInput = document.getElementById('email');
                const websiteInput = document.getElementById('website');
                const messageInput = document.getElementById('message');
                const submitBtn = document.getElementById('submit-comment');

                if (!nameInput || !messageInput) {
                    console.error("Required form fields not found");
                    return;
                }

                const name = nameInput.value.trim();
                const email = emailInput.value.trim();
                const message = messageInput.value.trim();

                // Validate required fields
                if (!name || !message) {
                    showNotification("Name and comment are required", "error");
                    return;
                }

                if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    showNotification("Please enter a valid email address", "error");
                    return;
                }

                const comment = {
                    type: 'comment',
                    blogId,
                    name,
                    email,
                    website: websiteInput ? websiteInput.value.trim() : '',
                    message
                };

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.textContent = 'Posting...';

                sendMessage(comment)
                    .then(() => {
                        // Clear form fields
                        if (nameInput) nameInput.value = '';
                        if (emailInput) emailInput.value = '';
                        if (websiteInput) websiteInput.value = '';
                        if (messageInput) messageInput.value = '';
                    })
                    .catch(err => {
                        console.error("Error sending comment:", err);
                        showNotification("Error sending comment. Please try again.", "error");
                        queueMessageForLater(comment);
                    })
                    .finally(() => {
                        // Reset button state
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'SUBMIT COMMENT';
                    });
            }

            function queueMessageForLater(message) {
                const pending = JSON.parse(localStorage.getItem('pendingComments') || '[]');
                pending.push(message);
                localStorage.setItem('pendingComments', JSON.stringify(pending));
                showNotification("Your comment will be posted when you're back online", "warning");
            }

            // Function to send message through WebSocket
            function sendMessage(message) {
                return new Promise((resolve, reject) => {
                    const messageJson = JSON.stringify(message);

                    if (socket && socket.readyState === WebSocket.OPEN) {
                        socket.send(messageJson);
                        console.log("Message sent:", message);
                        resolve();
                    } else {
                        messageQueue.push(messageJson);
                        console.log("Message queued:", message);

                        if (!socket || socket.readyState === WebSocket.CLOSED || socket.readyState === WebSocket.CLOSING) {
                            showNotification("Connection lost. Your message will be submitted when connection is restored.", "warning");
                            queueMessageForLater(message);
                            reject(new Error("WebSocket connection closed"));
                        } else {
                            resolve();
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

                    switch (data.type) {
                        case 'initial_comments':
                            handleInitialComments(data);
                            break;

                        case 'new_comment':
                            authorMap['comment_' + data.comment_id] = data.name;
                            appendComment(data);
                            incrementCommentCount();
                            showNotification("New comment posted successfully!", "success");
                            break;

                        case 'new_reply':
                            authorMap['reply_' + data.reply_id] = data.name;
                            appendReply(data);
                            showNotification("Reply posted successfully!", "success");
                            break;

                        case 'error':
                            console.error("Server error:", data.message);
                            showNotification("Error: " + (data.message || "Unknown error occurred"), "error");
                            break;

                        case 'heartbeat':
                            // Just acknowledge the heartbeat
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

                // Show loading state
                commentList.innerHTML = '<div class="loading-comments">Loading comments...</div>';

                // Process after a small delay to allow UI to update
                setTimeout(() => {
                    commentList.innerHTML = '';

                    data.comments.forEach(comment => {
                        authorMap['comment_' + comment.comment_id] = comment.name;
                    });

                    if (data.replies && Array.isArray(data.replies)) {
                        data.replies.forEach(reply => {
                            authorMap['reply_' + reply.reply_id] = reply.name;
                        });
                    }

                    data.comments.forEach(comment => {
                        appendComment(comment);
                    });

                    if (data.replies && Array.isArray(data.replies)) {
                        const sortedReplies = sortRepliesByHierarchy(data.replies);
                        sortedReplies.forEach(reply => {
                            appendReply(reply);
                        });
                    }

                    updateCommentCount(data.comments.length);

                    // Process any pending comments from local storage
                    processPendingComments();
                }, 100);
            }

            function processPendingComments() {
                const pending = JSON.parse(localStorage.getItem('pendingComments') || '[]');
                if (pending.length > 0 && socket && socket.readyState === WebSocket.OPEN) {
                    pending.forEach(message => {
                        socket.send(JSON.stringify(message));
                    });
                    localStorage.removeItem('pendingComments');
                    showNotification("Pending comments have been submitted", "success");
                }
            }

            function sortRepliesByHierarchy(replies) {
                const directReplies = replies.filter(reply => !reply.parent_reply_id);
                const nestedReplies = replies.filter(reply => reply.parent_reply_id);

                const replyTree = {};
                nestedReplies.forEach(reply => {
                    if (!replyTree[reply.parent_reply_id]) {
                        replyTree[reply.parent_reply_id] = [];
                    }
                    replyTree[reply.parent_reply_id].push(reply);
                });

                const sortedReplies = [...directReplies];

                function addChildReplies(parentId) {
                    const children = replyTree[parentId] || [];
                    children.forEach(child => {
                        sortedReplies.push(child);
                        addChildReplies(child.reply_id);
                    });
                }

                directReplies.forEach(reply => {
                    addChildReplies(reply.reply_id);
                });

                return sortedReplies;
            }

            function appendComment(comment) {
                const commentList = document.getElementById('comment-list');
                if (!commentList) return;

                // Format the date and time
                let commentDate = 'Just now';
                let commentTime = '';
                if (comment.created_at) {
                    try {
                        const date = new Date(comment.created_at);
                        commentDate = date.toLocaleDateString('en-US', {
                            weekday: 'short',
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric'
                        });
                        commentTime = date.toLocaleTimeString('en-US', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    } catch (e) {
                        console.warn("Could not parse date:", comment.created_at);
                    }
                }

                const commentItem = document.createElement('div');
                commentItem.classList.add('comment-section', 'mt-4');
                commentItem.setAttribute('data-comment-id', comment.comment_id);
                commentItem.setAttribute('aria-label', `Comment by ${sanitizeHTML(comment.name)}`);

                commentItem.innerHTML = `
                <div class="comment-img">
                    <img src="assets/img/blog/comment-icon-symbol-design-illustration-vector-removebg-preview.png" 
                         class="com-img img-responsive" 
                         alt="Comment Author"
                         aria-hidden="true">
                </div>
                <div class="comment-area">
                    <h5>${sanitizeHTML(comment.name)}</h5>
                    <span class="date">
                        <i class="fa-solid fa-calendar-days text-orange" aria-hidden="true"></i>
                        ${commentDate}
                    </span>
                    <span class="time">
                        <i class="fa-solid fa-clock text-orange" aria-hidden="true"></i>
                        ${commentTime}
                    </span>
                    <p class="comment-description mt-2">
                        ${sanitizeHTML(comment.message)}
                    </p>
                    <div class="reply_and_edit">
                        <a href="#" class="reply-btn" 
                           data-comment-id="${comment.comment_id}" 
                           data-author="${sanitizeHTML(comment.name)}"
                           aria-label="Reply to ${sanitizeHTML(comment.name)}">
                            <i class="fa-solid fa-reply" aria-hidden="true"></i> Reply
                        </a>
                    </div>
                </div>
                <div class="replies-container" id="replies-${comment.comment_id}"></div>
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
                        toggleReplyForm(commentId, authorName, null);
                    });
                }
            }

            function appendReply(reply) {
                // Find the parent container - either for a comment or a reply
                let parentContainer;
                let repliedToName = null;

                if (reply.parent_reply_id) {
                    // This is a nested reply to another reply
                    parentContainer = document.getElementById(`nested-replies-${reply.parent_reply_id}`);
                    if (!parentContainer) {
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
                    repliedToName = authorMap['reply_' + reply.parent_reply_id];
                } else {
                    // This is a first-level reply to a comment
                    parentContainer = document.getElementById(`replies-${reply.parent_comment_id}`);
                    if (!parentContainer) {
                        console.error(`Replies container for comment ${reply.parent_comment_id} not found`);
                        return;
                    }
                    repliedToName = authorMap['comment_' + reply.parent_comment_id];
                }

                // Format the date and time
                let replyDate = 'Just now';
                let replyTime = '';
                if (reply.created_at) {
                    try {
                        const date = new Date(reply.created_at);
                        replyDate = date.toLocaleDateString('en-US', {
                            weekday: 'short',
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric'
                        });
                        replyTime = date.toLocaleTimeString('en-US', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    } catch (e) {
                        console.warn("Could not parse date:", reply.created_at);
                    }
                }

                const displayRepliedToName = reply.replied_to_name || repliedToName || "Unknown";

                const replyItem = document.createElement('div');
                replyItem.classList.add('comment-section', 'mt-4');
                replyItem.setAttribute('data-reply-id', reply.reply_id);
                replyItem.setAttribute('aria-label', `Reply by ${sanitizeHTML(reply.name)} to ${sanitizeHTML(displayRepliedToName)}`);

                replyItem.innerHTML = `
                <div class="comment-img">
                    <img src="assets/img/blog/discussion-icon-symbol-design-illustration-vector-removebg-preview.png" 
                         class="com-img img-responsive" 
                         alt="Reply Author"
                         aria-hidden="true">
                </div>
                <div class="comment-area">
                    <h5>${sanitizeHTML(reply.name)}</h5>
                    <span class="replied-to">replied to ${sanitizeHTML(displayRepliedToName)}</span>
                    <span class="date">
                        <i class="fa-solid fa-calendar-days text-orange" aria-hidden="true"></i>
                        ${replyDate}
                    </span>
                    <span class="time">
                        <i class="fa-solid fa-clock text-orange" aria-hidden="true"></i>
                        ${replyTime}
                    </span>
                    <p class="comment-description mt-2">
                        ${sanitizeHTML(reply.message)}
                    </p>
                    <div class="reply_and_edit">
                        <a href="#" class="nested-reply-btn" 
                           data-reply-id="${reply.reply_id}" 
                           data-comment-id="${reply.parent_comment_id}" 
                           data-author="${sanitizeHTML(reply.name)}"
                           aria-label="Reply to ${sanitizeHTML(reply.name)}">
                            <i class="fa-solid fa-reply" aria-hidden="true"></i> Reply
                        </a>
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

            function toggleReplyForm(commentId, authorName, replyId = null) {
                const containerId = replyId ?
                    `reply-form-container-reply-${replyId}` :
                    `reply-form-container-${commentId}`;

                const replyFormContainer = document.getElementById(containerId);
                if (!replyFormContainer) return;

                if (activeReplyForm && activeReplyForm !== replyFormContainer) {
                    activeReplyForm.innerHTML = '';
                }

                if (replyFormContainer.innerHTML === '') {
                    replyFormContainer.innerHTML = `
                    <div class="reply-form" style="margin-top: 30px; background: #f9f9f9; padding: 15px; border-radius: 5px;">
                        <span style="font-style: italic; font-weight: 600; font-size: 17px;">
                            <i class="fa-solid fa-reply" aria-hidden="true"></i> Replying to ${sanitizeHTML(authorName)}
                        </span>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <input type="text" placeholder="Your Name*" class="form-controls reply-name" required aria-label="Your Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" placeholder="Your Email*" class="form-controls reply-email" required aria-label="Your Email">
                            </div>
                            <div class="col-12 mb-3">
                                <textarea placeholder="Your Reply*" class="form-controls reply-message" required aria-label="Your Reply"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <button type="button" class="form-controls btn-3 submit-reply-btn" 
                                    data-comment-id="${commentId}" 
                                    data-replied-to="${sanitizeHTML(authorName)}"
                                    ${replyId ? `data-reply-id="${replyId}"` : ''}
                                    aria-label="Post reply">
                                    Post Reply
                                </button>
                                <button type="button" class="form-controls btn-3 cancel-reply-btn" style="background: #f44336; margin-top: 10px;" aria-label="Cancel reply">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                `;

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

                if (!name || !email || !message) {
                    showNotification("Name, email, and reply message are required", "error");
                    return;
                }

                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    showNotification("Please enter a valid email address", "error");
                    return;
                }

                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.textContent = 'Posting...';
                }

                const reply = {
                    type: 'reply',
                    blogId,
                    parent_comment_id: commentId,
                    parent_reply_id: replyId,
                    name,
                    email,
                    message,
                    replied_to_name: repliedToName
                };

                authorMap[`reply_${replyId ? replyId : commentId}`] = name;

                sendMessage(reply)
                    .catch(err => {
                        console.error("Error sending reply:", err);
                        showNotification("Error sending reply. Please try again.", "error");
                        queueMessageForLater(reply);
                    })
                    .finally(() => {
                        if (submitButton) {
                            submitButton.disabled = false;
                            submitButton.textContent = 'Post Reply';
                        }
                        replyFormContainer.innerHTML = '';
                        activeReplyForm = null;
                    });
            }

            function incrementCommentCount() {
                const commentCount = document.getElementById('comment-count');
                if (commentCount) {
                    let count = parseInt(commentCount.textContent) || 0;
                    commentCount.textContent = count + 1;
                }
            }

            function updateCommentCount(count) {
                const commentCount = document.getElementById('comment-count');
                if (commentCount) {
                    commentCount.textContent = count;
                }
            }

            function showNotification(message, type = 'info') {
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

                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.setAttribute('role', 'alert');
                notification.setAttribute('aria-live', 'assertive');
                notification.innerHTML = `
                <div class="notification-content">
                    <span class="notification-message">${sanitizeHTML(message)}</span>
                    <button class="notification-close" aria-label="Close notification">&times;</button>
                </div>
            `;

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

                notification.style.backgroundColor = bgColor;
                notification.style.color = textColor;
                notification.style.padding = '12px';
                notification.style.marginBottom = '10px';
                notification.style.borderRadius = '4px';
                notification.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
                notification.style.opacity = '0';
                notification.style.transition = 'opacity 0.3s';

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

                notificationContainer.appendChild(notification);

                setTimeout(() => {
                    notification.style.opacity = '1';
                }, 10);

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

            function sanitizeHTML(text) {
                if (!text) return '';
                const temp = document.createElement('div');
                temp.textContent = text;
                return temp.innerHTML
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            // Add CSS for the UI elements
            const style = document.createElement('style');
            style.textContent = `
            .replied-to {
                font-size: 0.85em;
                color: #007bff;
                display: block;
                margin-top: -5px;
                margin-bottom: 5px;
                font-weight: 500;
            }
            
            .comment-section {
                display: flex;
                gap: 15px;
                padding: 15px;
                border-bottom: 1px solid #eee;
            }
            
            .comment-img {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                overflow: hidden;
            }
            
            .comment-img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            
            .comment-area {
                flex: 1;
                position: relative;
            }
            
            .comment-area h5 {
                margin-bottom: 5px;
                font-size: 1.1rem;
            }
            
            .date, .time {
                font-size: 0.8rem;
                color: #666;
                margin-right: 10px;
            }
            
            .comment-description {
                margin-top: 10px;
                line-height: 1.6;
            }
            
            .reply_and_edit {
                margin-top: 10px;
            }
            
            .reply-btn, .nested-reply-btn {
                color: #ff6b00;
                text-decoration: none;
                font-size: 0.9rem;
            }
            
            .reply-btn:hover, .nested-reply-btn:hover {
                text-decoration: underline;
            }
            
            .nested-replies {
                margin-left: 75px;
                border-left: 2px solid #ff6b00;
                padding-left: 15px;
            }
            
            #connection-status {
                position: fixed;
                bottom: 10px;
                right: 10px;
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background-color: #ccc;
                transition: background-color 0.3s;
                z-index: 1000;
            }
            
            .notification {
                background-color: #2196F3;
                color: white;
                padding: 12px;
                margin-bottom: 10px;
                border-radius: 4px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                opacity: 0;
                transition: opacity 0.3s;
            }

            .loading-comments {
                text-align: center;
                padding: 20px;
                color: #666;
            }

            @media (max-width: 768px) {
                .comment-section {
                    flex-direction: column;
                }
                .nested-replies {
                    margin-left: 30px;
                }
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