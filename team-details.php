<?php
session_start();
require 'api/Database/DatabaseConn.php';

// Create an instance of DatabaseConn and establish connection
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
        $volunteerid = htmlspecialchars($volunteer['id']);

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

$page_author = "Callistus";

$page_description = ""; 

$page_rel = '';

$page_name = 'team-details2.php';

$customs = array(
    "stylesheets" => ["assets/css/volunteer-details.css"],
    "scripts" => ["assets/js/main2.js"]
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
    <title>Volunteer Details</title>
</head>

<body>
    <!-- ==========Header-section=========== -->
     <?php include 'include/header.php'; ?>
    <div id="v-details-hero">
        <p>Volunteer’s Details</p>
    </div>

    <!-- =============Body-section============== -->
    <section class="volunteer-details">
        <div class="container">
            <div class="main_box">
                <div class="box_1">
                    <?php
                            $primaryPath = "volunteer_uploads/profiles/" . $profilePicture;
                            $fallbackPath = "admin/assets/images/volunteer-img-uploads/" . $profilePicture;

                            if (file_exists($primaryPath)) {
                                $imgSrc =  $primaryPath;
                            } else {
                                $imgSrc = $fallbackPath;
                            }
                            ?>
                    <img src="<?= htmlspecialchars($imgSrc) ?>" alt="">
                </div>
                <div class="box_2">
                    <div class="box_2_content">
                        <div class="name">
                            <p><?= $volunteerName ?></p>
                            <span><?= $profession?></span>
                        </div>
                        <div class="social_icons">
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
                    <div class="box_2_text">
                        <p><?= $Aboutbody ?>
                        </p>
                    </div>

                    <div class="box_2_bottom">
                        <div class="box_2_div">
                            <div class="box_2_detail">
                                <div class="box_2_icon">
                                    <img src="./assets/img/icon/profile icon.svg" alt="" srcset="">
                                </div>
                                <div class="box_2_info">
                                    <p class="box_2_gen">Gender</p>
                                    <p class="box_2_gen2"><?= $gender ?></p>
                                </div>
                            </div>
                            <div class="box_2_detail1">
                                <div class="box_2_icon">
                                    <img src="assets/img/icon/email-icon.png" alt="" srcset="">
                                </div>
                                <div class="box_2_info">
                                    <p class="box_2_gen">Email Address</p>
                                    <p class="box_2_gen2"><a href="mailto:<?= $email ?>" class="about-contact-text"><?= $email ?></a></p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="box_2_div">
                            <div class="box_2_detail2">
                                <div class="box_2_icon">
                                    <img src="./assets/img/icon/famicons_call.svg" alt="" srcset="">
                                </div>
                                <div class="box_2_info">
                                    <p class="box_2_gen">Phone Number</p>
                                    <p class="box_2_gen2">
                                        <?php
                                                if(!$phone){
                                                    echo "<p class='box_2_gen2'>Not Provided</p>";
                                                }
                                            ?>
                                        <a href="tel:<?= $phone ?>" class="about-contact-text"><?= $phone ?></a>
                                    </p>
                                    
                                        
                                </div>
                            </div>
                            <div class="box_2_detail3">
                                <div class="box_2_icon">
                                    <img src="./assets/img/icon/solar_case-bold.svg" alt="" srcset="">
                                </div>
                                <div class="box_2_info">
                                    <p class="box_2_gen">Profession</p>
                                    <p class="box_2_gen2"><?= $profession?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="th-btn style3 d-lg-block text-white mt-4 mx-auto">
                        <a href="tel:<?= $phone ?>" class="about-contact-text text-white">Contact me </a>
                        <img src="./assets/img/icon/Vector arrow.svg" alt="">
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- =============Footer-section============== -->  
     <?php include 'include/footer.php'; ?>
</body>

</html>