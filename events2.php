<?php
session_start();
require 'api/Database/DatabaseConn.php';

// Create an instance of DatabaseConn and establish connection
$db = new DatabaseConn();
$dbh = $db->connect();
?>

<?php

$page_title = "Ogeri Health Foundation - Events";

$page_author = "Callistus";

$page_description = "";

$page_rel = '';

$page_name = 'events2.php';

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
  <title>Our Events</title>
</head>

<body>
  <section class="hero-section">
    <img src="./assets/img/event-hero-banner.jpg" alt="" />
    <div class="overlay-text">
      <p class="breadcrumb">
        <span><a href="#">Home</a></span>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          fill="currentColor"
          viewBox="0 0 16 16">
          <path
            d="M6.854 3.646a.5.5 0 0 1 .707 0L11.207 8l-3.646 4.354a.5.5 0 1 1-.707-.708L9.793 8 6.854 4.354a.5.5 0 0 1 0-.708z" />
        </svg>
        <span><a href="#">Event</a></span>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          fill="currentColor"
          viewBox="0 0 16 16">
          <path
            d="M6.854 3.646a.5.5 0 0 1 .707 0L11.207 8l-3.646 4.354a.5.5 0 1 1-.707-.708L9.793 8 6.854 4.354a.5.5 0 0 1 0-.708z" />
        </svg>
      </p>
      <h1>Our Event Page</h1>
    </div>
  </section>

  <!-- <section class="discover-impact"> -->
  <div class="intro">
    <h2>Discover Our Impact; Past and present Events/Outreaches</h2>
    <p>
      These events have not only improved health outcomes but also fostered
      a sense of community and social responsibility. We're proud of our
      achievements and look forward to continuing our work in healthcare
      outreach and advocacy.
    </p>
  </div>

  <!-- Events Section -->
  <section id="events-section">
    <div id="events-top">
      <div>
        <h2 class="left-heading event-heading" style="margin-top:40px !important">Upcoming Events/Outreaches</h2>
        <h3 class="left-heading2 event-heading2">Our Monthly Outreaches</h3>
      </div>
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
    </div>
  </section>


  <!-- Events Section -->
  <section id="events-section" style="margin-bottom:80px !important">
    <div id="events-top">
      <div>
        <h2 class="left-heading event-heading" style="margin-top:90px !important">Past Events/Outreaches</h2>
        <h3 class="left-heading2 event-heading2">Our Monthly Outreaches</h3>
      </div>
    </div>

    <div id="events">
      <div class="event">
        <img src="./assets/img/contact.jpg" class="event-image" />
        <div class="event-text">
          <span>Past Event</span>
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
          <span>Past Event</span>
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
          <span>Past Event</span>
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
    </div>
  </section>
  </section>

  <section class="cta">
    <img
      src="./assets/img/event-call-to-action.jpg"
      alt="Call to Action Background"
      class="cta-bg" />
    <div class="cta-overlay">
      <h2 class="heading">The Ogeri Health Foundation</h2>
      <p>
        It’s Not The Size Of Your Intention That Matters Most, But The Small,
        Genuine Acts Of Kindness You’re Willing To Do — Those Are What Truly
        Leave A Mark.
      </p>
      <div class="cta-buttons">
        <button class="donate-btn">Donate Now</button>
        <button class="volunteer-btn">Become A Volunteer</button>
      </div>
    </div>
  </section>
