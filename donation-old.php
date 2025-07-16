<?php
session_start();
require 'api/Database/DatabaseConn.php';

 // Create an instance of DatabaseConn and establish connection
 $db = new DatabaseConn();
 $dbh = $db->connect();
?>

<?php

    $page_title = "Ogeri Health Foundation - Donation";

    $page_author = "Praise!";

    $page_description = "";

    $page_rel = '';

    $page_name = 'donation.php';

    $customs = array(
                "stylesheets" => ["assets/css/about.css", "assets/css/index.css"],
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        .modal {
                /* display: block !important; Ensures it's visible */
                opacity: 1; /* Prevents hidden modal issues */
            }

.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.5) !important; /* Adjusts background */
}

#paymentStatusMessage {
    font-size: 18px;
    font-weight: bold;
}
    </style>
</head>
    

<body>

    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->


    <!--********************************
   		Code Start From Here 
	******************************** -->

   
    
    
    <!--==============================
    Header
============================== -->
    
<?php include 'include/header.php'; ?>

   


    <!--==============================
    Breadcumb
============================== -->
    <div class="breadcumb-wrapper " data-bg-src="assets/img/about/DSC_1346.jpg" data-overlay="theme">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Donations</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li>Donations</li>
                </ul>
            </div>
        </div>
    </div><!--==============================
Donation Area  
==============================-->
<?php
if (isset($_GET['success']) && $_GET['success'] == 1 && isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
    echo "<div class='alert'>
            <span class='close-btn' onclick='closeAlert()'>&times;</span>
            <strong>Success!</strong> $message
          </div>";
}
?>
    <section class="space" id="donation-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="title-area text-center">
                        <span class="sub-title before-none after-none"><i class="far fa-heart text-theme"></i> Lets Start Donating</span>
                        <h2 class="sec-title">See Your Impact: Transparent
                            Donation Causes</h2>
                    </div>
                </div>
            </div>
            <div class="row gy-30">
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
                            <div class="col-xl-6">
                                <div class="donation-card style3">
                                    <div class="box-thumb">
                                        <img src="admin/<?= $image ?>" alt="Donation Event">
                                        <div class="donation-card-tag"><?= $percentageRaised ?>%</div>
                                        <div class="donation-card-shape" data-mask-src="assets/img/donation/donation-card-shape2-1.png"></div>
                                    </div>
                                    <div class="box-content">
                                        <h3 class="box-title"><a href="donation-details.php?id=<?= $event['id'] ?>"><?= $eventName ?></a></h3>
                                        <p>Join our community of dedicated supporters by becoming a member. Enjoy exclusive benefits.</p>
                                        <div class="donation-card_progress-wrap">
                                            <div class="progress">
                                                <div class="progress-bar" style="width: <?= $percentageRaised ?>%;">
                                                </div>
                                            </div>
                                            <div class="donation-card_progress-content">
                                                <span class="donation-card_raise">Raised <span class="donation-card_raise-number">N <?= $raisedAmount ?></span></span>
                                                <span class="donation-card_goal">Goal <span class="donation-card_goal-number">N <?= $goalAmount ?></span></span>
                                            </div>
                                        </div>
                                        <a href="donation-details.php?id=<?= $event['id'] ?>" class="th-btn style6">Donate Now <i class="fas fa-arrow-up-right ms-2"></i></a>
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
        </div>
    </section>
    <!--==============================
Counter Area  
==============================-->
    <div class="">
        <div class="container">
            <div class="counter-wrap style2 bg-light">
                <div class="counter-card">
                    <div class="media-body">
                        <h2 class="box-number text-white"><span class="counter-number">10</span>k<span class="fw-light">+</span></h2>
                        <p class="box-text text-white">people treated through 
medical outreach 
programs</p>
                    </div>
                </div>
                <div class="divider mx-4"></div>
                <div class="counter-card">
                    <div class="media-body">
                        <h2 class="box-number text-white"><span class="counter-number">5</span>k<span class="fw-light">+</span></h2>
                        <p class="box-text text-white">children vaccinated and 
protected from 
preventable diseases</p>
                    </div>
                </div>
                <div class="divider mx-4"></div>
                <div class="counter-card">
                    <div class="media-body">
                        <h2 class="box-number text-white"><span class="counter-number">1,200</span><span class="fw-light">+</span></h2>
                        <p class="box-text text-white">families received 
                        life-saving medications</p>
                    </div>
                </div>
                <div class="divider mx-4"></div>
                <div class="counter-card">
                    <div class="media-body">
                        <h2 class="box-number text-white"><span class="counter-number">50</span>k<span class="fw-light">+</span></h2>
                        <p class="box-text text-white">communities reached 
with health education 
initiatives</p>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
        </div>
    </div>

    <!-- Donate Now  -->
    <section class="donation-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40 justify-content-center">
                <div class="col-xxl-8 col-lg-7">
                    <div class="donation-form-v1  mb-4">
                        <h2 class="title">Donate Now</h2>
                        
                        <p class="donation-form-notice">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span class="text-title">Notice:</span> Test mode is enabled. While in test mode no live donations are processed.
                        </p>
                        <form id="donation-form" class="contact-form">
                            <!-- Select Currency -->
                            <div class="form-group">
                                <label for="currency">Select Currency:</label>
                                <select id="currency" class="form-control">
                                    <option value="NGN" selected>Naira (₦)</option>
                                    <option value="GBP">Pounds (£)</option>
                                </select>
                            </div>

                            <!-- Donation Amount Input -->
                            <div class="form-group donate-input">
                                <input type="text" id="donation_amount" value="100" required class="donate_amount">
                                <span class="icon" id="currency_symbol">₦</span>
                            </div>

                            <!-- Predefined Amounts -->
                            <ul class="donate-amount-button-list list-unstyled">
                                <li class="donate-amount-button" data-amount="20"> 20</li>
                                <li class="donate-amount-button" data-amount="50">50</li>
                                <li class="donate-amount-button active" data-amount="100">100</li>
                                <li class="donate-amount-button" data-amount="150">150</li>
                                <li class="donate-amount-button" data-amount="200">200</li>
                                <li class="donate-amount-button" data-amount="Custom Amount">Custom Amount</li>
                            </ul>

                            <!-- Select Payment Method -->
                            <h5 class="title">Select Payment Method</h5>
                            <ul class="donate-payment-method list-unstyled">
                                <li><input type="radio" id="flutterwave" name="donate_method" class="donate_method" checked> <label for="flutterwave">Pay with Flutterwave</label></li>
                            </ul>

                            <!-- Personal Info -->
                            <h5 class="title mb-25">Personal Info</h5>
                            <div class="row">
                                <div class="form-group style-border col-md-6">
                                    <input type="text" class="form-control" id="name" placeholder="Your name">
                                </div>
                                <div class="form-group style-border col-md-6">
                                    <input type="text" class="form-control" id="lastname" placeholder="Last name">
                                </div>
                                <div class="form-group style-border col-md-12">
                                    <input type="email" class="form-control" id="email" placeholder="Email Address">
                                </div>
                                <div class="form-group style-border col-12">
                                    <textarea id="message" cols="30" rows="3" class="form-control" placeholder="Type Your Message"></textarea>
                                </div>
                                <div class="form-btn col-12">
                                    <button type="button" id="pay-button" class="th-btn"><i class="fas fa-heart me-2"></i> Donate Now</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
     <!--==============================
Testimonial Area  
==============================-->
<section class="testi-area-1 space" id="testi-sec">
        <div class="shape-mockup testi-bg-shape1-1 jump-reverse d-xl-block d-none" data-top="5%" data-right="0">
            <img src="assets/img/about/testimonial-heart.png" alt="img">
        </div>
        <div class="shape-mockup testi-bg-shape1-2" data-top="28%" data-left="5%">
            <img src="assets/img/shape/testimonial_shape1_1.png" alt="img">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="title-area text-center">
                        <span class="sub-title">Testimonials</span>
                        <h2 class="sec-title">What People Say About
                            Our Charity</h2>
                    </div>
                </div>
            </div>
            <div class="row gx-0 justify-content-end">
                <div class="col-lg-5">
                    <div class="swiper th-slider testi-thumb-slider1" data-slider-options='{"effect":"fade","loop":false}'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="testi-box-img testi-box-img-about">
                                    <img src="assets/img/about/man3.jpg" alt="Team">
                                    <div class="testi-card_review">
                                        <i class="fas fa-star"></i>
                                        5.0
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testi-box-img testi-box-img-about">
                                    <img src="assets/img/about/woman3.jpg" alt="Team">
                                    <div class="testi-card_review">
                                        <i class="fas fa-star"></i>
                                        5.0
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testi-box-img testi-box-img-about">
                                    <img src="assets/img/about/man1.jpg" alt="Team">
                                    <div class="testi-card_review">
                                        <i class="fas fa-star"></i>
                                        5.0
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testi-box-img testi-box-img-about">
                                    <img src="assets/img/about/woman1.jpg" alt="Team">
                                    <div class="testi-card_review">
                                        <i class="fas fa-star"></i>
                                        5.0
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="testi-slider1">
                        <div class="swiper th-slider testimonial-slider1" id="testiSlide1" data-slider-options='{"loop":false,"paginationType":"progressbar","effect":"fade", "autoHeight": "true", "thumbs":{"swiper":".testi-thumb-slider1"}}'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testi-card">
                                        <p class="box-text">“Stay informed about our upcoming events and campaigns. Whether it's a fundraising gala, a charity run, or a community outreach program, there are plenty of ways to get involved and support our cause. Check our event calendar for details. We prioritize your security. Our donation process uses the latest encryption technology to protect your personal and financial information. Donate with confidence knowing”</p>
                                        <h3 class="box-title">Alex Furnandes</h3>
                                        <p class="box-desig">CEO, Founder</p>
                                        <div class="quote-icon" data-mask-src="assets/img/icon/quote2.svg"></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-card">
                                        <p class="box-text">“Our donation process uses the latest encryption technology to protect your personal and financial information. Donate with confidence knowing Stay informed about our upcoming events and campaigns. Whether it's a fundraising gala, a charity run, or a community outreach program, there are plenty of ways to get involved and support our cause. Check our event calendar for details. We prioritize your security.”</p>
                                        <h3 class="box-title">Mustafa Kamal</h3>
                                        <p class="box-desig">CEO, Founder</p>
                                        <div class="quote-icon" data-mask-src="assets/img/icon/quote2.svg"></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-card">
                                        <p class="box-text">“Stay informed about our upcoming events and campaigns. Whether it's a fundraising gala, a charity run, or a community outreach program, there are plenty of ways to get involved and support our cause. Check our event calendar for details. We prioritize your security. Our donation process uses the latest encryption technology to protect your personal and financial information. Donate with confidence knowing”</p>
                                        <h3 class="box-title">Alex Furnandes</h3>
                                        <p class="box-desig">CEO, Founder</p>
                                        <div class="quote-icon" data-mask-src="assets/img/icon/quote2.svg"></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testi-card">
                                        <p class="box-text">“Our donation process uses the latest encryption technology to protect your personal and financial information. Donate with confidence knowing Stay informed about our upcoming events and campaigns. Whether it's a fundraising gala, a charity run, or a community outreach program, there are plenty of ways to get involved and support our cause. Check our event calendar for details. We prioritize your security.”</p>
                                        <h3 class="box-title">Mustafa Kamal</h3>
                                        <p class="box-desig">CEO, Founder</p>
                                        <div class="quote-icon" data-mask-src="assets/img/icon/quote2.svg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-pagination"></div>
                            <div class="slider-pagination2"></div>
                        </div>
                        <div class="icon-box">
                            <button data-slider-prev="#testiSlide1" class="slider-arrow default style-border slider-prev"><i class="far fa-arrow-left"></i></button>
                            <button data-slider-next="#testiSlide1" class="slider-arrow default style-border slider-next"><i class="far fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Payment Status Modal -->
    <div class="modal fade w-50 mx-0" id="paymentStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p id="paymentStatusMessage"></p>
                </div>
                <div class="modal-footer">
                    <button id="redirectButton" class="btn btn-primary" style="display:none;">Go to Donations Page</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
   
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
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
    <!-- Flutterwave Payment Script -->
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
    document.getElementById("currency").addEventListener("change", function() {
        const currency = this.value;
        document.getElementById("currency_symbol").innerText = currency === "NGN" ? "₦" : "£";
    });

    document.getElementById("pay-button").addEventListener("click", function() {
        const amount = document.getElementById("donation_amount").value;
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

</body>

</html>