<?php
session_start();
require 'api/Database/DatabaseConn.php';

// Create an instance of DatabaseConn and establish connection
$db = new DatabaseConn();
$dbh = $db->connect();
?>

<?php

$page_title = "Ogeri Health Foundation - Volunteer Details";

$page_author = "Callistus";

$page_description = "";

$page_rel = '';

$page_name = 'team-details2.php';

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
    <?php include 'include/header2.php'; ?>
    <title>Volunteer Details</title>
</head>

<body>
    <!-- ==========Header-section=========== -->
    <div id="v-details-hero">
        <p>Volunteer’s Details</p>
    </div>

    <!-- =============Body-section============== -->
    <section class="container">
        <div class="main_box">
            <div class="box_1">
                <img src="./assets/img/Frame 2147226497.svg" alt="">
            </div>
            <div class="box_2">
                <div class="box_2_content">
                    <div class="name">
                        <p>Jason Smith</p>
                        <span>Volunteer</span>
                    </div>
                    <div class="social_icons">
                        <img src="./assets/img/icon/uil_facebook-f.svg" alt="">
                        <img src="./assets/img/icon/ri_instagram-fill.svg" alt="">
                        <img src="./assets/img/icon/pajamas_twitter.svg" alt="">
                        <img src="./assets/img/icon/eva_linkedin-fill.svg" alt="">
                    </div>

                </div>
                <div class="box_2_text">
                    <p>My name is Jason Smith, and I believe that every little act truly matters.I am a licensed
                        pharmacist based in Lagos State, Nigeria. I hold a Bachelor of Pharmacy
                        (B.Pharm) degree from Lagos State University (LASU).
                        <br>
                        <br>
                        I’ve long admired the impactful work of the Ogeri Health Foundation—reaching out to
                        individuals in need, regardless of their background or status. This compassionate approach
                        deeply resonates with me, and I’m eager to be part of this mission.
                        <br>
                        <br>
                        As a healthcare professional, I am passionate about promoting wellness and making a
                        difference through service. I hope to contribute my knowledge, time, and support in any way
                        I can. I believe that even the smallest act of kindness can go a long way. Thank you for the
                        opportunity to be part of this great platform
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
                                <p class="box_2_gen2">Male</p>
                            </div>
                        </div>
                        <div class="box_2_detail1">
                            <div class="box_2_icon">
                                <img src="./assets/img/icon/email icon.png" alt="" srcset="">
                            </div>
                            <div class="box_2_info">
                                <p class="box_2_gen">Email Address</p>
                                <p class="box_2_gen2">jasonsmith@gmail.com</p>
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
                                <p class="box_2_gen2">09087655434</p>
                            </div>
                        </div>
                        <div class="box_2_detail3">
                            <div class="box_2_icon">
                                <img src="./assets/img/icon/solar_case-bold.svg" alt="" srcset="">
                            </div>
                            <div class="box_2_info">
                                <p class="box_2_gen">Profession</p>
                                <p class="box_2_gen2">Pharmacist</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="box_2_button">
                    <p>Contact Me</p>
                    <img src="./assets/img/icon/Vector arrow.svg" alt="">
                </button>
            </div>
        </div>
    </section>
</body>

</html>