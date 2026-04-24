<?php
session_start();
require 'api/Database/DatabaseConn.php';

 // Create an instance of DatabaseConn and establish connection
 $db = new DatabaseConn();
 $dbh = $db->connect();
 
$page = basename($_SERVER['PHP_SELF']);
$ip = $_SERVER['REMOTE_ADDR'];


$dbh->prepare("INSERT INTO page_views (page, ip_address) VALUES (?, ?)")
     ->execute([$page, $ip]);
?>

<?php

$page_title = "Ogeri Health Foundation - Donations";

$page_author = "Callistus";

$page_description = "";

$page_rel = '';

$page_name = 'donation2.php';

$customs = array(
  "stylesheets" => ["assets/css/donations.css"],
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
  <title>Donations</title>
</head>

<body>
  <?php include 'include/header.php'; ?>
  <div id="alertBox"></div>

  <section class="hero-section">
    <img src="./assets/img/danation-hero-banner.jpg" alt="" />
    <div class="overlay-text text-white">
      <p class="text-white">Bringing Hope through Health</p>
      <h1 class="text-white">Empower Change with your Contribution</h1>

      <div class="cta-buttons d-flex justify-content-center">
        <a href="#donatenow" class="donate-btn th-btn style3">Donate Now</a>
      </div>
    </div>
  </section>
  <?php
    if (isset($_GET['success']) && $_GET['success'] == 1 && isset($_GET['message'])) {
        $message = htmlspecialchars($_GET['message']);
        echo "<div id='alertBox'>
                <div class='alert alert-success'>
                  <span class='close-btn' onclick='closeAlert()'>&times;</span>
                  <strong>Success!</strong> $message
                </div>
                
              </div>";
    }
  ?>

         <section class="" style="background-color: #F8F4F4;">
            <div class="py-5 container">
                <div class="text-center">
                    <p class="text-dark">Let's Start Donating</p>
                    <h4 class="text-theme2">See Your Impact: Transparent Donation Causes</h4>
                </div>
                <div class="container mt-5">
                    <div class="row justify-content-center gy-4">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                            <div class="impact-circle text-center">
                                <p class="text-dark fs-3"><b><span class="counter" data-target="976">0</span>+</b></p>
                                <p class="w-75 mx-auto">People Screened Through Monthly Medical Outreach Programs</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                            <div class="impact-circle bg-theme text-white text-center">
                                <p class="text-white fs-3"><b><span class="counter" data-target="19">0</span>+</b></p>
                                <p class="text-white w-75 mx-auto">Health Outreach Held</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                            <div class="impact-circle text-center">
                                <p class="text-dark fs-3"><b><span class="counter" data-target="505">0</span>+</b></p>
                                <p class="w-75 mx-auto">Patients Diagnosed with elevated blood pressure identified and linked to care</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                            <div class="impact-circle bg-theme text-white text-center">
                                <p class="text-white fs-3"><b><span class="counter" data-target="90.2">0</span>%</b></p>
                                <p class="text-white w-75 mx-auto">Returned within 60 days for a follow-up outreach</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>

  <section class="testimonials-section2">
    <div class="background-image">
        <img src="./assets/img/donation-testimonial-bg-min.jpg" alt="Background image of people" />
    </div>

    <div class="content-overlay">
        <div class="section-header">
            <h1>Testimonials</h1>
            <p>What People Say About Our Charity</p>
        </div>

        <!-- VIDEO SECTION -->
        <div class="video-display">
            <div class="video-wrapper">
                <video id="testimonialVideo" controls>
                    <source src="./assets/videos/testimonial-1.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>

                <!-- Video info -->
                <div class="video-info">
                    <h3 id="videoName">Isu Patience Ugo</h3>
                    <p id="videoDesc">Isu shares her experience with The Ogeri Health Foundation</p>
                </div>

                <!-- Navigation -->
                <div class="video-nav">
                    <button id="prevVideo" class="nav-btn">❮ Prev</button>
                    <span id="videoCount">1 / 5</span>
                    <button id="nextVideo" class="nav-btn">Next ❯</button>
                </div>
            </div>
        </div>

        <!-- TESTIMONIAL CARDS -->
        <!-- TESTIMONIAL CARDS SLIDER -->
       <!-- TESTIMONIAL CARDS SLIDER -->
        <div class="testimonials-slider">
            <div class="testimonials-wrapper">
                <div class="testimonials-container" id="testimonialsContainer">
                    <!-- 1 -->
                    <div class="testimonial-card">
                        <div class="quote-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M6.17 17H4c0-3.93 1.5-7.43 4.29-10.3l1.42 
                                    1.42C7.03 10.06 6.17 13.39 6.17 17zm9 0H13
                                    c0-3.93 1.5-7.43 4.29-10.3l1.42 
                                    1.42C16.03 10.06 15.17 13.39 15.17 17z" />
                            </svg>
                        </div>
                        <p>I am grateful for the continuous care and free medications. I always get better each time I take medications given to me.</p>
                        <div class="author-info">
                            <img src="assets/img/about/mrs_patience.png" alt="Isu Patience Ugo" />
                            <div>
                                <p class="author-name">Isu Patience Ugo</p>
                                <p class="author-title">Ezi Ukie Compound, Mgbom Community</p>
                            </div>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="testimonial-card colored-card">
                        <div class="quote-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M6.17 17H4c0-3.93 
                                    1.5-7.43 4.29-10.3l1.42 
                                    1.42C7.03 10.06 6.17 13.39 
                                    6.17 17zm9 0H13c0-3.93 
                                    1.5-7.43 4.29-10.3l1.42 
                                    1.42C16.03 10.06 15.17 
                                    13.39 15.17 17z" />
                            </svg>
                        </div>
                        <p>I received treatment for hypertension since the first outreach in March 2024. God bless the Foundation.</p>
                        <div class="author-info">
                            <img src="assets/img/about/2nd-woman.jpg" alt="Mrs. Ajuka Oko" />
                            <div>
                                <p class="author-name">Mrs. Ajuka Oko</p>
                                <p class="author-title">Ezi Abagha Compound, Mgbom Community</p>
                            </div>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="testimonial-card">
                        <div class="quote-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M6.17 17H4c0-3.93 
                                    1.5-7.43 4.29-10.3l1.42 
                                    1.42C7.03 10.06 6.17 13.39 
                                    6.17 17zm9 0H13c0-3.93 
                                    1.5-7.43 4.29-10.3l1.42 
                                    1.42C16.03 10.06 15.17 
                                    13.39 15.17 17z" />
                            </svg>
                        </div>
                        <p>I have been treated of malaria, osteoarthritis and more. The Foundation is doing a wonderful job!</p>
                        <div class="author-info">
                            <img src="assets/img/about/mr-isu.jpg" alt="Mr. Isu Ukie" />
                            <div>
                                <p class="author-name">Mr. Isu Ukie</p>
                                <p class="author-title">Community Member</p>
                            </div>
                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="testimonial-card colored-card">
                        <div class="quote-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M6.17 17H4c0-3.93 
                                    1.5-7.43 4.29-10.3l1.42 
                                    1.42C7.03 10.06 6.17 13.39 
                                    6.17 17zm9 0H13c0-3.93 
                                    1.5-7.43 4.29-10.3l1.42 
                                    1.42C16.03 10.06 15.17 
                                    13.39 15.17 17z" />
                            </svg>
                        </div>
                        <p>I have been keeping to my medications and there has been a great improvement in my health.</p>
                        <div class="author-info">
                            <img src="assets/img/about/mr-chukwu.png" alt="Mr. Chukwu Inya Chukwu" />
                            <div>
                                <p class="author-name">Mr. Chukwu Inya Chukwu</p>
                                <p class="author-title">Ezi Akpuka Compound</p>
                            </div>
                        </div>
                    </div>

                    <!-- 5 -->
                    <div class="testimonial-card">
                        <div class="quote-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M6.17 17H4c0-3.93 
                                    1.5-7.43 4.29-10.3l1.42 
                                    1.42C7.03 10.06 6.17 13.39 
                                    6.17 17zm9 0H13c0-3.93 
                                    1.5-7.43 4.29-10.3l1.42 
                                    1.42C16.03 10.06 15.17 
                                    13.39 15.17 17z" />
                            </svg>
                        </div>
                        <p>I come for the monthly outreaches and I have noticed significant improvement in my health.</p>
                        <div class="author-info">
                            <img src="assets/img/about/mr-micheal.png" alt="Mr. Michael" />
                            <div>
                                <p class="author-name">Mr. Michael</p>
                                <p class="author-title">Community Member</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons moved BELOW -->
            
        </div>
        <div class="testimonial-buttons">
            <button class="testimonial-arrow left2" id="prevTestimonial">❮</button>
            <button class="testimonial-arrow right2" id="nextTestimonial">❯</button>
        </div>


    </div>
</section>
  <section class="causes-section">
    <div class="header2">
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
                    $category = htmlspecialchars($event['category']);
                    $raisedAmount = number_format($event['amount_raised'], 2);
                    $goalAmount = number_format($event['goal_amount'], 2);
                    $percentageRaised = ($event['goal_amount'] > 0) ? round(($event['amount_raised'] / $event['goal_amount']) * 100) : 0;
                    $image = !empty($event['banner_image']) ? $event['banner_image'] : "assets/img/donate/donation2-1.png";
        ?>
      <div class="card">
        <img src="admin/<?= $image ?>" alt="Education cause" />
        <div class="card-tag mb-3"><?= $category ?></div>
        <div class="card-content">
          <h3><a href="donation-details.php?id=<?= $event['id'] ?>"><?= $eventName ?></a></h3>
          <p>
            <?= $shortdesc ?>
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
          <div>
            <button class="th-btn style3"><a href="donation-details.php?id=<?= $event['id'] ?>" style="color: white; text-decoration: none;">Donate Now</a></button>
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

  <section class="donate-section">
    <div class="donate-container">
      <div class="header2">
        <div class="title-row">
          <img src="./assets/img/icon/heart-icon.png" alt="Heart Icon" />
          <h2>Make A Donation</h2>
        </div>
        <p>Your Donation Has The Power To Transform Lives</p>
      </div>
      <div class="donation-form" id="donatenow">
        <form id="donation-form" class="contact-form"> 
          <div class="form-section">
            <div class="form-group">
              <label for="currency">Currency</label>
              <select id="currency">
                <option value="GBP">Pounds (GBP)</option>
                <option value="NGN">NGN (Nigerian Naira)</option>
                <option value="USD">USD (United States Dollar)</option>
                
              </select>
            </div>

            <div class="form-group">
              <label>Amount</label>
              <div class="amount-options">
                <button type="button" class="amount-option-btn selected"></button>
                <button type="button" class="amount-option-btn"></button>
                <button type="button" class="amount-option-btn"></button>
                <button type="button" class="amount-option-btn"></button>
              </div>
            </div>

            <div class="form-group">
              <label for="custom-amount">Custom Amount</label>
              <input type="text" id="donation_amount" />
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

          <div class="form-section">
            <h3>Personal Information</h3>
            <div class="row">
              <div class="form-group">
                <label for="first-name">First Name</label>
                <input
                  type="text"
                  id="name"
                  placeholder="Enter Your First Name" />
              </div>
              <div class="form-group">
                <label for="last-name">Last Name</label>
                <input
                  type="text"
                  id="lastname"
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
      <button type="button" id="pay-button" class="th-btn style3 mt-4 d-block mx-auto w-50">Make A Donation</button>
    </div>
  </section>
<?php include 'include/footer.php'; ?>

<script src="./assets/js/donations.js"></script>
  
  <script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
   

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
        public_key: "FLWPUBK-41d90e5fb8b282ba7a221837359b8ff6-X",
        tx_ref: "DONATE-" + Math.floor(Math.random() * 1000000),
        amount: parseFloat(amount),
        currency: currency,
        customer: {
          email: email,
          name: name + " " + lastname,
        },
        callback: function (response) {
          fetch("verify_transaction.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            }, 
            body: JSON.stringify({
              transaction_id: response.transaction_id,
              message: message,
              name: name + " " + lastname,
              email: email,
            }),
          })
            .then((res) => res.json())
            .then((data) => {
              if (data.status === "success") {
                showAlert("success", "Donation successful! Thank you for your support.");
                setTimeout(() => {
                  window.location.href =
                    "donation.php?success=1&message=" +
                    encodeURIComponent("Donation successful! Thank you for your support.");
                }, 2000);
              } else {
                showAlert("error", "Payment verification failed. Please contact support.");
              }
            })
            .catch((error) => {
              console.error("Error:", error);
              showAlert("error", "An error occurred while verifying your payment.");
            });
        },
        onclose: function () {
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
        const counters = document.querySelectorAll('.counter');
        let countersStarted = false;

        function animateCounters() {
            if (countersStarted) return;
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const duration = 2000;
                const stepTime = 10;
                const increment = target / (duration / stepTime);
                let count = 0;

                const update = () => {
                    count += increment;
                    if (count < target) {
                        counter.innerText = Math.floor(count);
                        setTimeout(update, stepTime);
                    } else {
                        counter.innerText = target.toLocaleString();
                    }
                };

                update();
            });
            countersStarted = true;
        }

        const triggerElement = document.querySelector('.impact-circle');

        if ('IntersectionObserver' in window && triggerElement) {
            const observer = new IntersectionObserver(entries => {
                if (entries[0].isIntersecting) {
                    animateCounters();
                    observer.disconnect();
                }
            }, { threshold: 0.4 });
            observer.observe(triggerElement);
        } else {
            window.addEventListener('load', animateCounters);
        }
    </script>
    <script>
      function showAlert(type, message) {
        const alertBox = document.createElement("div");
        alertBox.className = `alert ${type === "success" ? "alert-success" : "alert-error"}`;
        alertBox.innerHTML = `
          <span class="alert-close" onclick="this.parentElement.remove()">&times;</span>
          <strong>${type === "success" ? "Success!" : "Error!"}</strong> ${message}
        `;

        const alertContainer = document.getElementById("alertBox") || (() => {
          const div = document.createElement("div");
          div.id = "alertBox";
          document.body.appendChild(div);
          return div;
        })();

        alertContainer.appendChild(alertBox);

        // Auto remove after 5s
        setTimeout(() => alertBox.remove(), 5000);
      }
    </script>
     <script>
    const videos = [
        {
            src: "./assets/videos/testimonial-1.mp4",
            name: "Mr Chukwu Inya Chukwu",
            desc: "Mr Chukwu shares his experience with The Ogeri Health Foundation"
        },
        {
            src: "./assets/videos/testimonial-2.mp4",
            name: "Mr. Micheal",
            desc: "Mr. Micheal talks about his recovery journey"
        },
        {
            src: "./assets/videos/testimonial-3.mp4",
            name: "Mr. Isu Ukie",
            desc: "Mr. Ukie talks about his recovery journey"
        },
        {
            src: "./assets/videos/testimonial-4.mp4",
            name: "Mrs Isu Patience Ugo",
            desc: "Mrs Isu Patience shares her health improvements"
        },
        {
            src: "./assets/videos/testimonial-5.mp4",
            name: "Mrs Ajuka Oko",
            desc: "Mrs Ajuka Oko shares her health improvements"
        }
    ];

    let currentVideo = 0;

    const videoElement = document.getElementById("testimonialVideo");
    const videoName = document.getElementById("videoName");
    const videoDesc = document.getElementById("videoDesc");
    const videoCount = document.getElementById("videoCount");

    function updateVideo(index) {
        const v = videos[index];
        videoElement.src = v.src;
        videoName.textContent = v.name;
        videoDesc.textContent = v.desc;
        videoCount.textContent = `${index + 1} / ${videos.length}`;
    }

    document.getElementById("nextVideo").addEventListener("click", () => {
        currentVideo = (currentVideo + 1) % videos.length;
        updateVideo(currentVideo);
    });

    document.getElementById("prevVideo").addEventListener("click", () => {
        currentVideo = (currentVideo - 1 + videos.length) % videos.length;
        updateVideo(currentVideo);
    });

    // Initialize
    updateVideo(currentVideo);
</script>
<script>
    const testimonialContainer = document.getElementById("testimonialsContainer");
    const nextTestimonial = document.getElementById("nextTestimonial");
    const prevTestimonial = document.getElementById("prevTestimonial");

    let testimonialIndex = 0;
    const totalTestimonials = document.querySelectorAll(".testimonial-card").length;
    const cardsPerView = 3; // adjust to 1 or 2 for mobile if you want responsiveness

    nextTestimonial.addEventListener("click", () => {
        if (testimonialIndex < totalTestimonials - cardsPerView) {
            testimonialIndex++;
        } else {
            testimonialIndex = 0;
        }
        updateTestimonialSlide();
    });

    prevTestimonial.addEventListener("click", () => {
        if (testimonialIndex > 0) {
            testimonialIndex--;
        } else {
            testimonialIndex = totalTestimonials - cardsPerView;
        }
        updateTestimonialSlide();
    });

    function updateTestimonialSlide() {
        const offset = testimonialIndex * (testimonialContainer.children[0].offsetWidth + 25);
        testimonialContainer.style.transform = `translateX(-${offset}px)`;
    }
</script>


</body>

</html>