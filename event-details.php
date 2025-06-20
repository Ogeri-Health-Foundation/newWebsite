<?php
session_start();
require 'api/Database/DatabaseConn.php'; 

$event_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$event_id) {
    die("<p>Error: Invalid event ID.</p>");
}

try {
    $db = new DatabaseConn();
    $dbh = $db->connect();

    $query = "SELECT * FROM events WHERE event_id = :id LIMIT 1";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $event_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $event = $stmt->fetch(PDO::FETCH_ASSOC);
        $eventName = htmlspecialchars($event['title']);
        $description = htmlspecialchars($event['description']);
        $body = htmlspecialchars($event['body']);
        $date = date("M j, Y", strtotime($event['date']));
        $image = htmlspecialchars($event['banner_image']);
        $eventid = htmlspecialchars($event['event_id']);
    } else {
        die("<p>Error: Event not found.</p>");
    }

    $query = "SELECT img_path FROM event_galleries WHERE event_id = :id";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $event_images = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    $galleryImages = [];
    foreach ($event_images as $img) {
        $galleryImages[] = htmlspecialchars($img['img_path']);
    }

    if (empty($galleryImages) && !empty($image)) {
        $galleryImages[] = $image;
    }

} catch (Exception $e) {
    die("<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>");
}
?>

<?php

    $page_title = "Ogeri Health Foundation - Blog Details";

    $page_author = "Olayinka!";

    $page_description = "";

    $page_rel = '';

    $page_name = 'Blog Details';

    $customs = array(
                "stylesheets" => ["assets/css/event-details.css"],
                "scripts" => ["admin/assets/js/demo.js"]
               );

    $addons = array(
                "stylesheets" => ["https://some-external-url.css"],
                "scripts" => ["https://some-external-url.js"]
               );

?>

<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">

<head>
    <?php include 'include/head.php'; ?>
   

</head>

<body>

<style>
  img.global-stylee{
    height: 550px;
    width: 100%;
  }
  img.little-img{
    width: 100%;
    height: 60px;
  }
  @media (max-width: 763px){
    img.global-stylee{
    height: 300px;
  }
  }
</style>

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
<div class="breadcumb-wrapper " data-bg-src="assets/img/about/DSC_1335.jpg" data-overlay="theme">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Event Details</h1>
            <ul class="breadcumb-menu">
                <li><a href="index.php">Home</a></li>
                <li>Events</li>
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
                        <img src="uploads/<?= $image ?>" class="global-stylee" alt="Event Image">
                        </div>
                        <div class="blog-content">
                        <div class="blog-meta">
                            <a href="events.php"><i class="fas fa-calendar-days"></i> <?= $date ?></a>
                           
                        </div>

                          
<!-- Image Gallery -->
<div class="overlay" id="galleryOverlay">
    <div class="carousel-container">
        <span class="close-btn" onclick="closeGallery()">&times;</span>
        <div id="demo" class="carousel slide" data-bs-ride="carousel">
            
            
            <div class="carousel-indicators">
    <?php foreach ($galleryImages as $index => $img): ?>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></button>
    <?php endforeach; ?>
</div>

<div class="carousel-inner">
    <?php foreach ($galleryImages as $index => $img): ?>
        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <img src="uploads/<?= $img ?>" alt="Gallery Image" class="d-block w-100">
        </div>
           <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</div>

                            <h2 class="blog-title"><?= $eventName ?></h2>
                            <p><?= $body ?></p>
                            <?php
                            $db = new DatabaseConn();
                            $dbh = $db->connect();
                            $eventId = $_GET['id'];
                            $stmt = $dbh->prepare("SELECT status FROM events WHERE event_id = :event_id");
                            $stmt->bindParam(":event_id", $eventId);
                            $stmt->execute();
                            if($stmt->rowCount() > 0){
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            if($result['status'] === "completed"){
                                echo "<a href='#' class='view-gallery' onclick='openGallery()'>Click here to view Gallery</a>";
                            }
                            else {
                              echo "";
                            }
                            }
                           
                            ?>
                            <div class="share-links clearfix ">
                                <div class="row justify-content-between">
                                    <!-- <div class="col-md-auto">
                                        <span class="share-links-title">Tags:</span>
                                        <div class="tagcloud">
                                            <a href="events.php">Donations</a>
                                            <a href="events.php">Educations</a>
                                        </div>
                                    </div> -->
                                    <?php
                                        $eventUrl = "https://" . $_SERVER['HTTP_HOST'] . "/event-details.php?id=" . urlencode($event['event_id']);
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
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
                                    <a href="events.php">Donations</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                                <li>
                                    <a href="events.php">Educations</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                                <li>
                                    <a href="events.php">Fundraising</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                                <li>
                                    <a href="events.php">Foods</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                                <li>
                                    <a href="events.php">Medical Help</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                                <li>
                                    <a href="events.php">Water Support</a>
                                    <span><i class="fas fa-arrow-right"></i></span>
                                </li>
                            </ul>
                        </div> -->
                        <!-- //Recent Posts -->
                        <div class="widget">
                            <h3 class="widget_title">Recent Events</h3>

                            <div class="recent-post-wrap">
                                <?php
                                try {
                                    if (!isset($dbh)) {
                                        throw new Exception("Database connection not found.");
                                    }

                                    // Fetch the three most recent events
                                    $query = "SELECT * FROM events ORDER BY date DESC LIMIT 3";
                                    $stmt = $dbh->prepare($query);
                                    $stmt->execute();

                                    if ($stmt->rowCount() > 0) {
                                        while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $eventName = htmlspecialchars($event['title']);
                                            $eventDate = date("F, Y", strtotime($event['date']));
                                            $image = !empty($event['banner_image']) ? "uploads/" . htmlspecialchars($event['banner_image']) : "assets/img/default-image.jpg";
                                            $eventid = htmlspecialchars($event['event_id']);
                                ?>
                                            <div class="recent-post">
                                                <div class="media-img">
                                                    <a href="event-details.php?id=<?= $eventid ?>">
                                                        <img src="<?= $image ?>" class="little-img" alt="Blog Image" />
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
                                <a href="events.php">Donations</a>
                                <a href="events.php">Help</a>
                                <a href="events.php">Foods</a>
                                <a href="events.php">Educations</a>
                                <a href=    "events.php">Fundraising</a>
                                <a href="events.php">Tips</a>
                            </div>
                        </div> -->
                    </aside>
                </div>
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
    function openGallery() {
        document.getElementById("galleryOverlay").style.display = "flex";
    }

    function closeGallery() {
        document.getElementById("galleryOverlay").style.display = "none";
    }
</script>

</body>

</html>