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

$page_name = 'donation2.php';

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
  <title>Donations</title>
</head>

<body>
  <?php include 'include/header2.php'; ?>

  <section class="hero-section">
    <img src="./assets/img/danation-hero-banner.jpg" alt="" />
    <div class="overlay-text">
      <p>Bringing Hope through Health</p>
      <h1>Empower Change with your Contribution</h1>

      <div class="cta-buttons">
        <button class="donate-btn">Donate Now</button>
      </div>
    </div>
  </section>

  <section class="impact-section">
    <h3 class="section-subtitle">Let's Start Donating</h3>
    <h2 class="section-title">
      See Your Impact: Transparent Donation Causes
    </h2>

    <div class="impact-container">
      <div class="impact-item">
        <div class="impact-circle impact-circle-outline">
          <p class="impact-number">10,000+</p>
          <p class="impact-description">
            People Treated Through Medical Outreach Programs
          </p>
        </div>
      </div>

      <div class="impact-item">
        <div class="impact-circle impact-circle-filled">
          <p class="impact-number">5,000+</p>
          <p class="impact-description">
            Children Vaccinated And Protected From Preventable Diseases
          </p>
        </div>
      </div>

      <div class="impact-item">
        <div class="impact-circle impact-circle-outline">
          <p class="impact-number">1,200+</p>
          <p class="impact-description">
            Families Received Life-Saving Medications
          </p>
        </div>
      </div>

      <div class="impact-item">
        <div class="impact-circle impact-circle-filled">
          <p class="impact-number">50+</p>
          <p class="impact-description">
            Communities Reached With Health Education Initiatives.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonials-section">
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

  <section class="causes-section">
    <div class="header">
      <h2 style="color: #F7A234;">Our Causes</h2>
      <p>Our Causes & Help Us</p>
    </div>

    <div class="cards-container">
      <div class="card">
        <img src="./assets/img/cause-1.jpg" alt="Education cause" />
        <div class="card-tag">Education</div>
        <div class="card-content">
          <h3>Give Food to Homeless Children</h3>
          <p>
            Far far away, behind the word mountains, far from the countries
            Vokalia and Consonantia.
          </p>
        </div>
        <div class="card-bottom">
          <div class="progress-bar-container">
            <div class="progress-bar">70%</div>
          </div>
          <div class="amounts">
            <span class="label">Amount Raised:
              <span class="value">&#x20A6;8,200,000</span></span>
            <span class="label">Goal: <span class="value">&#x20A6;10,000,000</span></span>
          </div>
        </div>
      </div>

      <div class="card">
        <img src="./assets/img/cause-2.jpg" alt="Education cause" />
        <div class="card-tag">Education</div>
        <div class="card-content">
          <h3>Give Food to Homeless Children</h3>
          <p>
            Far far away, behind the word mountains, far from the countries
            Vokalia and Consonantia.
          </p>
        </div>
        <div class="card-bottom">
          <div class="progress-bar-container">
            <div class="progress-bar">70%</div>
          </div>
          <div class="amounts">
            <span class="label">Amount Raised:
              <span class="value">&#x20A6;8,200,000</span></span>
            <span class="label">Goal: <span class="value">&#x20A6;10,000,000</span></span>
          </div>
        </div>
      </div>

      <div class="card">
        <img src="./assets/img/cause-3.jpg" alt="Education cause" />
        <div class="card-tag">Education</div>
        <div class="card-content">
          <h3>Give Food to Homeless Children</h3>
          <p>
            Far far away, behind the word mountains, far from the countries
            Vokalia and Consonantia.
          </p>
        </div>
        <div class="card-bottom">
          <div class="progress-bar-container">
            <div class="progress-bar">70%</div>
          </div>
          <div class="amounts">
            <span class="label">Amount Raised:
              <span class="value">&#x20A6;8,200,000</span></span>
            <span class="label">Goal: <span class="value">&#x20A6;10,000,000</span></span>
          </div>
        </div>
      </div>

      <div class="card">
        <img src="./assets/img/cause-1.jpg" alt="Education cause" />
        <div class="card-tag">Education</div>
        <div class="card-content">
          <h3>Give Food to Homeless Children</h3>
          <p>
            Far far away, behind the word mountains, far from the countries
            Vokalia and Consonantia.
          </p>
        </div>
        <div class="card-bottom">
          <div class="progress-bar-container">
            <div class="progress-bar">70%</div>
          </div>
          <div class="amounts">
            <span class="label">Amount Raised:
              <span class="value">&#x20A6;8,200,000</span></span>
            <span class="label">Goal: <span class="value">&#x20A6;10,000,000</span></span>
          </div>
        </div>
      </div>

      <div class="card">
        <img src="./assets/img/cause-2.jpg" alt="Education cause" />
        <div class="card-tag">Education</div>
        <div class="card-content">
          <h3>Give Food to Homeless Children</h3>
          <p>
            Far far away, behind the word mountains, far from the countries
            Vokalia and Consonantia.
          </p>
        </div>
        <div class="card-bottom">
          <div class="progress-bar-container">
            <div class="progress-bar">70%</div>
          </div>
          <div class="amounts">
            <span class="label">Amount Raised:
              <span class="value">&#x20A6;8,200,000</span></span>
            <span class="label">Goal: <span class="value">&#x20A6;10,000,000</span></span>
          </div>
        </div>
      </div>

      <div class="card">
        <img src="./assets/img/cause-3.jpg" alt="Education cause" />
        <div class="card-tag">Education</div>
        <div class="card-content">
          <h3>Give Food to Homeless Children</h3>
          <p>
            Far far away, behind the word mountains, far from the countries
            Vokalia and Consonantia.
          </p>
        </div>
        <div class="card-bottom">
          <div class="progress-bar-container">
            <div class="progress-bar">70%</div>
          </div>

          <div class="amounts">
            <span class="label">Amount Raised:
              <span class="value">&#x20A6;8,200,000</span></span>
            <span class="label">Goal: <span class="value">&#x20A6;10,000,000</span></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="donate-section">
    <div class="donate-container">
      <div class="header">
        <div class="title-row">
          <img src="./assets/img/icon/heart-icon.png" alt="Heart Icon" />
          <h2>Make A Donation</h2>
        </div>
        <p>Your Donation Has The Power To Transform Lives</p>
      </div>
      <div class="donation-form">
        <form>
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
                id="custom-amount"
                placeholder="&#x20A6;100,000"
                value="&#x20A6;100,000" />
            </div>

            <div class="form-group">
              <label for="payment-method">Choose Payment Method</label>
              <select id="payment-method">
                <option value="paypal">Paypal</option>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Bank Transfer</option>
              </select>
            </div>
          </div>

          <div class="form-section">
            <h3>Personal Information</h3>
            <div class="row">
              <div class="form-group">
                <label for="first-name">First Name</label>
                <input
                  type="text"
                  id="first-name"
                  placeholder="Enter Your First Name" />
              </div>
              <div class="form-group">
                <label for="last-name">Last Name</label>
                <input
                  type="text"
                  id="last-name"
                  placeholder="Enter Your Last Name" />
              </div>
            </div>

            <div class="form-group">
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
        </form>
      </div>
      <button type="submit" class="th-btn style3 mt-4 d-block mx-auto w-50">Make A Donation</button>
    </div>
  </section>


<script src="./assets/js/donations.js"></script>
  <?php include 'include/footer.php'; ?>
</body>

</html>