<?php
session_start();
require 'api/Database/DatabaseConn.php';

// Create an instance of DatabaseConn and establish connection
$db = new DatabaseConn();
$dbh = $db->connect();
?>

<?php

$page_title = "Ogeri Health Foundation - Contact Us";

$page_author = "Callistus";

$page_description = "";

$page_rel = '';

$page_name = 'index.php';

$customs = array(
    "stylesheets" => ["assets/css/demo.css"],
    "scripts" => ["admin/assets/js/demo.js"]
);

$addons = array(
    "stylesheets" => ["https://some-external-url.css"],
    "scripts" => ["https://some-external-url.js"]
);

?>


<head>
    <?php include 'include/header2.php'; ?>
</head>


<div id="contact-hero">
    <div class="header-container">
        <a href="#">Home</a>
        <img src="./assets/img/icon/Chevron_Right.svg" alt="" srcset="">
        <a href="#">Contact Us</a>
        <img src="./assets/img/icon/Chevron_Right.svg" alt="" srcset="">
    </div>
    <p>Contact Us </p>
</div>

<section class="contact-container">
    <div class="contact-content">
        <span>Contact Us</span>
        <p>We are Open For Any Suggestion Or Just To Have A Chat</p>
    </div>

    <div class="contact">
        <div class="contact-details">
            <img src="./assets/img/icon/Address.svg" alt="">
            <div class="contact-info">
                <span>Address</span>
                <p>Afikpo, Nigeria</p>
            </div>
        </div>
        <div class="contact-details">
            <img src="./assets/img/icon/Email.svg" alt="">
            <div class="contact-info con">
                <span>Email</span>
                <p>info@ogerihealth.org </p>
            </div>
        </div>
        <div class="contact-details">
            <img src="./assets/img/icon/Phone.svg" alt="">
            <div class="contact-info con">
                <span>Phone</span>
                <p>+2345678910</p>
            </div>
        </div>
    </div>

    <div class="form-container">
        <form action="#" method="post">
            <div class="input-row">
                <input type="text" placeholder="Name" required />
                <input type="email" placeholder="Email" required />
                <input type="text" placeholder="Subject" required />
            </div>
            <textarea placeholder="Create Message Here"></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
</section>

</html>