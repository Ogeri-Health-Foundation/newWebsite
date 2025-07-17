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
    // "stylesheets" => [""],
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
    <script src="https://kit.fontawesome.com/706f90924a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/blog.css">


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
    <!-- header section starts -->
    <section class="headers">
        <img src="./assets/img/donate/donation2-2.png" class="header-img img-fluid img-responsive" alt="header-img" style="object-fit:cover;object-position:bottom">

        <div class="header-details" class="text-danger" style="z-index: 0;">
            <h1 class="ohf_font text-white">Give Food to Homeless Children</h1>

            <div class="cta-buttons">
                <a href="#theDonate" class="donate-btn th-btn style3 text-decoration-none">Donate Now</a>
            </div>
        </div>

    </section>






    <!-- header section ends --><!--==============================
    Blog Area
==============================-->
    <section class="blog-container container mb-3">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-5">
                <!-- BLOG LIST starts -->
                <div class="row">
                    <div class="col-12">
                        <div class="card h-100" style="border: none;">
                            <div class="card-body">
                                <h2 class="card-title ohf_font mt-3"><?= $eventName ?></h2>
                                <div class="card-text mt-2">
                                    <?= $description ?>
                                </div>
                            </div>
                        </div>

                        <div class="btn bg-green px-5" style="border-radius:15px">
                            <div class="text-white"><?= $category ?></div>
                        </div>
                    </div>
                </div>
                <!-- BLOG LIST ends -->


            </div>

            <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-5">
                <div class="blog-search blog-categories mt-4" style="background-color:#f7a3341a;">
                    <h4 class="ohf_font text-orange">Recent Donors</h4>
                    <div class="category-lists">

                        <div id="donors-list">

                        </div>


                        <div class="see-more d-flex justify-content-center">
                            <button type="button" id="view-more-btn" class="btn w-50 mx-auto btn-green2 mt-4" style="border-radius:12px">See More</button>
                        </div>


                    </div>
                </div>
            </div>



            <div class="row d-flex align-items-center mt-5" id="theDonate">
                <div class="col-12 col-md-8">
                    <div class="blog-search mt-4">

                        <div class="card-bottom">
                            <!-- Progress Bar Container -->
                            <div class="progress-bar-container" style="background-color: #e9ecef; border-radius: 10px; overflow: hidden;">
                                <div class="progress-bar bg-orange" style="width: <?= $percentageRaised ?>%; border-radius: 10px;">
                                    <?= $percentageRaised ?> %
                                </div>
                            </div>

                            <!-- Amounts Raised and Goal -->
                            <div class="mt-2 d-flex justify-content-between">
                                <div class="label">Amount Raised:
                                    <span class="value fw-bold">&#x20A6;<?= $raisedAmount ?></span>
                                </div>
                                <div class="label">Goal:
                                    <span class="value fw-bold">&#x20A6;<?= $goalAmount ?></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mt-4">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="donate-btn px-5 th-btn style3 text-decoration-none">Donate Now</button>
                    </div>
                </div>
            </div>


















            <style>
                .amounts {
                    display: flex;
                    justify-content: space-between;
                    font-size: 14px;
                    color: #333;
                    font-family: "Poppins", sans-serif;
                }

                .amounts .label {
                    color: #8c8c8c;
                    font-weight: 400;
                }

                .amounts .value {
                    color: black;
                    font-weight: 600;
                }

                /* Donate section */
                .donate-section {
                    background-color: #f8f4f4;
                    padding: 50px 20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .donate-container {
                    width: 100%;
                }

                .donation-form {
                    border-radius: 10px;
                    border: 2px solid #ddd;
                    padding: 10px;
                    width: 100%;
                }

                .headers1 {
                    text-align: center;
                    margin-bottom: 30px;
                }

                .headers1::before {
                    background: none !important;
                }

                .headers1 .title-row {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 10px;
                }

                .headers1 img {
                    width: 60px;
                    margin-bottom: 15px;
                }

                .headers1 h2 {
                    color: var(--button-bg-color);
                    font-size: 2em;
                    margin-bottom: 5px;
                }

                .headers1 p {
                    color: #000000;
                    font-size: 20px;
                    font-family: "Poppins", sans-serif;
                    font-weight: 400;
                }

                .form-section {
                    margin-bottom: 30px;
                    font-family: "Poppins", sans-serif;
                    font-weight: 500;
                }

                .form-section h3 {
                    color: #333;
                    font-family: "Poppins", sans-serif;
                    font-weight: 500;
                    font-size: 26px;
                    margin-bottom: 20px;
                    border-bottom: 1px solid #eee;
                    padding-bottom: 10px;
                }

                .form-group {
                    margin-bottom: 20px;
                    font-family: "Poppins", sans-serif;
                    font-weight: 500;
                }

                .form-group label {
                    display: block;
                    margin-bottom: 8px;
                    color: #8c8c8c;
                    font-weight: 500;
                }

                .form-group select,
                .form-group input[type="text"],
                .form-group textarea {
                    width: 100%;
                    padding: 12px 15px;
                    border: 1px solid #ddd;
                    border-radius: 6px;
                    font-size: 1em;
                    color: #333;
                    box-sizing: border-box;
                }

                .form-group input[type="text"]::placeholder,
                .form-group textarea::placeholder {
                    color: #000000;
                    font-family: "Poppins", sans-serif;
                    font-weight: 300;
                    font-size: 12px;
                }

                .form-group select {
                    appearance: none;
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23666%22%20d%3D%22M287%2069.9H5.4c-7.9%200-11.2%209.4-6.4%2014.2l130.4%20129.2c4.4%204.3%2011.6%204.3%2016%200l130.4-129.2c4.8-4.8%201.6-14.2-6.3-14.2z%22%2F%3E%3C%2Fsvg%3E");
                    background-repeat: no-repeat;
                    background-position: right 15px center;
                    background-size: 10px;
                }

                .amount-options {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                    gap: 10px;
                    margin-top: 10px;
                    margin-bottom: 20px;
                }

                .amount-option-btn {
                    background-color: #f0f0f0;
                    border: 1px solid #e0e0e0;
                    padding: 12px 15px !important;
                    border-radius: 6px;
                    cursor: pointer;
                    font-size: 1em;
                    color: #333;
                    transition: background-color 0.3s, border-color 0.3s;
                    text-align: center;
                    width: 100%;
                    box-sizing: border-box;
                    border: none;
                }

                .amount-option-btn:hover {
                    background-color: #e5e5e5;
                    border-color: #d0d0d0;
                }

                .amount-option-btn.selected {
                    background-color: #ff8c00;
                    border-color: #ff8c00;
                    color: #fff;
                }

                .row {
                    /* display: flex; */
                    /* flex-wrap: wrap; */
                    /* gap: 15px; */
                }

                .row .form-group {
                    flex: 1 1 calc(50% - 15px);
                    min-width: 0;
                }

                textarea {
                    resize: vertical;
                    min-height: 100px;
                }

                .submit-button2 {
                    width: 100%;
                    max-width: 500px;
                    padding: 15px;
                    background-color: var(--button-bg-color) !important;
                    color: #fff;
                    border: none;
                    border-radius: 50px;
                    font-size: 1.2em;
                    font-weight: 600;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 30px auto 0;
                }

                .submit-button:hover {
                    background-color: #e67e00;
                }

                /* Responsive Design */
                @media (max-width: 768px) {
                    .donate-section {
                        padding: 30px 15px;
                    }

                    .headers1 h2 {
                        font-size: 1.5em;
                    }

                    .headers1 p {
                        font-size: 16px;
                    }

                    .form-section h3 {
                        font-size: 20px;
                    }

                    .amount-options {
                        grid-template-columns: repeat(2, 1fr);
                    }

                    .row .form-group {
                        flex: 1 1 100%;
                    }

                    .submit-button2 {
                        width: 100%;
                        font-size: 1em;
                        padding: 12px;
                    }
                }

                @media (max-width: 480px) {
                    .headers1 img {
                        width: 50px;
                    }

                    .headers1 h2 {
                        font-size: 1.3em;
                    }

                    .amount-options {
                        grid-template-columns: 1fr;
                    }

                    .form-group select,
                    .form-group input[type="text"],
                    .form-group textarea {
                        padding: 10px 12px;
                        font-size: 14px;
                    }
                }
            </style>


            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index:9999999999;">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="donate-container" style="width:100%">
                                <div class="headers1">
                                    <div class="title-row">
                                        <img src="./assets/img/icon/heart-icon.png" alt="Heart Icon" />
                                        <h2>Make A Donation</h2>
                                    </div>
                                    <p>Your Donation Has The Power To Transform Lives</p>
                                </div>
                                <div class="donation-form" id="donatenow">
                                    <form id="donation-form" class="contact-form">
                                        <input type="hidden" name="donation_event_id" value="<?= $eventId ?>" id="event_id">
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

                                        <div class="form-section">
                                            <h3>Personal Information</h3>
                                            <div class="row d-flex">
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-green" data-bs-dismiss="modal">Cancel</button>
                        </div>
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


    <!-- Flutterwave Payment Script -->
    <!-- <script src="./assets/js/donations.js"></script> -->

    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all amount buttons and the donation amount input
            const amountButtons = document.querySelectorAll('.amount-option-btn');
            const donationAmountInput = document.getElementById('donation_amount');

            // Add click event to each amount button
            amountButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // 1. Remove 'selected' class from all buttons
                    amountButtons.forEach(btn => btn.classList.remove('selected'));

                    // 2. Add 'selected' class to clicked button
                    this.classList.add('selected');

                    // 3. Update the donation input with the clicked amount
                    donationAmountInput.value = this.textContent.trim();
                });
            });

            // Optional: Handle custom amount input to deselect buttons when typing
            donationAmountInput.addEventListener('focus', function() {
                amountButtons.forEach(btn => btn.classList.remove('selected'));
            });
        });

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
            const event_id = document.getElementById("event_id").value;
            console.log(event_id);

            if (!amount || !email) {
                alert("Please enter all required fields.");
                return;
            }

            console.log("Name:", name);
            console.log("Lastname:", lastname);
            console.log("Email:", email);

            FlutterwaveCheckout({
                public_key: "FLWPUBK_TEST-7343bad195d49ea19fed9bae134b8c87-X",
                tx_ref: "DONATE-" + Math.floor(Math.random() * 1000000),
                amount: parseFloat(amount),
                currency: currency,
                customer: {
                    email: email,
                    name: name + " " + lastname, // Make sure this is properly concatenated
                },
                callback: function(response) {
                    fetch("verify-transaction-single.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                transaction_id: response.transaction_id,
                                donation_event_id: event_id,
                                message: message
                            })
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
        document.addEventListener("DOMContentLoaded", function() {
            let limit = 5; // Initial limit
            function loadDonors() {
                fetch(`api/Models/fetch_recent_donors.php?limit=${limit}&id=<?= $eventId ?>`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById("donors-list").innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            }

            loadDonors(); // Load initial donors

            document.getElementById("view-more-btn").addEventListener("click", function() {
                limit += 5; // Increase the limit
                loadDonors();
            });
        });
    </script>


</body>

</html>