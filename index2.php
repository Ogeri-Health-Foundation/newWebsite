<?php
session_start();
require 'api/Database/DatabaseConn.php';

// Create an instance of DatabaseConn and establish connection
$db = new DatabaseConn();
$dbh = $db->connect();
?>

<?php

$page_title = "Ogeri Health Foundation - Home";

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

<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">

<head>
    <?php include 'include/head.php'; ?>
</head>

<body>
     <?php include 'include/header2.php'; ?>

<!-- Hero section -->
    <section id="hero-section">

        <div id="hero-words">
            <p class="text-white"><span>-</span> Bringing Hope through Health</p>
            <h1 class="text-white">
                Building Healthier-Communities, <br> OneStep At A Time
            </h1>
            <p class="text-white">
                Take Action for Better Health: Explore, Support, and Join Us in Making a Difference Today!
            </p>

            <p class="hero-button"><a id="hero-button" href="#">Get Invloved <img src="./assets/img/icon/arrow-icon.svg" /></a></p>
        </div>
    </section>

    <section id="about-section">
        <div class="left">
            <h2 class="left-heading">About Us</h2>
            <h3 class="left-heading2">Welcome To The OGERI Health Foundation</h3>
            <p class="left-para">
                The Ogeri Health Foundation (OHF) is committed to improving public health in Nigeria, with a priority focus on underserved communities. By addressing preventive healthcare and chronic disease management, OHF seeks to expand its reach, promote transparency, and engage donors, volunteers, and beneficiaries in its mission.
            </p>
            <div id="mission-vision">
                <div class="mv">
                    <h3 class="left-heading2 m-h">Our Mission</h3>
                    <img src="./assets/img/icon/vision-icon.svg" />
                    <p class="left-para">
                        To improve health outcomes and empower communities across Africa, starting in Nigeria, by providing accessible healthcare solutions, advancing health education, and promoting preventive care to build healthier and self-reliant futures for all.
                    </p>
                </div>

                <div class="mv">
                    <h3 class="left-heading2 m-h">Our Vision</h3>
                    <img src="./assets/img/icon/mission-icon.svg" />
                    <p class="left-para">
                        A world where every individual has the knowledge, resources, and support to take control of their health, fostering empowered communities and healthier generations.
                    </p>
                </div>
            </div>
            <p class="hero-button">
                <a id="hero-button" href="#">Learn More <img src="./assets/img/icon/arrow-icon.svg" /></a>
            </p>
            <!-- get involved -->
            <div id="get-involved">
                <div class="get-involved">
                    <div class="donate-icon2-holder">
                        <img src="./assets/img/icon/donate-icon.svg" class="donate-icon2" />
                    </div>
                    <h3 class="left-heading2 donate-heading">Quick Fund Raising</h3>
                    <p class="left-para donate-para">
                        Join us in creating change by organizing or participating in a fundraising campaign. Together, we can make healthcare and education accessible to all.
                    </p>
                </div>
                <div class="get-involved middle">
                    <div class="donate-icon2-holder middle-holder">
                        <img src="./assets/img/icon/people-icon.svg" class="donate-icon2" />
                    </div>
                    <h3 class="left-heading2 donate-heading">Become A Volunteer</h3>
                    <p class="left-para donate-para">
                        Be part of our journey to build healthier communities. Share your time, skills, and passion to make a difference in the lives of those in need.
                    </p>
                </div>
                <div class="get-involved">
                    <div class="donate-icon2-holder">
                        <img src="./assets/img/icon/person-icon.svg" class="donate-icon2" />
                    </div>
                    <h3 class="left-heading2 donate-heading">Partner With Us</h3>
                    <p class="left-para donate-para">
                        Collaborate with us to expand our reach and amplify our impact. Let’s work together to bring sustainable health solutions to underserved communities.
                    </p>
                </div>
            </div>
        </div>
        <div class="right">
            <div id="top">
                <div id="make-donation">
                    <img src="./assets/img/icon/donate-icon.svg" alt="arrow-icon" class="donate-icon2" />
                    <h2>Make A Donation</h2>
                </div>
                <p>Your donation has the power to transform Lives</p>
            </div>
            <form>

            </form>
        </div>
    </section>

    <!-- Technical Statistics -->
    <section id="technical-statistics">
        <h2 class="heading">Technical Statistics</h2>

        <div id="statistics">
            <div class="statistics">

                <h2 class="stat-heading">257+</h2>
                <p class="stat-para">
                    People Screened
                </p>
            </div>
            <div class="statistics">

                <h2 class="stat-heading">11+</h2>
                <p class="stat-para">
                    Health Outreaches
                </p>
            </div>
            <div class="statistics">
                <h2 class="stat-heading">90+</h2>
                <p class="stat-para">
                    Patients Diagnosed With High Blood pressure
                </p>
            </div>
        </div>
    </section>

    <section id="programs-section">
        <div id="programs">
            <div class="programs">
                <img src="./assets/img/program.svg" alt="programs image" class="p-image" />
                <div class="p-image-holder">
                    <img src="./assets/img/icon/program-icon1.svg" alt="program icon" class="p-icon" />
                </div>
                <div class="p-texts">
                    <h4 class="p-heading">Community Outreach</h4>
                    <p class="p-para">
                        We bring free health checks, education, and medical support directly to communities.
                    </p>
                </div>
                <p class="hero-button">
                    <a id="hero-button" class="p-anchor" href="#">Learn More <img src="./assets/img/icon/arrow-icon.svg" /></a>
                </p>
            </div>


            <div class="programs">
                <img src="./assets/img/program.svg" alt="programs image" class="p-image" />
                <div class="p-image-holder">
                    <img src="./assets/img/icon/program-icon2.svg" alt="program icon" class="p-icon" />
                </div>
                <div class="p-texts">
                    <h4 class="p-heading">Partnership & Advocacy</h4>
                    <p class="p-para">
                        We co-create programs with local communities, ensuring that our initiatives are relevant, practical, and sustainable. </p>
                </div>
                <p class="hero-button">
                    <a id="hero-button" class="p-anchor" href="#">Learn More <img src="./assets/img/icon/arrow-icon.svg" /></a>
                </p>
            </div>
            <div class="programs">
                <img src="./assets/img/program.svg" alt="programs image" class="p-image" />
                <div class="p-image-holder">
                    <img src="./assets/img/icon/program-icon3.svg" alt="program icon" class="p-icon" />
                </div>
                <div class="p-texts">
                    <h4 class="p-heading">Research & Innovation</h4>
                    <p class="p-para">
                        Improving Community Health – We collaborate with experts to develop solutions tailored to the real health challenges faced by our communities.
                    </p>
                </div>
                <p class="hero-button">
                    <a id="hero-button" class="p-anchor" href="#">Learn More <img src="./assets/img/icon/arrow-icon.svg" /></a>
                </p>
            </div>

            <div class="programs">
                <img src="./assets/img/program.svg" alt="programs image" class="p-image" />
                <div class="p-image-holder">
                    <img src="./assets/img/icon/program-icon4.svg" alt="program icon" class="p-icon" />
                </div>
                <div class="p-texts">
                    <h4 class="p-heading">Heart Health Awareness</h4>
                    <p class="p-para">
                        We teach people how to protect their hearts through engaging programs like: School Science Quizzes, Community Talks & Digital Resources and adult Literacy
                    </p>
                </div>
                <p class="hero-button">
                    <a id="hero-button" class="p-anchor" href="#">Learn More <img src="./assets/img/icon/arrow-icon.svg" /></a>
                </p>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="events-section">
        <div id="events-top">
            <div>
                <h2 class="left-heading event-heading">Events & Programs</h2>
                <h3 class="left-heading2 event-heading2">Our Monthly Outreaches</h3>
            </div>
            <p class="hero-button event-button">
                <a id="hero-button" class="p-anchor" href="#">See More <img src="./assets/img/icon/arrow-icon.svg" /></a>
            </p>
        </div>

        <div id="events">
            <div class="event">
                <img src="./assets/img/contact.jpg" class="event-image" />
                <div class="event-text">
                    <span>Recent Event</span>
                    <div class="texts">
                        <h4 class="event-title">Monthly Outreach</h4>

                        <p style="margin-top: 10px">
                            <i class="fa fa-calendar-check-o e-icon"></i>
                            12th June, 2025
                        </p>
                        <p style="margin-top: 5px">
                            <i class="fa fa-map-marker e-icon"></i>
                            St. Mary's Catholic Church, Afikpo
                        </p>
                    </div>
                </div>
            </div>
            <div class="event">
                <img src="./assets/img/contact.jpg" class="event-image" />
                <div class="event-text">
                    <span>Recent Event</span>
                    <div class="texts">
                        <h4 class="event-title">Monthly Outreach</h4>

                        <p style="margin-top: 10px">
                            <i class="fa fa-calendar-check-o e-icon"></i>
                            12th June, 2025
                        </p>
                        <p style="margin-top: 5px">
                            <i class="fa fa-map-marker e-icon"></i>
                            St. Mary's Catholic Church, Afikpo
                        </p>
                    </div>
                </div>
            </div>
            <div class="event">
                <img src="./assets/img/contact.jpg" class="event-image" />
                <div class="event-text">
                    <span>Recent Event</span>
                    <div class="texts">
                        <h4 class="event-title">Monthly Outreach</h4>

                        <p style="margin-top: 10px" class="text-white">
                            <i class="fa fa-calendar-check-o e-icon"></i>
                            12th June, 2025
                        </p>
                        <p style="margin-top: 5px" class="text-white">
                            <i class="fa fa-map-marker e-icon"></i>
                            St. Mary's Catholic Church, Afikpo
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'include/footer.php'; ?>
</body>