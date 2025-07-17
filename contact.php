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
    "stylesheets" => ["assets/css/contactUs.css"],
    "scripts" => ["admin/assets/js/demo.js"]
);

$addons = array(
    "stylesheets" => ["https://some-external-url.css"],
    "scripts" => ["https://some-external-url.js"]
);

?>


    <head>
        <?php include 'include/head.php'; ?>
    </head>

    <body>
        <?php include "include/header.php"; ?>
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
                <form action="#" method="post" class="contact-form">
                    <div class="input-row">
                        <input type="text" placeholder="Name" name="name" id="name" required />
                        <input type="email" placeholder="Email" name="email" id="email" required />
                        <input type="text" placeholder="Subject" name="subject" id="company" required />
                    </div>
                    <textarea placeholder="Create Message Here" id="message" name="message"></textarea>
                    <button class="th-btn" id="submitBtn" type="submit">
                        <span class="btn-text">Send a Message</span>
                        <span class="btn-loader" style="display: none; margin-left: 8px; ">
                        <img src="assets/loader/Animation-1750057122629.gif" alt="Loading" width="30px" />
                        </span>
                    </button>
                </form>
            </div>
        </section>
        <div id="alert-container" style="
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        display: none;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        font-weight: bold;
        color: white;
        background-color: #28a745;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        "></div>
       <script></script></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const form = document.querySelector(".contact-form");
                const submitBtn = document.getElementById("submitBtn");
                const btnText = submitBtn.querySelector(".btn-text");
                const btnLoader = submitBtn.querySelector(".btn-loader");
                const alertBox = document.getElementById("alert-container");

                function showAlert(message, type = "success") {
                alertBox.textContent = message;
                alertBox.style.backgroundColor = type === "success" ? "#28a745" : "#dc3545";
                alertBox.style.display = "block";

                setTimeout(() => {
                    alertBox.style.display = "none";
                }, 4000);
                }

                form.addEventListener("submit", async function (e) {
                e.preventDefault();

                // Disable button and show loader
                submitBtn.disabled = true;
                btnText.textContent = "Sending";
                btnLoader.style.display = "inline-block";

                try {
                    const response = await fetch("mail.php", {
                        method: "POST",
                        body: new FormData(form),
                    });

                    // Check if response is valid JSON and handle errors properly
                    const contentType = response.headers.get("content-type");

                    if (!response.ok) {
                        // If the server responded with an error status
                        const errorText = await response.text(); // fallback if not JSON
                        throw new Error(`Server error: ${response.status} ${errorText}`);
                    }

                    if (contentType && contentType.includes("application/json")) {
                        const result = await response.json();

                        if (result.status === "success") {
                        showAlert(result.message, "success");
                        form.reset();
                        } else {
                        showAlert(result.message || "Something went wrong", "error");
                        }
                    } else {
                        throw new Error("Invalid response format. Expected JSON.");
                    }

                    } catch (err) {
                    showAlert(err.message || "Unexpected error occurred", "error");
                    } finally {
                    submitBtn.disabled = false;
                    btnText.textContent = "Send a Message";
                    btnLoader.style.display = "none";
                    }
                });
            });
        </script>
        
        <?php include "include/footer.php" ?>
    </body>
</html>