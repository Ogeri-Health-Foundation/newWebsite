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
        $location = htmlspecialchars($event['location']);
        $description = htmlspecialchars($event['description']);
        $body = htmlspecialchars($event['body']);
        $date = date("M j, Y", strtotime($event['date']));
        $time = DateTime::createFromFormat("H:i:s.u", $event['time']);
        $image = htmlspecialchars($event['banner_image']);
        $eventid = htmlspecialchars($event['event_id']);

        $eventDate = $event['date']; // e.g., "Jul 25, 2025" or "2025-07-25"
        // If your time is "1:46 PM" or "13:46:00"
        $eventTime = $event['time']; // e.g., "1:46 PM" or "13:46:00"
        // Create the complete datetime string
        $dateTimeString = $eventDate . ' ' . $eventTime;
        // Create DateTime object directly from the combined string
        $eventDateTime = new DateTime($dateTimeString);
        // Get the target timestamp for JavaScript
        $targetTimestamp = $eventDateTime->getTimestamp() * 1000;
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

    // if (empty($galleryImages) && !empty($image)) {
    //     $galleryImages[] = $image;
    // }
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

    <script src="https://kit.fontawesome.com/706f90924a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/blog.css">

</head>

<body>

    <style>
        img.global-stylee {
            height: 550px;
            width: 100%;
        }

        img.little-img {
            width: 100%;
            height: 60px;
        }

        @media (max-width: 763px) {
            img.global-stylee {
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


    <!-- header section starts -->
    <section class="headers position-relative text-white">
        <img src="uploads/<?= $image ?>" class="header-img img-fluid" alt="header-img">

        <div class="header-details">
            <a href="./" class="text-white text-decoration-none">Home &gt;</a>
            <span>Event</span>
            <h1 class="ohf_font text-white"><?= 'Event Details' ?></h1>
        </div>
        <!-- Days Left Box -->
    </section>

    <!-- Move this OUTSIDE .headers for more control -->
    <div class="daysleft ohf_font text-orange">
        <section class="day">
            <h3 class="pt-3" id="days">00</h3>
            <p>days</p>
        </section>
        <section class="hours">
            <h3 class="pt-3" id="hours">00</h3>
            <p>hours</p>
        </section>
        <section class="minutes">
            <h3 class="pt-3" id="minutes">00</h3>
            <p>minutes</p>
        </section>
        <section class="seconds">
            <h3 class="pt-3" id="seconds">00</h3>
            <p>seconds</p>
        </section>
    </div>
    <!-- header section ends -->


    <section class="event-details container mb-4">
        <div class="row">
            <div class="col-12">
                <div class="events d-flex justify-content-between align-items-center">
                    <div class="title">
                        <h2 class="ohf_font text-orange"><?= $eventName ?></h2>
                        <div>
                            <i class="fa-solid fa-location-dot me-2 text-green"></i>
                            <?= $location ?>
                        </div>
                        <div>
                            <i class="fa-solid fa-calendar me-2 text-green"></i>
                            <?= $date ?>
                        </div>
                        <div>
                            <i class="fa-solid fa-clock me-2 text-green"></i>
                            <?= $time->format("g:i A"); ?> Prompt
                        </div>
                    </div>
                    <div class="logo d-none d-md-block">
                        <img src="./assets/img/logo-2.png" alt="" class="img-fluid img-responsive">
                    </div>
                </div>


                <div class="event-descriptino mt-4">
                    <h5 class="ohf_font text-orange">Event Description</h5>

                    <p>
                        <?= htmlspecialchars_decode($body); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- blog container title starts -->

    <?php
    $db = new DatabaseConn();
    $dbh = $db->connect();
    $eventId = $_GET['id'];
    $stmt = $dbh->prepare("SELECT status FROM events WHERE event_id = :event_id");
    $stmt->bindParam(":event_id", $eventId);
    $stmt->execute();
    if ($stmt->rowCount() > 0) :
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['status'] === "completed"): ?>
            <section class="blog-container container">
                <div class="container py-5">
                    <?php
                    if (!empty($galleryImages)) {
                        echo '<h2 class="text-start text-orange mb-4"> Snapshot of: ' . $eventName . '</h2>';
                    }
                    ?>

                    <div class="row" data-masonry='{"percentPosition": true }'>
                        <?php foreach ($galleryImages as $index => $img): ?>

                            <div class="col-6 col-md-4 mb-4">
                                <img src="./uploads/events/<?= $img ?>" class="img-fluid rounded" alt="">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </section>
    <?php endif;
    endif;

    ?>




    <section class="blog-container container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="blog-recent d-flex justify-content-start align-content-center mb-3">
                    <div class="recent-title">
                        <h3 class="ohf_font text-orange">Upcoming Events</h3>
                    </div>
                </div>

                <!-- BLOG LIST starts -->
                <div class="row row-cols-1 row-cols-md-3 g-3 mb-5">
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
                                $location = htmlspecialchars($event['location']);
                                $description = htmlspecialchars($event['description']);
                                $time = DateTime::createFromFormat("H:i:s.u", $event['time']);
                                $eventDate = date("M j, Y", strtotime($event['date']));
                                $image = !empty($event['banner_image']) ? "uploads/" . htmlspecialchars($event['banner_image']) : "assets/img/default-image.jpg";
                                $eventid = htmlspecialchars($event['event_id']);
                    ?>
                                <div class="col-12 col-md-4">
                                    <div class="card h-100 text-white position-relative overflow-hidden">
                                        <img src="<?= $image ?>" class="card-img" alt="..."
                                            style="height:320px; object-fit: cover;">

                                        <h6 class="text-white position-absolute" style="top: 20px;left: 20px; z-index: 2;">Upcoming
                                            Event</h6>

                                        <!-- Dark overlay -->
                                        <div class="position-absolute top-0 start-0 w-100 h-100"
                                            style="background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>

                                        <!-- Content -->
                                        <div class="card-img-overlay d-flex flex-column justify-content-end" style="z-index: 2;">
                                            <h5 class="card-title">
                                                <a href="event-details.php?id=<?= $eventid ?>" class="text-decoration-none event-hover"> <?= $eventName ?></a>
                                            </h5>
                                            <p class="card-text event-descrip text-white">
                                                <?php echo strlen($description) > 160 ? substr($description, 0, 140) . "..." : $description; ?>
                                            </p>
                                            <p class="card-text event-descrip text-white">
                                                <small><?= $location ?></small>
                                                <br>
                                                <small><?= $eventDate ?> | <?= $time->format("g:i A"); ?> prompt</small>
                                            </p>
                                        </div>
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
                <!-- BLOG LIST ends -->
            </div>
        </div>
    </section>
    <!-- blog container title starts -->


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
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

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

        const targetDate = <?php echo $targetTimestamp; ?>;

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            // If countdown has ended, display zeros
            if (distance < 0) {
                document.getElementById("days").textContent = "00";
                document.getElementById("hours").textContent = "00";
                document.getElementById("minutes").textContent = "00";
                document.getElementById("seconds").textContent = "00";
                return;
            }

            // Calculate time units
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Format with leading zeros and update display
            document.getElementById("days").textContent = String(days).padStart(2, '0');
            document.getElementById("hours").textContent = String(hours).padStart(2, '0');
            document.getElementById("minutes").textContent = String(minutes).padStart(2, '0');
            document.getElementById("seconds").textContent = String(seconds).padStart(2, '0');
        }

        // Update countdown immediately
        updateCountdown();

        // Update countdown every second
        setInterval(updateCountdown, 1000);
    </script>


</body>

</html>