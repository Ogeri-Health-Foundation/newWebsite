<?php
session_start();
require 'api/Database/DatabaseConn.php';

// Create an instance of DatabaseConn and establish connection
$db = new DatabaseConn();
$dbh = $db->connect();

try {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("Invalid event ID.");
    }

    $eventId = intval($_GET['id']); // Get ID from URL and sanitize it

    // Prepare query
    $query = "SELECT * FROM donation_events WHERE id = :id LIMIT 1";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
    $stmt->execute();

    // Check if event exists
    if ($stmt->rowCount() > 0) {
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        $eventName = htmlspecialchars($event['title']);
        $category = htmlspecialchars($event['category']);
        $description = htmlspecialchars($event['full_description']);
        $raisedAmount = number_format($event['amount_raised'], 2);
        $goalAmount = number_format($event['goal_amount'], 2);
        $percentageRaised = ($event['goal_amount'] > 0) ? round(($event['amount_raised'] / $event['goal_amount']) * 100) : 0;
        $image = !empty($event['image']) ? $event['image'] : "assets/img/donate/donation2-1.png";
    } else {
        throw new Exception("Event not found.");
    }
} catch (Exception $e) {
    die("<p>Error: " . $e->getMessage() . "</p>");
}
?>


<?php

$page_title = "Ogeri Health Foundation - Donation Details";

$page_author = "Praise!";

$page_description = "";

$page_rel = '';

$page_name = 'donation-details.php';

$customs = array(
    "stylesheets" => ["assets/css/donation.css"],
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

    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->


    <!--********************************
   		Code Start From Here 
	******************************** -->

    <!--==============================
     Preloader
  ==============================-->
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
                <h1 class="breadcumb-title">Donation Details</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li>Donation</li>
                </ul>
            </div>
        </div>
    </div><!--==============================
    Blog Area
==============================-->
    <section class="donation-details space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-xxl-8 col-lg-7">
                    <div class="page-img">
                        <img src="assets/img/donate/donation2-1.png" alt="Blog Image">
                        <div class="tag"><?= $category ?></div>
                    </div>
                    <div class="blog-content">
                        <h2 class="h3 page-title mt-n2"><?= $eventName ?></h2>
                        <p class="mb-35"><?= $description ?></p>
                    </div>

                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area donation-sidebar">


                        <div class="widget" data-bg-src="assets/img/bg/gray-bg2.png" data-overlay="gray" data-opacity="5">
                            <h3 class="widget_title">Recent Donors</h3>
                            <div class="recent-donate-wrap" id="donors-list">
                                <!-- Donor list will be loaded here -->
                            </div>
                            <button id="view-more-btn" class="th-btn mt-3">View More</button>
                        </div>
                        <div class="donation-progress-wrap mb-55 widget" style="display: block;">
                            <div class="media-left">
                                <div class="progress">
                                    <div class="progress-bar" style="width: <?= $percentageRaised ?>%;">
                                        <div class="progress-value"><?= $percentageRaised ?>%</div>
                                    </div>
                                </div>
                                <div class="donation-progress-content">
                                    <span class="donation-card_raise">Raised <span class="donation-card_raise-number">N <?= $raisedAmount ?></span></span>
                                    <span class="donation-card_goal">Goal <span class="donation-card_goal-number">N <?= $goalAmount ?></span></span>
                                </div>
                            </div>
                            <div class="btn-wrap mt-4">
                                <a class="th-btn" href="#" id="showDonationForm">Donate Now <i class="fas fa-arrow-up-right ms-2"></i></a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- Overlay Background -->
    <div id="overlay"></div>


    <section class="donation-details space-top space-extra2-bottom" id="donationForm">
        <div class="container">
            <div class="row gx-40 justify-content-center">
                <div class="col-xxl-8 col-lg-7">
                    <div class="donation-form-v1  mb-4">
                        <button class="close-btn">&times;</button>
                        <p class="donation-form-notice">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span class="text-title">Notice:</span> Test mode is enabled. While in test mode no live donations are processed.
                        </p>
                        <form id="donation-form" class="contact-form">
                            <input type="hidden" name="donation_event_id" value="<?= $eventId ?>" id="event_id">
                            <!-- Select Currency -->
                            <div class="form-group">
                                <label for="currency">Select Currency:</label>
                                <select id="currency" class="form-control">
                                    <option value="NGN" selected>NGN (Nigerian Naira)</option>
                                    <option value="">USD (United States Dollar)</option>
                                    <option value="GBP">GBP (Great British Pounds)</option>
                                </select>
                            </div>

                            <!-- Donation Amount Input -->
                            <div class="form-group donate-input">
                                <input type="text" id="donation_amount" required class="donate_amount">
                                <span class="icon" id="currency_symbol">₦</span>
                            </div>

                            <!-- Predefined Amounts -->
                            <ul class="donate-amount-button-list list-unstyled">
                                <li class="donate-amount-button" data-amount="20">N 20</li>
                                <li class="donate-amount-button" data-amount="50">N 50</li>
                                <li class="donate-amount-button active" data-amount="100">N 100</li>
                                <li class="donate-amount-button" data-amount="150">N 150</li>
                                <li class="donate-amount-button" data-amount="200">N 200</li>
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
    <script>
        document.getElementById("showDonationForm").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default anchor behavior
            document.getElementById("donationForm").style.display = "flex"; // Show form
            document.getElementById("overlay").style.display = "block"; // Show overlay
        });

        // Close form when clicking the close button
        document.querySelector(".close-btn").addEventListener("click", function() {
            document.getElementById("donationForm").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        });

        // Close form when clicking the overlay
        document.getElementById("overlay").addEventListener("click", function() {
            document.getElementById("donationForm").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        });
    </script>

    <!-- Flutterwave Payment Script -->
    <script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- Handle amount buttons ---
        const amountButtons = document.querySelectorAll('.amount-option-btn');
        const donationAmountInput = document.getElementById('donation_amount');

        amountButtons.forEach(button => {
            button.addEventListener('click', function() {
                amountButtons.forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');
                donationAmountInput.value = this.textContent.trim();
            });
        });

        donationAmountInput.addEventListener('focus', function() {
            amountButtons.forEach(btn => btn.classList.remove('selected'));
        });
    });

    // --- Handle currency change ---
    document.getElementById("currency").addEventListener("change", function () {
        const currency = this.value;
        let symbol;

        switch (currency) {
            case "NGN": symbol = "₦"; break;
            case "USD": symbol = "$"; break;
            case "GBP": symbol = "£"; break;
            default: symbol = "₦";
        }

        document.querySelectorAll(".amount-option-btn").forEach(btn => {
            const rawText = btn.textContent.replace(/[₦$€£,\s]/g, "");
            if (!isNaN(rawText) && rawText.length > 0) {
                btn.textContent = `${symbol}${Number(rawText).toLocaleString()}`;
            }
        });

        const donationInput = document.getElementById("donation_amount");
        donationInput.placeholder = `${symbol}100,000`;
        donationInput.value = `${symbol}100,000`;
    });

    // --- Handle Pay Button Click ---
    document.getElementById("pay-button").addEventListener("click", function() {
        const payBtn = this;
        payBtn.disabled = true;
        payBtn.innerText = "Processing...";

        const rawAmount = document.getElementById("donation_amount").value;
        const amount = parseFloat(rawAmount.replace(/[^0-9.]/g, ''));
        const currency = document.getElementById("currency").value;
        const name = document.getElementById("name").value;
        const lastname = document.getElementById("lastname").value;
        const email = document.getElementById("email").value;
        const message = document.getElementById("message").value;
        const event_id = document.getElementById("event_id").value;

        if (!amount || !email) {
            alert("Please enter all required fields.");
            payBtn.disabled = false;
            payBtn.innerText = "Donate Now";
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
            callback: function(response) {
                fetch("verify-transaction-single.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        transaction_id: response.transaction_id,
                        donation_event_id: event_id,
                        message: message,
                        name: name + " " + lastname,
                        email: email
                    })
                })
                .then(res => res.json())
                .then(data => {
                    payBtn.disabled = false;
                    payBtn.innerText = "Donate Now";

                    if (data.status === "success") {
                        window.location.href = "donation.php?success=1&message=" + encodeURIComponent("Donation successful! Thank you for your support.");
                    } else {
                        alert("Payment verification failed. Please contact support.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    payBtn.disabled = false;
                    payBtn.innerText = "Donate Now";
                });
            },
            onclose: function() {
                console.log("Payment window closed.");
                payBtn.disabled = false;
                payBtn.innerText = "Donate Now";
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
            alertBox.style.display = "none";
            const url = new URL(window.location.href);
            url.searchParams.delete("success");
            url.searchParams.delete("message");
            window.history.replaceState(null, null, url.toString());
        }
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let limit = 5;
        function loadDonors() {
            fetch(`api/Models/fetch_recent_donors.php?limit=${limit}&id=<?= $eventId ?>`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("donors-list").innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        }

        loadDonors();

        document.getElementById("view-more-btn").addEventListener("click", function() {
            limit += 5;
            loadDonors();
        });
    });
</script>


</body>

</html>