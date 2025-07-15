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
    "stylesheets" => ["assets/css/about.css", "assets/css/index.css", "assets/css/donations.css"],
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
    <style>
        /* NEWS ARTICLE SECTION */
.news-art-head {
  font-family: var(--header-font);
  font-weight: 400;
  line-height: 10%;
  color: var(--primary-color);
}

.news-art-subhead {
  font-family: var(--body-font);
  font-weight: 500;
}

.right-arrow,
.left-arrow {
  width: 45;
  height: 45;
  border-radius: 40px;
  padding: 10px;
  gap: 10px;
  border: 1px solid var(--secondary-color);

}

.right-arrow {
  background-color: var(--secondary-color);
  margin-left: 10px;

}

.news-art-card {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;
  width: 280px;
  margin-bottom: 25px;
  background-color: #fff;
  border-radius: 8px;
  padding-bottom: 15px;
  overflow: hidden;
}

.news-art-img {
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  height: 185px !important;
  width: 100%;
  object-fit: cover;
  /* border: 2px red solid; */
}

.article-details {
  margin-top: -12px; /* pull slightly over the image */
  padding: 5px 10px;
    background-color: var(--theme-color2);
  border-radius: 10px;
  text-align: center;
  color: white;
  font-family: var(--body-font);
  font-size: 10px;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 8px;
}

.art-title {
  
  text-align: center;
  font-family: 'Patrick Hand';
  margin: 20px 0 5px;
}

.art-summary {
  font-family: var(--body-font);
  font-weight: 400;
  text-align: center;
  padding: 0 15px;
  margin-bottom: 10px;
}

.art-date {
  padding: 0 5px;
  border-left: 2px solid;
  border-right: 2px solid;
  margin: 0 2px;
}
    </style>
</head>

<body>
        <?php include 'include/header.php'; ?>
        <?php
            if (isset($_GET['success']) && $_GET['success'] == 1 && isset($_GET['message'])) {
                $message = htmlspecialchars($_GET['message']);
                    echo"<div class='alert'>
                            <span class='close-btn' onclick='closeAlert()'>
                                &times;
                            </span>
                            <strong>Success!</strong> $message
                        </div>";
            }
        ?>
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

    <section id="about-section" class="d-flex flex-column flex-md-row gap-5">
        <div class="left w-100 w-md-50">
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
                <a id="hero-button" href="about.php">Learn More <img src="./assets/img/icon/arrow-icon.svg" /></a>
            </p>
            <!-- get involved -->
            <div id="get-involved" class="d-flex flex-column flex-md-row gap-5">
                <div class="get-involved ">
                    <div class="donate-icon2-holder">
                        <img src="./assets/img/icon/donate-icon.svg" class="donate-icon2" />
                    </div>
                    <h3 class="left-heading2 donate-heading">Quick Fund Raising</h3>
                    <p class="left-para donate-para">
                        Join us in creating change by organizing or participating in a fundraising campaign. Together, we can make healthcare and education accessible to all.
                    </p>
                </div>
                <div class="get-involved middle ">
                    <div class="donate-icon2-holder middle-holder">
                        <img src="./assets/img/icon/people-icon.svg" class="donate-icon2" />
                    </div>
                    <h3 class="left-heading2 donate-heading">Become A Volunteer</h3>
                    <p class="left-para donate-para">
                        Be part of our journey to build healthier communities. Share your time, skills, and passion to make a difference in the lives of those in need.
                    </p>
                </div>
                <div class="get-involved ">
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
        <div class="right w-100 w-md-50 mb-5 mt-5 mt-md-0">
            <div id="top">
                <div id="make-donation">
                    <img src="./assets/img/icon/donate-icon.svg" alt="arrow-icon" class="donate-icon2" />
                    <h2>Make A Donation</h2>
                </div>
                <p>Your donation has the power to transform Lives</p>
            </div>
            <div class="donation-form border-0" id="donatenow">
                <form id="donation-form" class="contact-form add"> 
                    

                    <div class="form-section mt-5">
                        
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="first-name">First Name</label>
                                <input
                                type="text"
                                id="name"
                                placeholder="Enter Your First Name" />
                            </div>
                            <div class="mb-3 ">
                                <label for="last-name">Last Name</label>
                                <input
                                type="text"
                                id="lastname"
                                placeholder="Enter Your Last Name" />
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email Address</label>
                            <input
                                type="text"
                                id="email"
                                placeholder="Enter Your Email Address" />
                            </div>

                            <div class="form-group">
                            <label for="message">Message</label>
                            <textarea
                                id="message"
                                placeholder="Enter Your Message"></textarea>
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="form-group">
                        <label for="currency">Currency</label>
                        <select id="currency">
                            <option value="NGN">NGN (Nigerian Naira)</option>
                            <option value="USD">USD (United States Dollar)</option>
                            <option value="EUR">EUR (Euro)</option>
                        </select>
                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <div class="amount-options">
                                <button type="button" class="amount-option-btn selected">
                                &#x20A6;100,000
                                </button>
                                <button type="button" class="amount-option-btn">
                                &#x20A6;50,000
                                </button>
                                <button type="button" class="amount-option-btn">
                                &#x20A6;20,000
                                </button>
                                <button type="button" class="amount-option-btn">
                                &#x20A6;10,000
                                </button>
                                <button type="button" class="amount-option-btn">
                                &#x20A6;5,000
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="custom-amount">Custom Amount</label>
                            <input
                                type="text"
                                id="donation_amount"
                                placeholder="&#x20A6;100,000"
                                value="&#x20A6;100,000" />
                        </div>

                        <div class="form-group">
                            <label for="payment-method">Choose Payment Method</label>
                            <select id="flutterwave" name="donate_method">
                                <option value="paypal">Pay with Flutterwave</option>
                                <!-- <option value="credit_card">Credit Card</option>
                                <option value="bank_transfer">Bank Transfer</option> -->
                            </select>   
                        </div>
                    </div>
                    <button type="button" id="pay-button" class="th-btn style3 mt-4 d-block mx-auto w-50">Make A Donation</button>
                </form>
            </div>
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
                    <a id="hero-button" class="p-anchor" href="about.php">Learn More <img src="./assets/img/icon/arrow-icon.svg" /></a>
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
                    <a id="hero-button" class="p-anchor" href="about.php">Learn More <img src="./assets/img/icon/arrow-icon.svg" /></a>
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
                    <a id="hero-button" class="p-anchor" href="about.php">Learn More <img src="./assets/img/icon/arrow-icon.svg" /></a>
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
                    <a id="hero-button" class="p-anchor" href="about.php">Learn More <img src="./assets/img/icon/arrow-icon.svg" /></a>
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
                <a id="hero-button" class="p-anchor" href="events.php">See More <img src="./assets/img/icon/arrow-icon.svg" /></a>
            </p>
        </div>

        <div id="events">
            <?php
            try {
              $db = new DatabaseConn();
              $pdo = $db->connect();

              $sql = "SELECT * FROM events 
                      
                      ORDER BY date ASC 
                      LIMIT 6";
              $stmt = $pdo->prepare($sql);
              $stmt->execute();
            } catch (Exception $e) {
              echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
              $stmt = null;
          }
          ?>
          <?php if ($stmt && $stmt->rowCount() > 0): ?>
        <?php while ($event = $stmt->fetch(PDO::FETCH_ASSOC)):
        $eventName = htmlspecialchars($event['title']);
        
       
        $status = htmlspecialchars($event['status']);
        $date = date("M j, Y", strtotime($event['date']));
        $image = !empty($event['banner_image']) ? "uploads/" . htmlspecialchars($event['banner_image']) : "assets/img/donate/donation2-1.png";
        $eventid = htmlspecialchars($event['event_id']);
        $location = htmlspecialchars($event['location']);
        $description = htmlspecialchars($event['description']);
        $time = $event['time']; // Assuming $events['time'] is "13:24:00.000000"
        $datetime = new DateTime($time); 
        $formattedTime = $datetime->format('h:i A'); // "h:i A" formats as 10:00 AM
        $formattedTime = htmlspecialchars($formattedTime); // sanitize the output
        ?>
            <div class="event">
                <img src="<?= $image ?>" class="event-image" />
                <div class="event-text">
                    <span>Recent Event</span>
                    <div class="texts">
                        <h4 class="event-title"><?= $eventName ?></h4>

                        <p style="margin-top: 10px;">
                            <i class="fas fa-calendar-alt e-icon"></i> <?= $date ?>
                        </p>
                        <p style="margin-top: 5px;">
                            <i class="fas fa-map-marker-alt e-icon"></i> <?= $location ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
                <?php else: ?>
                    <p style='font-size: 2rem; font-weight: 800;'>No Events available.</p>
                <?php endif; ?>

            
            
        </div>
    </section>

    <section class="testimonials-section2">
        <div class="background-image">
            <img
                src="./assets/img/donation-testimonial-bg.jpg"
                alt="Background image of people" />
        </div>
        <div class="content-overlay">
            <div class="section-header">
                <h1>Testimonials</h1>
                <p>What People Say About Our Charity</p>
            </div>
        <div class="slider-wrapper">
            <div class="testimonials-container">
                <div class="testimonial-card">
                    <div class="quote-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                        d="M6.17 17H4c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C7.03 10.06 6.17 13.39 6.17 17zm9 0H13c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C16.03 10.06 15.17 13.39 15.17 17z" />
                    </svg>
                    </div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="author-info">
                    <img src="./assets/img/testimonial-1.png" alt="Opera Dara" />
                    <div>
                        <p class="author-name">Opera Dara</p>
                        <p class="author-title">Teacher</p>
                    </div>
                    </div>
                </div>

                <div class="testimonial-card colored-card">
                    <div class="quote-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                        d="M6.17 17H4c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C7.03 10.06 6.17 13.39 6.17 17zm9 0H13c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C16.03 10.06 15.17 13.39 15.17 17z" />
                    </svg>
                    </div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="author-info">
                    <img src="./assets/img/testimonial-2.png" alt="Opera Dara" />
                    <div>
                        <p class="author-name">Opera Dara</p>
                        <p class="author-title">Teacher</p>
                    </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                        d="M6.17 17H4c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C7.03 10.06 6.17 13.39 6.17 17zm9 0H13c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C16.03 10.06 15.17 13.39 15.17 17z" />
                    </svg>
                    </div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="author-info">
                    <img src="./assets/img/testimonial-1.png" alt="Opera Dara" />
                    <div>
                        <p class="author-name">Opera Dara</p>
                        <p class="author-title">Teacher</p>
                    </div>
                    </div>
                </div>

                <div class="testimonial-card colored-card">
                    <div class="quote-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                        d="M6.17 17H4c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C7.03 10.06 6.17 13.39 6.17 17zm9 0H13c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C16.03 10.06 15.17 13.39 15.17 17z" />
                    </svg>
                    </div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="author-info">
                    <img src="./assets/img/testimonial-2.png" alt="Opera Dara" />
                    <div>
                        <p class="author-name">Opera Dara</p>
                        <p class="author-title">Teacher</p>
                    </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                        d="M6.17 17H4c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C7.03 10.06 6.17 13.39 6.17 17zm9 0H13c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C16.03 10.06 15.17 13.39 15.17 17z" />
                    </svg>
                    </div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="author-info">
                    <img src="./assets/img/testimonial-1.png" alt="Opera Dara" />
                    <div>
                        <p class="author-name">Opera Dara</p>
                        <p class="author-title">Teacher</p>
                    </div>
                    </div>
                </div>

                <div class="testimonial-card colored-card">
                    <div class="quote-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                        d="M6.17 17H4c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C7.03 10.06 6.17 13.39 6.17 17zm9 0H13c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C16.03 10.06 15.17 13.39 15.17 17z" />
                    </svg>
                    </div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="author-info">
                    <img src="./assets/img/testimonial-2.png" alt="Opera Dara" />
                    <div>
                        <p class="author-name">Opera Dara</p>
                        <p class="author-title">Teacher</p>
                    </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                        d="M6.17 17H4c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C7.03 10.06 6.17 13.39 6.17 17zm9 0H13c0-3.93 1.5-7.43 4.29-10.3l1.42 1.42C16.03 10.06 15.17 13.39 15.17 17z" />
                    </svg>
                    </div>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="author-info">
                    <img src="./assets/img/testimonial-1.png" alt="Opera Dara" />
                    <div>
                        <p class="author-name">Opera Dara</p>
                        <p class="author-title">Teacher</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
        </div>
    </section>

    <section>
        <div class="container mt-5">
            <div class="text-center">
            
                <h4 class="text-theme2">Meet Our Volunteers</h4>
                <p class="text-dark">Behind every smile, direction, and helping hand is a volunteer making a difference. Meet the 
    heroes who make it all happen!</p>
            </div>
            <div class="row">
                    <?php
              
              
               
              
               
               try {
                   // Prepare and execute query
                   $query = "SELECT * FROM volunteers WHERE status = 'Approved' ORDER BY created_at DESC LIMIT 8";
                   $stmt = $dbh->prepare($query);
                   $stmt->execute();
               
                   // Fetch results
                   if ($stmt->rowCount() > 0) {
                       while ($volunteer = $stmt->fetch(PDO::FETCH_ASSOC)) {
                           $name = htmlspecialchars($volunteer['name']);
                           $email = htmlspecialchars($volunteer['email']);
                           $volunteer_id = htmlspecialchars($volunteer['id']);
                        //    $phone = htmlspecialchars($volunteer['phone']);
                           $homeAddress = htmlspecialchars($volunteer['home_address']);
                           $role = htmlspecialchars($volunteer['role']);
                           $gender = htmlspecialchars($volunteer['gender']);
                           $profession = htmlspecialchars($volunteer['profession']);
                           $profilePicture = !empty($volunteer['profile_picture']) ? $volunteer['profile_picture'] : "assets/img/team/person_300_360.jpg"; 
                           $status = htmlspecialchars($volunteer['status']);
                           $createdAt = htmlspecialchars($volunteer['created_at']);

                            $instagram = htmlspecialchars($volunteer['instagram']);
                            $facebook = htmlspecialchars($volunteer['facebook']);
                            $linkedin = htmlspecialchars($volunteer['linkedin']);
                            $twitter = htmlspecialchars($volunteer['twitter']);
               ?>
                    <div class="col-md-4 mb-3" >
                        <div class="leader-div">
                            <?php
                                $primaryPath = "volunteer_uploads/profiles/" . $profilePicture;
                                $fallbackPath = "admin/assets/images/volunteer-img-uploads/" . $profilePicture;

                                if (file_exists($primaryPath)) {
                                    $imgSrc = "https://ogerihealth.org/" . $primaryPath;
                                } else {
                                    $imgSrc = $fallbackPath;
                                }
                                ?>
                            <img src="<?php echo $imgSrc; ?>" alt="" class="vol-img">
                            <div class="text-center leader-card">

                                <p class="text-theme2" >
                                    <a href="team-details.php?id=<?= $volunteer_id ?>" class="text-theme2 fs-4">
                                        <?= $name ?>
                                    </a>
                                </p>
                                <p class="text-dark mt-1">
                                    <a href="team-details.php?id=<?= $volunteer_id ?>" class="text-dark">
                                        <?= $role ?>
                                    </a>
                                </p>

                                <div class="th-social style2">
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
                                <a href="team-details.php?id=<?= $volunteer_id ?>" class="th-btn style3">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php
                       } // End while loop
                    } else {
                        echo "<p class='text-center fs-3'>No volunteers Yet.</p>";
                    }
                        } catch (PDOException $e) {
                            die("Database query failed: " . $e->getMessage());
                        }
                    ?>
            </div>
            </div>
    </section>

    <section class="position-relative" style="background-color: #F8F4F4;">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="text-theme2">Our Work Process</h2>
                    <h5 class="fw-semibold">How We Make A Difference</h5>
                    <p class="text-muted mx-auto" style="max-width: 600px;">
                        At OGERI Health Foundation, we follow a structured approach to ensure our initiatives create a lasting impact in the communities we serve.
                    </p>
                </div>

                <div class="container my-5">
                    <div class="row text-center justify-content-center position-relative g-5 ">
                        
                        <!-- Step 1 -->
                        <div class="col-12 col-md-4 col-lg-3 d-flex justify-content-center z-index-3" data-aos="fade-up" data-aos-delay="100">
                            <div class="process-circle bg-white shadow-sm p-4">
                                <div class="mb-3">
                                <img src="assets/img/about/identity.svg" alt="">
                                </div>
                                <h5 class="fw-bold">Identify & Mobilize</h5>
                                <p class="text-muted small-text">
                                We assess community health challenges, collaborate with local leaders, medical experts, and volunteers, and develop tailored outreach plans.
                                </p>
                            </div>
                        </div>

                        <!-- Wavy line 1 -->
                        <div class="d-none d-md-block position-absolute connector z-index-1" style="top: 160px; left: 27%; width: 14%;">
                            <svg viewBox="0 0 200 50" preserveAspectRatio="none" style="width: 100%; height: 50px;">
                                <path d="M0,25 C50,0 150,50 200,25" stroke="#ccc" stroke-dasharray="5,5" fill="transparent" />
                            </svg>
                        </div>

                        <!-- Step 2 -->
                        <div class="col-12 col-md-4 col-lg-3 d-flex justify-content-center z-index-3" data-aos="fade-up" data-aos-delay="200">
                            <div class="process-circle shadow-sm p-4 text-white" style="background-color: #1AC0A2;">
                                <div class="mb-3">
                                <img src="assets/img/about/implement.svg" alt="">
                                </div>
                                <h5 class="fw-bold text-white">Implement & Educate</h5>
                                <p class="text-white small-text">
                                We conduct free medical checkups, screenings, and health education programs, ensuring individuals have the knowledge and resources to improve their health.
                                </p>
                            </div>
                        </div>

                        <!-- Wavy line 2 -->
                        <div class="d-none d-md-block position-absolute connector z-index-1" style="top: 160px; left: 60%; width: 14%;">
                            <svg viewBox="0 0 200 50" preserveAspectRatio="none" style="width: 100%; height: 50px;">
                                <path d="M0,25 C50,0 150,50 200,25" stroke="#ccc" stroke-dasharray="5,5" fill="transparent" />
                            </svg>
                        </div>

                        <!-- Step 3 -->
                        <div class="col-12 col-md-4 col-lg-3 d-flex justify-content-center z-index-3" data-aos="fade-up" data-aos-delay="300">
                            <div class="process-circle bg-white shadow-sm p-4">
                                <div class="mb-3">
                                <img src="assets/img/about/follow-up.svg" alt="">
                                </div>
                                <h5 class="fw-bold">Follow-Up & Sustain</h5>
                                <p class="text-muted small-text">
                                We provide ongoing support, track progress, and develop long-term partnerships to expand our programs and sustain health improvements in communities.
                                </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
    </section>

    <section class="call-to-action-section">
        
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center text-center" >
                <h6 class="text-white">Ogeri Health Foundation</h6>
                <p class="text-white fs-4">It’s not the size of your intention that matters most, but the small, genuine acts of kindness you’re willing to do — those are what truly leave a mark.</p>
           

                <div class="d-flex mt-5 gap-5">
                    <a href="donation.php" class="th-btn style3 bg-white" style="color: var(--theme-color2);">Donate Now </a>
                    <a href="volunteer.php" class="th-btn style3">Become a Volunteer</a>
                </div>
             </div>


        
        </div>
    </section>

    <section class="causes-section" style="background-color: #F8F4F4;">
        <div class="header">
        <h2 style="color: #F7A234;">Our Causes</h2>
        <p>Our Causes & Help Us</p>
        </div>

        <div class="cards-container">
        <?php
            try {
                // Ensure $dbh is a valid PDO connection
                if (!isset($dbh)) {
                    throw new Exception("Database connection not found.");
                }

                // Prepare and execute query
                $query = "SELECT * FROM donation_events";
                $stmt = $dbh->prepare($query);
                $stmt->execute();

                // Fetch results
                if ($stmt->rowCount() > 0) {
                    while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $eventName = htmlspecialchars($event['title']);
                        $shortdesc = htmlspecialchars($event['short_description']);
                        $raisedAmount = number_format($event['amount_raised'], 2);
                        $goalAmount = number_format($event['goal_amount'], 2);
                        $percentageRaised = ($event['goal_amount'] > 0) ? round(($event['amount_raised'] / $event['goal_amount']) * 100) : 0;
                        $image = !empty($event['banner_image']) ? $event['banner_image'] : "assets/img/donate/donation2-1.png";
            ?>
        <div class="card">
            <img src="admin/<?= $image ?>" alt="Education cause" />
            <div class="card-tag">Education</div>
            <div class="card-content">
            <h3><a href="donation-details.php?id=<?= $event['id'] ?>"><?= $eventName ?></a></h3>
            <p>
                Far far away, behind the word mountains, far from the countries
                Vokalia and Consonantia.
            </p>
            </div>
            <div class="card-bottom">
            <div class="progress-bar-container">
                <div class="progress-bar" style="width: <?= $percentageRaised ?>%;"><?= $percentageRaised ?> %</div>
            </div>
            <div class="amounts">
                <span class="label">Amount Raised:
                <span class="value">&#x20A6;<?= $raisedAmount ?></span></span>
                <span class="label">Goal: <span class="value">&#x20A6;<?= $goalAmount ?></span></span>
            </div>
            </div>
        </div>
        <?php
                }
            } else {
                echo "<p style='font-size: 1.5rem; font-weight: 800; padding-left: 1rem;'>No donation events available.</p>";
            }
        } catch (Exception $e) {
            echo "<p>Error fetching donation events: " . $e->getMessage() . "</p>";
        }
        ?>

        
        </div>
    </section>

    <section class="news-art-section pt-2" style="background-color: #F8F4F4;">
        <div class="container">
            <div class="news-art-header-container d-flex flex-column flex-md-row justify-content-between px-4">
            <div class="news-art-text">
                <h2 class="">News article</h2>
                <p class="news-art-subhead d-block mt-4">Our Latest News & Articles</p>
            </div>
            <div class="news-art-nav mb-3 d-flex align-items-center gap-3">
                <button class="arrow-btn left-arrow">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="arrow-btn right-arrow">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            </div>

            <div class="news-art-card-wrapper">
                <div class="news-art-card-track">
                    <?php
                    $dbh = $db->connect();
                    $query = "SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at ASC";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();

                    while ($blog = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $image = !empty($blog['image']) ? "uploads/" . htmlspecialchars($blog['image']) : "assets/img/default-image.jpg";
                        $blogid = htmlspecialchars($blog['blog_id']);
                        $date = new DateTime($blog['published_at']);
                    ?>
                    <div class="news-art-card">
                    <img src="<?= $image ?>" alt="article" class="news-art-img" />
                    <div class="article-details" style="background-color: var(--theme-color2);">
                        <span class="art-author">Admin</span>
                        <span class="art-date"><?= $date->format('F Y') ?></span>
                        <span class="art-comments-count"><?= htmlspecialchars($blog['category']) ?></span>
                    </div>
                    <h5 class="art-title px-2"><?= htmlspecialchars($blog['blog_title']) ?></h5>
                    <p class="art-summary"><?= htmlspecialchars($blog['blog_description']) ?></p>
                    <a class="th-btn mt-4 text-decoration-none" href="blog-details.php?id=<?= $blogid ?>">
                        Read More <img src="./assets/img/community/icons/right-arrow.svg" alt="arrow" class="ms-2" />
                    </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <?php include 'include/footer.php'; ?>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
    document.getElementById("currency").addEventListener("change", function() {
        const currency = this.value;
        document.getElementById("currency_symbol").innerText = currency === "NGN" ? "₦" : "£";
    });

    document.getElementById("pay-button").addEventListener("click", function() {
        const rawAmount = document.getElementById("donation_amount").value;
        const amount = parseFloat(rawAmount.replace(/[^0-9.]/g, ''));
        const currency = document.getElementById("currency").value;
        const name = document.getElementById("name").value;
        const lastname = document.getElementById("lastname").value;
        const email = document.getElementById("email").value;
        const message = document.getElementById("message").value;

        if (!amount || !email) {
            alert("Please enter all required fields.");
            return;
        }

        FlutterwaveCheckout({
            public_key: "FLWPUBK_TEST-7343bad195d49ea19fed9bae134b8c87-X",
            tx_ref: "DONATE-" + Math.floor(Math.random() * 1000000),
            amount: parseFloat(amount),
            currency: currency,
            customer: {
                email: email,
                name: name + " " + lastname,
            },
            callback: function(response) {
                fetch("verify_transaction.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ transaction_id: response.transaction_id,   message: message })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === "success") {
                        // Redirect with success message
                        window.location.href = "donation.php?success=1&message=" + encodeURIComponent("Donation successful! Thank you for your support.");
                    } else {
                        alert("Payment verification failed. Please contact support.");
                    }
                })
                .catch(error => console.error("Error:", error));
            },
            onclose: function() {
                console.log("Payment window closed."); 
            },
            customizations: {
                title: "OHF Donation",
                description: "Support our cause",
                logo: "assets/img/favicon.svg",
            },
        });
    });
</script>
<script>
    function closeAlert() {
        const alertBox = document.querySelector(".alert");
        if (alertBox) {
            alertBox.style.display = "none"; // Hide the alert
            const url = new URL(window.location.href);
            url.searchParams.delete("success");
            url.searchParams.delete("message");
            window.history.replaceState(null, null, url.toString()); // Update URL without reloading
        }
    }
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const track = document.querySelector(".news-art-card-track");
  const leftArrow = document.querySelector(".left-arrow");
  const rightArrow = document.querySelector(".right-arrow");
  const scrollAmount = 320;

  const updateArrows = () => {
    const scrollLeft = track.scrollLeft;
    const maxScrollLeft = track.scrollWidth - track.clientWidth;

    // Toggle visibility of arrows based on scroll position
    leftArrow.classList.toggle("hidden", scrollLeft <= 10);
    rightArrow.classList.toggle("hidden", scrollLeft >= maxScrollLeft - 10);
  };

  // Scroll on arrow click
  rightArrow.addEventListener("click", () => {
    track.scrollBy({ left: scrollAmount, behavior: "smooth" });
  });

  leftArrow.addEventListener("click", () => {
    track.scrollBy({ left: -scrollAmount, behavior: "smooth" });
  });

  // Update arrow visibility after scroll
  track.addEventListener("scroll", updateArrows);

  // Observe first and last cards to hide arrows at limits
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        if (entry.target.classList.contains("first-card")) {
          leftArrow.classList.add("hidden");
        } else if (entry.target.classList.contains("last-card")) {
          rightArrow.classList.add("hidden");
        }
      }
    });
  }, { root: track, threshold: 1 });

  // Observe edges
  const cards = track.querySelectorAll(".news-art-card");
  if (cards.length > 0) {
    cards[0].classList.add("first-card");
    cards[cards.length - 1].classList.add("last-card");
    observer.observe(cards[0]);
    observer.observe(cards[cards.length - 1]);
  }

  // Initial call
  updateArrows();
});
</script>
<script>
    function closeAlert() {
        const alertBox = document.querySelector(".alert");
        if (alertBox) {
            alertBox.style.display = "none"; // Hide the alert
            const url = new URL(window.location.href);
            url.searchParams.delete("success");
            url.searchParams.delete("message");
            window.history.replaceState(null, null, url.toString()); // Update URL without reloading
        }
    }
</script>
<script src="./assets/js/donations.js"></script>
    
</body>