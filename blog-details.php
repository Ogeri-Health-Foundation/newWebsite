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
        $updateView = $dbh->prepare("UPDATE blog_posts SET views = views + 1 WHERE blog_id = :id");
        $updateView->bindParam(':id', $eventId);
        $updateView->execute();

        
        $category = htmlspecialchars($blog['category']);
        $body = htmlspecialchars($blog['body']);
        $date = date("M j, Y", strtotime($blog['published_at']));
        
        $blogid = htmlspecialchars($blog['blog_id']);
       
        
    } else {
        throw new Exception("Blog not found.");
    }

    $logView = $dbh->prepare("INSERT INTO blog_views (blog_id) VALUES (:id)");
    $logView->bindParam(':id', $eventId);
    $logView->execute();

    // $query = "SELECT * FROM blog_images WHERE blog_id = :blog_id";
    // $stmt = $dbh->prepare($query);
    // $stmt->bindParam(':blog_id', $eventId);
    // $stmt->execute();

    // $blog_images = [];
    // if ($stmt->rowCount() > 0) {
    //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //         $blog_images[] = [
    //             'img_path' => "uploads/" . htmlspecialchars($row['img_path']),
    //             'caption' => htmlspecialchars($row['caption'])
    //         ];
    //     }
        
    //     shuffle($blog_images);
    // }

    

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
    "scripts" => ["assets/js/main2.js"]
);

$addons = array(
    "stylesheets" => ["https://some-external-url.css"],
    "scripts" => ["https://some-external-url.js"]
);

?>

<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">
    <!-- Open Graph / Facebook / LinkedIn -->


<style>
     a{
    text-decoration: none !important; 
    color: inherit;
  }
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
    <!-- <link rel="stylesheet" href="./assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./assets/css/blog.css">
    <?php
        // Blog data
        $blogName = $blog['blog_title'] ?? '';
        $description = $blog['blog_description'] ?? '';
        $imageFile = $blog['image'] ?? '';
        
        // Base URL stuff
        $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $blogid = $_GET['id'] ?? ''; // if not already defined
        
        // Image path
        $imagePath = !empty($imageFile) ? "uploads/" . $imageFile : "assets/img/donate/donation2-1.png";
        $imageUrl = "$scheme://$host/$imagePath";
        
        // Page URL
        $pageUrl = "$scheme://$host/blog-details.php?id=" . urlencode($blogid);
        ?>
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= htmlspecialchars($blogName, ENT_QUOTES) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($description, ENT_QUOTES) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($imageUrl, ENT_QUOTES) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($pageUrl, ENT_QUOTES) ?>">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($blogName, ENT_QUOTES) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($description, ENT_QUOTES) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($imageUrl, ENT_QUOTES) ?>">
    <style>

        .breadcumb-wrapper {
            position: relative;
            background-size: cover;
            background-position: center;
            z-index: 1;
            overflow: hidden;
        }

        .breadcumb-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.5); /* Black overlay */
            z-index: 0;
        }

        .breadcumb-wrapper .breadcumb-content {
            position: relative;
            z-index: 1; /* Ensure it sits above the overlay */
        }
       
        /* .breadcumb-content a {
            color: #ffd700; /
            text-decoration: underline;
        } */

        .breadcumb-title {
            color: #fff;
            font-weight: 700;
}
    </style>

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
    <!-- <section class="headers">
        <img src="<?= $image ?>" class="header-img img-fluid img-responsive" alt="header-img" style="object-fit:cover;object-position:bottom">

        <div class="header-details" class="text-danger">
            <a href="./" class="text-white text-decoration-none">Home &gt;</a>
            <span>Blog</span>
            <h1 class="ohf_font text-white"><?= $blogName ?></h1>
        </div>
    </section> -->
    <div class="breadcumb-wrapper blog-hero headers" style="background-image: url('<?= $imagePath ?>'); padding: 100px 20px !important;">
        <div class="container">
            <div class="breadcumb-content">
                <ul class="breadcumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li>Blog Details</li>
                </ul>
                <h1 class="breadcumb-title mt-3"><?= htmlspecialchars($blogName) ?></h1>
              
                
            </div>
        </div>
    </div>






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
                                <img src="<?= $imagePath ?>" class="img-fluid w-100" alt="..."
                                    style="border-bottom: 4px solid sandybrown; object-fit: cover; height: 400px;">
                            </div>
                            <div class="card-body">
                                <div class="single-date">
                                    <i class="fa-solid fa-calendar-days text-orange"></i>
                                    <span class="me-3"><?= $date ?></span>
                                    <i class="fa-solid fa-square-plus text-orange"></i>
                                    <span><?= ucwords(str_replace('_', ' ', htmlspecialchars($category))) ?></span>
                                </div>
                                <h5 class="card-title ohf_font mt-3"><?= htmlspecialchars($blogName) ?></h5>
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
                                <a href="blog.php?category=<?= urlencode($category) ?>" class="tag btn text-muted">
                                    <?= ucwords(str_replace('_', ' ', htmlspecialchars($category))) ?>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php
                            $quote = htmlspecialchars( $description);
                            $eventUrl = $pageUrl;
                            $encodedEventUrl = urlencode($eventUrl);
                            $encodedQuote = urlencode($quote);
                        ?>
                        <div class="blog-tags d-flex flex-sm-row flex-column align-items-start">
                            <h4 class="me-2">Share:</h4>
                            <div class="tags d-flex">
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $encodedEventUrl ?>&quote=<?= $encodedQuote ?>"
                                    class="tag btn btn p-0 d-flex align-items-center justify-content-center me-2 rounded-circle btn-1 btn-brands"
                                    target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-facebook-f fs-6"></i>
                                </a>

                                <!-- X (Twitter) -->
                                <a href="https://twitter.com/intent/tweet?url=<?= $encodedEventUrl ?>&text=<?= urlencode($blogName) ?>"
                                    class="tag btn btn p-0 d-flex align-items-center justify-content-center me-2 rounded-circle btn-1 btn-brands"
                                    target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-x-twitter fs-6"></i>
                                </a>

                                <!-- LinkedIn -->
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $encodedEventUrl ?>&title=<?= urlencode($blogName) ?>"
                                    class="tag btn btn p-0 d-flex align-items-center justify-content-center me-2 rounded-circle btn-1 btn-brands"
                                    target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-linkedin fs-6"></i>
                                </a>

                                <!-- WhatsApp -->
                                <a href="https://api.whatsapp.com/send?text=<?= urlencode($blogName . ' - ' . $eventUrl) ?>"
                                    class="tag btn btn p-0 d-flex align-items-center justify-content-center me-2 rounded-circle btn-1 btn-brands"
                                    target="_blank" rel="noopener noreferrer">
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

                        <div id="comment-sections">
                            <!-- comments dynamically enter here -->
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

                <!-- <div class="blog-search my-4">
                    <h4 class="ohf_font text-orange">Popular Tags</h4>

                    <div class="tags mt-3">
                        <a href="" class="tag btn text-muted">Donations</a>
                        <a href="" class="tag btn text-muted">Food</a>
                        <a href="" class="tag btn text-muted">Help</a>
                        <a href="" class="tag btn text-muted">Education</a>
                        <a href="" class="tag btn text-muted">Fundraising</a>
                        <a href="" class="tag btn text-muted">Tips</a>
                    </div>



                </div> -->



            </div>
        </div>
    </section>








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



    <script>
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


        $(document).ready(function() {

            $(document).ready(function() {
                // Fetch comments on page load
                fetchComments();

                // Handle comment form submission
                $('#comment-form').on('submit', function(e) {
                    e.preventDefault();

                    // Get form data
                    const formData = {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        website: $('#website').val(),
                        message: $('#message').val(),
                        blog_id: $(this).data('id')
                    };

                    // Validate required fields
                    if (!formData.name || !formData.email || !formData.message) {
                        alert('Please fill in all required fields');
                        return;
                    }

                    // Submit comment via AJAX
                    $.ajax({
                        url: 'submit-comments.php', // Your backend endpoint
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                // Clear form
                                $('#comment-form')[0].reset();

                                // Add new comment to DOM
                                addCommentToDOM(response.comment);

                                // Update comment count
                                updateCommentCount(1);
                                showNotification('Comment Successfully Added!', 'success');
                                fetchComments();
                            } else {
                                // alert('Error: ' + response.message);
                                showNotification('Error: ' + response.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred: ' + error);
                            showNotification('An error occurred: ' + error, 'error');
                        }
                    });
                });

                // Function to fetch comments
                function fetchComments() {
                    const blogId = $('#comment-form').data('id');

                    $.ajax({
                        url: 'fetch-comments.php?blog_id=' + blogId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                // Clear existing comments (optional)
                                $('.comment-section').not(':first').remove();


                                // In your fetchComments success callback:
                                $('#comment-sections').empty(); // Clear all existing comments
                                response.comments.forEach(comment => {
                                    addCommentToDOM(comment);
                                });


                                // Update comment count
                                updateCommentCount(response.comments.length);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching comments:', error);
                            showNotification('Error fetching comments: ' + error, 'error');
                        }
                    });
                }

                // Function to add comment to DOM
                function addCommentToDOM(comment) {
                    const dateObj = new Date(comment.created_at);
                    const dateStr = dateObj.toLocaleDateString('en-US', {
                        weekday: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });
                    const timeStr = dateObj.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    const commentHtml = `
                        <div class="comment-section mt-4">
                            <div class="comment-img d-none d-lg-block">
                                <img src="assets/img/blog/temp.png" class="com-img img-responsive" alt="">
                            </div>
                            <div class="comment-area">
                                <h5>${comment.name}</h5>
                                <span class="date">
                                    <i class="fa-solid fa-calendar-days text-orange"></i>
                                    ${dateStr}
                                </span>
                                <span class="time">
                                    <i class="fa-solid fa-clock text-orange"></i>
                                    ${timeStr}
                                </span>
                                <p class="comment-description mt-2">
                                    ${comment.message}
                                </p>
                            </div>
                        </div>
                    `;

                    // Append new comment to container (changed from prepend to append)
                    $('#comment-sections').append(commentHtml);
                }

                // Function to update comment count
                function updateCommentCount(count) {
                    $('#comment-count').text(count);
                }
            });
        });
    </script>



</body>

</html>