<?php
session_start();
require 'api/Database/DatabaseConn.php';

// Create an instance of DatabaseConn and establish connection
$db = new DatabaseConn();
$dbh = $db->connect();
?>

<?php

$page_title = "Ogeri Health Foundation - Donations";

$page_author = "Callistus";

$page_description = "";

$page_rel = '';

$page_name = 'partnership2.php';

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
    <title>Partnerships=</title>
</head>

<body>
    <!-- ==========Header-section=========== -->
    <div id="partnership-hero">
        <p>Partner With Us</p>
        <button class="btn">
            Partner With Us
        </button>
    </div>

    <!-- =============Body-section============== -->
    <section class="parther-body">
        <div class="body-title">
            <h2>Our Core Programs</h2>
            <p>At The Heart Of Our Mission—Programs That Make A Lasting Difference. </p>
        </div>
        <div class="container">
            <div class="img-container">
                <img src="./assets/img/Frame 2147226508.png" alt="" srcset="">
            </div>
            <div class="text-container text-arrangement">
                <h2>Communitiy Health Outreach</h2>
                <p>We bring free health checks, education, and medical support directly to communities.<br>
                    <strong> Blood Pressure Checks</strong> – High blood pressure is a leading cause of heart disease
                    and stroke, yet many
                    people remain unaware of their risk. Our BP screenings help with early detection, allowing
                    individuals
                    to take control of their health before complications arise.<br>
                    <strong>Health Education</strong> –Simple, practical advice on staying healthy. Knowledge is key to
                    preventing
                    disease. Through interactive health talks, community workshops, and one-on-one discussions, we
                    provide simple, practical guidance on healthy eating, physical activity, and managing conditions
                    like hypertension.<br>
                    <strong> Consultations & Referrals</strong> –Connecting patients with doctors when needed. Our team
                    of trained health
                    workers provides basic medical consultations and refer individuals with doctors, specialists, and
                    healthcare facilities when further care is needed. We ensure that those at risk receive timely
                    interventions before conditions worsen.
                </p>
            </div>
        </div>

        <div class="container-1">
            <div class="text-container-1">
                <h2>Heart Health Awareness</h2>
                <p>We teach people how to protect their hearts through engaging programs like: <br>
                    <strong>School Science Quizzes</strong> – Making heart health fun and educational for kids.<br>
                    <strong>Community Talks & Digital Resources</strong> – Sharing easy-to-understand tips on diet,
                    exercise, and
                    lifestyle.<br>
                    <strong>Adult Health Literacy</strong>– Simplifying complex health information so everyone can take
                    control of their
                    well-being.
                </p>
            </div>
            <div class="img-container">
                <img src="./assets/img/Frame 2147226508 (1).png" alt="" srcset="">
            </div>
        </div>

        <div class="container">
            <div class="img-container">
                <img src="./assets/img/Frame 2147226508 (2).png" alt="" srcset="">
            </div>
            <div class="text-container">
                <h2>Heart Health Awareness</h2>
                <p>We teach people how to protect their hearts through engaging programs like:<br>
                    <strong> School Science Quizzes</strong> – Making heart health fun and educational for kids. <br>
                    <strong>Community Talks & Digital Resources</strong> – Sharing easy-to-understand tips on diet,
                    exercise, and
                    lifestyle. <br>
                    <strong>Adult Health Literacy</strong> – Simplifying complex health information so everyone can take
                    control of their
                    well-being.
                </p>
            </div>
        </div>

        <div class="container-1">
            <div class="text-container-1">
                <h2>Partnerships & Advocacy</h2>
                <p><strong>Solutions</strong> - We co-create programs with local communities, ensuring that our
                    initiatives are relevant, practical, and sustainable.<br>
                    <strong>Collaborating for Impact</strong> – We work alongside doctors, health providers, and
                    policymakers to
                    strengthen healthcare systems and improve access to quality care.
                </p>
            </div>
            <div class="img-container">
                <img src="./assets/img/Frame 2147226508 (3).png" alt="" srcset="">
            </div>
        </div>

        <div class="container">
            <div class="img-container">
                <img src="./assets/img/Frame 2147226508 (4).png" alt="" srcset="">
            </div>
            <div class="text-container">
                <h2>Research & Innovation</h2>
                <p><strong>Improving Community Health</strong> – We collaborate with experts to develop solutions
                    tailored to the real
                    health challenges faced by our communities. <br>
                    <strong>Evidence-Driven Approach</strong> – Our programs are shaped by insights from our outreach
                    efforts, ensuring
                    we continuously improve and deliver the most effective care.
                </p>
            </div>
        </div>
    </section>

    <div class="banner">
        <h2>Technical Statistics</h2>

        <div class="box">
            <div class="box-1">
                <span>257+</span>
                <p>People screened</p>
            </div>
            <div class="box-1">
                <span>11+</span>
                <p>Health Outreaches</p>
            </div>
            <div class="box-1">
                <span>90+</span>
                <p>Patients Diagnosed With <br>High Blood pressure</p>
            </div>
        </div>
    </div>

    <div class="work_process">
        <div class="title-bar">
            <p id="text-top">Work Process</p>
            <p id="text-buttom">Our Donating Work Process</p>
        </div>
        <div class="group_circle">
            <div class="circle">
                <img src="./assets/img/icon/image 1.svg" alt="">
                <h2>Awareness & Engagement</h2>
                <p>To inform and engage potential donors and supporters about the charity’s mission and the cause it
                    supports. Utilize various channels such as social media</p>
            </div>
            <div class="circle-1">
                <img src="./assets/img/icon/image 2.svg" alt="">
                <h2>Donation Collection</h2>
                <p>Set up a secure and user-friendly online donation platform that accepts multiple payment methods and
                    allows for both one-time and recurring donations.</p>
            </div>
            <div class="circle">
                <img src="./assets/img/icon/image 3.png" alt="">
                <h2>Impact and Accountability</h2>
                <p>Allocate funds to specific projects and initiatives that align with the charity’s mission, ensuring
                    that resources are used efficiently and effectively.</p>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="form-title">
            <span>Get Started and Partner with us today</span>
            <p>Partner with us today and become a vital part of a mission that uplifts lives, strengthens communities,
                and brings hope to those who need it most. Whether you’re giving your time, resources, or
                expertise—every contribution counts, and together, we can make a lasting impact.</p>
        </div>

        <div class="form">
            <div class="form-container">
                <form action="#" method="post">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required placeholder="Enter Your Full Name" />

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email address" />

                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number" />

                    <label for="company">Company</label>
                    <input type="text" id="company" name="company" required placeholder="Company" />

                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="9" required placeholder="Message..."></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>