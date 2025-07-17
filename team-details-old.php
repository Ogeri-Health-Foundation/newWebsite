<?php
session_start();
require 'api/Database/DatabaseConn.php'; 

$volunteer_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$volunteer_id) {
    die("<p>Error: Invalid Volunteer ID.</p>");
}

try {
    $db = new DatabaseConn();
    $dbh = $db->connect();

    $query = "SELECT * FROM volunteers WHERE id = :id LIMIT 1";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $volunteer_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $volunteer = $stmt->fetch(PDO::FETCH_ASSOC);
        $volunteerName = htmlspecialchars($volunteer['name']);
        $email = htmlspecialchars($volunteer['email']);
        $Aboutbody = htmlspecialchars($volunteer['bio']);
        $phone = htmlspecialchars($volunteer['phone']);
        $profession = htmlspecialchars($volunteer['profession']);
        $role = htmlspecialchars($volunteer['role']);
        $gender = htmlspecialchars($volunteer['gender']);
        $motivation = htmlspecialchars($volunteer['motivation']);
        $profilePicture = htmlspecialchars($volunteer['profile_picture']);
        $volunteerid = htmlspecialchars($volunteer['volunteer_id']);

        $instagram = htmlspecialchars($volunteer['instagram']);
        $facebook = htmlspecialchars($volunteer['facebook']);
        $linkedin = htmlspecialchars($volunteer['linkedin']);
        $twitter = htmlspecialchars($volunteer['twitter']);

    } else {
        die("<p>Error: Volunteer not found.</p>");
    }

   
} catch (Exception $e) {
    die("<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>");
}
?>


<?php

    $page_title = "Ogeri Health Foundation - Volunteer Details";

    $page_author = "Okibe!";

    $page_description = "";

    $page_rel = '';

    $page_name = 'team-details.php';

    $customs = array(
                "stylesheets" => ["assets/css/demo.css"],
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
    <div class="breadcumb-wrapper" data-bg-src="assets/img/partnership.jpg" data-overlay="theme">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Volunteer Details</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li>Volunteer Details</li>
                </ul>
            </div>
        </div>
    </div><!--==============================
Team Area  
==============================-->
    <section class="space">
        <div class="container">
            <div class="team-details-wrap mb-80">
                <div class="row gx-60 gy-40">
                    <div class="col-xl-5">
                        <?php
                        $primaryPath = "volunteer_uploads/profiles/" . $profilePicture;
                        $fallbackPath = "admin/assets/images/volunteer-img-uploads/" . $profilePicture;
                        
                        if (file_exists($primaryPath)) {
                            $imgSrc = "https://ogerihealth.org/" . $primaryPath;
                        } else {
                            $imgSrc = "https://ogerihealth.org/" . $fallbackPath;
                        }
                        ?>
                        
                        <div class="about-card-img">
                            <img src="<?= htmlspecialchars($imgSrc) ?>" alt="team image">
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="about-card">
                            <div class="about-card-title-wrap">
                                <div class="media-left">
                                    <h2 class="h3 about-card_title mt-n2"><?= $volunteerName ?></h2>
                                    <p class="about-card_desig"><?= $profession?></p>
                                </div>
                                <div class="th-social style4">
    <?php
   
    if (isset($facebook) && !empty($facebook)) {
        echo '<a target="_blank" href="' . htmlspecialchars($facebook) . '"><i class="fab fa-facebook-f"></i></a>';
    }
    
    if (isset($twitter) && !empty($twitter)) {
        echo '<a target="_blank" href="' . htmlspecialchars($twitter) . '"><i class="fab fa-twitter"></i></a>';
    }
    
    if (isset($instagram) && !empty($instagram)) {
        echo '<a target="_blank" href="' . htmlspecialchars($instagram) . '"><i class="fab fa-instagram"></i></a>';
    }
    
    if (isset($linkedin) && !empty($linkedin)) {
        echo '<a target="_blank" href="' . htmlspecialchars($linkedin) . '"><i class="fab fa-linkedin"></i></a>';
    }
    ?>
</div>
                            </div>

                            <p class="about-card_text"><?= $Aboutbody ?></p>
                            <div class="team-details-about-info">
                                <div class="about-contact">
                                    <div class="icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="media-left">
                                        <h6 class="about-contact-title">Gender</h6>
                                        <p class="about-contact-text"><?= $gender ?></p>
                                    </div>
                                </div>
                                <div class="about-contact">
                                    <div class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="media-left">
                                        <h6 class="about-contact-title">Email Address</h6>
                                        <a href="mailto:<?= $email ?>" class="about-contact-text"><?= $email ?></a>
                                    </div>
                                </div>
                                <div class="about-contact">
                                    <div class="icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="media-left">
                                        <h6 class="about-contact-title">Phone Number</h6>

                                        <?php
                                            if(!$phone){
                                                echo "<p>Not Provided</p>";
                                            }
                                        ?>
                                        <a href="tel:<?= $phone ?>" class="about-contact-text"><?= $phone ?></a>
                                    </div>
                                </div>
                                <div class="about-contact">
                                    <div class="icon">
                                        <i class="fas fa-fax"></i>
                                    </div>
                                    <div class="media-left">
                                        <h6 class="about-contact-title">Profession</h6>
                                        <!-- <a href="tel:2565862169581" class="about-contact-text">+2568145632</a> -->
                                        <a class="about-contact-text"><?= $profession?></a>
                                    </div>
                                </div>
                            </div>
                            <a href="contact.html" class="th-btn">Contact Me <i class="fas fa-arrow-up-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-40">
                <div class="col-xl-6">
                    <h3 class="title mt-n2 mb-25"><?= $role ?></h3>
                    <?php
                        if(!$motivation){
                            echo "<p>This Volunteer dosen't have a bio data</p>";
                        }
                        else{
                            echo "<p>$motivation</p>";
                        }
                    ?>
                    
                                    </div>
                                    <div class="col-xl-6">
    <h3 class="title mt-n2 mb-25">Personal Skills</h3>
    
    <div class="skills-container">
        <?php
        $query = "SELECT * FROM volunteers WHERE volunteer_id = :id LIMIT 1";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id', $volunteer_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $volunteer = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Decode the JSON skills array
            $skills = json_decode($volunteer['skills'], true);
            
            if ($skills && is_array($skills)) {
                foreach ($skills as $skill) {
                    $skill = htmlspecialchars($skill);
                    echo "<div class='skill-badge'>
                            <span class='skill-icon'>★</span>
                            <span class='skill-text'>{$skill}</span>
                          </div>";
                }
            } else {
                echo "<p>No skills found.</p>";
            }
        } else {
            echo "<p>Volunteer not found.</p>";
        }
        ?>
    </div>
            </div>
        </div>
    </section>

    <style>
        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
        }
        
        .skill-badge {
            display: flex;
            align-items: center;
            padding: 10px 18px;
            background: linear-gradient(to right, #f7f7f7, #eaeaea);
            border-radius: 30px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .skill-badge:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .skill-icon {
            color: #FFAC00;
            margin-right: 8px;
            font-size: 14px;
        }
        
        .skill-text {
            font-weight: 500;
            font-size: 14px;
            color: #444;
            text-transform: capitalize;
        }
    </style>
    <!--==============================
Brand Area  
==============================-->
    <div class="space-bottom overflow-hidden brand-area-1">
        <div class="container">
            <div class="brand-wrap1 p-0 m-0 text-center">
                <h3 class="brand-wrap-title">Trusted by over <span class="text-theme2"><span class="counter-number">90</span>K+</span> companies worldwide</h3>
                <div class="swiper th-slider" id="brandSlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"},"1400":{"slidesPerView":"5", "spaceBetween": "90"}}}'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-1.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-2.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-3.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-4.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-5.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-1.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-2.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-3.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-4.svg" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="blog.html" class="brand-box">
                                <img src="assets/img/brand/brand1-5.svg" alt="Brand Logo">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
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