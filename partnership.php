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

$page_title = "Ogeri Health Foundation - Partnerships";

$page_author = "Callistus";

$page_description = "";

$page_rel = '';

$page_name = 'Partnership.php';

$customs = array(
    "stylesheets" => ["assets/css/partnership.css"],
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
    <style>
        .upload-container {
        position: relative;
        display: flex;
        align-items: center;
        gap: 40px;
        }

        .upload-preview-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
        }

        .upload-preview img {
        max-width: 100px;
        height: auto;
        border-radius: 8px;
        border: 1px solid #ccc;
        }

        #remove-logo-image {
        background-color: transparent;
        color: var(--theme-color);
        border: none;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        cursor: pointer;
        }
        .upload-container {
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.upload-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-color);
}

.upload-placeholder i {
    font-size: 1.5rem;
}

.upload-preview {
    width: 100%;
    height: 100%;
    position: relative;
}

.upload-preview img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.remove-image {
    position: absolute;
    top: 0;
    right: 0;
    background-color: white;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
    </style>
    
    
</head>

<body>
    <?php include 'include/header.php'; ?>
    <!-- ==========Header-section=========== -->
    <div id="partnership-hero">
        <p class="text-white">Partner With Us</p>
        <a href="#partner-form"  class="th-btn style3">
            Partner With Us
        </a>
    </div>

    <!-- =============Body-section============== -->
    <section class="parther-body">
        <div class="body-title">
            <h2>Our Core Programs</h2>
            <p>At The Heart Of Our Mission—Programs That Make A Lasting Difference. </p>
        </div>
        <div class="container-2">
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

        <div class="container-2">
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

        <div class="container-2">
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

    <section class="py-5 section-bg">
        <div class="container content-wrapper">
            <div class="text-center mb-5">
                <h4 class="text-theme2 fw-bold mb-4">Technical Statistics</h4>
            </div>
            
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6 mx-auto">
                    <div class="stats-card text-center">
                        <div class="stats-number"><span class="counter" data-target="257">0</span>+</div>
                        <div class="stats-label">People Screened</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mx-auto">
                    <div class="stats-card text-center">
                        <div class="stats-number"><span class="counter" data-target="11">0</span>+</div>
                        <div class="stats-label">Health Outreaches</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mx-auto">
                    <div class="stats-card text-center">
                        <div class="stats-number"><span class="counter" data-target="90">0</span>+</div>
                        <div class="stats-label">Patients Diagnosed With High Blood Pressure</div>
                    </div>
                </div>
            </div>

            
        </div>
    </section>

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

    <div class="form-section" id="partner-form">
        <div class="form-title">
            <span>Get Started and Partner with us today</span>
            <p>Partner with us today and become a vital part of a mission that uplifts lives, strengthens communities,
                and brings hope to those who need it most. Whether you’re giving your time, resources, or
                expertise—every contribution counts, and together, we can make a lasting impact.</p>
        </div>

        <div class="form">
            <div class="form-container">
                <form id="addPartnerForm">
                    <div class="mb-3">
                        <label class="form-label">Add a Logo</label>
                        
                        <div class="upload-container add-border-blue border" id="logo-upload-container">
                            <div class="upload-area" id="uploadArea">
                                
                                <input type="hidden" id="existing_logo" name="existing_logo" />
                                <i class="fas fa-upload"></i>
                                <span>Upload</span>
                            </div>

                            <input type="file" id="logo-upload" accept="image/*" name="company_logo" hidden />

                            <!-- Group preview and remove together -->
                            <div class="upload-preview-container" style="display: none;">
                                <div class="upload-preview">
                                <img id="logo-preview" src="/placeholder.svg" alt="Logo Preview" />
                                </div>
                                <button type="button" id="remove-logo-image" class="btn btn-edit">
                                <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>

                            <!-- <div class="upload-placeholder">
                                <span>No image uploaded</span>
                            </div> -->
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="partnerName" class="form-label">Name of Brand/Company*</label>
                        <input type="text" class="form-control" id="partnerName" name="partner_name" placeholder="Enter Name" required>
                    </div>

                    <div class="mb-3">
                        <label for="partnerEmail" class="form-label">Company Email*</label>
                        <input type="email" class="form-control" id="partnerEmail" name="partner_email" placeholder="Enter Email Address" required>
                    </div>

                    <div class="mb-3">
                        <label for="partnerPhone" class="form-label">Company Phone Number</label>
                        <input type="text" class="form-control" id="partnerPhone" name="partner_phone" placeholder="Enter Phone Number">
                    </div>

                    
                    <div class="mb-3">
                        <label for="companyAddress" class="form-label">Company Address</label>
                        <input type="text" class="form-control" id="companyAddress" name="company_address" placeholder="Enter Address">
                    </div>

                    <div class="mb-3">
                        <label for="businessType" class="form-label">Business Type</label>
                        <select class="form-control" id="businessType" name="business_type">
                            <option value="" disabled selected>Select Business Type</option>
                            <option value="Technology">Technology</option>
                            <option value="Finance">Finance</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Retail">Retail</option>
                            <option value="Education">Education</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="partnershipType" class="form-label">Partnership Type</label>
                        <select class="form-control" id="partnershipType" name="partnership_type">
                            <option value="" disabled selected>Select Partnership Type</option>
                            <option value="Sponsor">Sponsor</option>
                            <option value="Collaborator">Collaborator</option>
                            <option value="Service Provider">Service Provider</option>
                            <option value="Investor">Investor</option>
                        </select>
                    </div>

                    

                    <div class="mb-3">
                        <label for="contactPerson" class="form-label">Point of Contact Name</label>
                        <input type="text" class="form-control" id="contactPerson" name="contact_person" placeholder="Enter Name">
                    </div>

                    <div class="mb-3">
                        <label for="contactRole" class="form-label">Point of Contact Role</label>
                        <input type="text" class="form-control" id="contactRole" name="contact_role" placeholder="Enter Role (e.g., CEO, Manager)">
                    </div>

                    

                    

                    <div class="modal-footer">
                       
                        <button type="submit" class="th-btn form-btn style3" id="onboardBtn">Onboard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
      <?php include 'include/footer.php'; ?>
    <script>
        $(document).ready(function () {
            $("#addPartnerForm").submit(function (e) {
                e.preventDefault();

                var formData = new FormData(this);
                formData.append("action", "save"); // Ensure action is included

                $.ajax({
                    url: "admin/partnership/partner_handler.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            showAlert(response.message, "success");
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            showAlert("Error: " + response.message, "error");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        console.error("Response:", xhr.responseText);
                        showAlert("An error occurred. Please check the console.", "error");
                    }
                });
            });
        });
        $(document).ready(function () {
        const uploadArea = $("#uploadArea");
        const fileInput = $("#logo-upload");
        const previewContainer = $(".upload-preview-container");
        const previewImage = $("#logo-preview");
        const placeholder = $(".upload-placeholder");
        const removeButton = $("#remove-logo-image");

        // Initially hide delete button
        removeButton.hide();

        // Click to upload
        uploadArea.click(() => fileInput.click());

        // When an image is selected
        fileInput.change(function (event) {
            const file = event.target.files[0];

            if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.attr("src", e.target.result);
                previewContainer.show();
                placeholder.hide();
                removeButton.show();
            };
            reader.readAsDataURL(file);
            }
        });

  // Remove image
            removeButton.click(function () {
                fileInput.val(""); // clear file input
                previewImage.attr("src", "/placeholder.svg"); // reset image
                previewContainer.hide();
                placeholder.show();
                removeButton.hide();
            });
         });

            // Remove selected image
            
        function showAlert(message, type = "success") {
            let alertBox = $("#alertBox");
            
            // Create alert element
            let alertDiv = $("<div>").addClass("alert").addClass(type === "success" ? "alert-success" : "alert-error");
            let closeButton = $("<span>").addClass("alert-close").html("&times;").click(function () {
                $(this).parent().fadeOut(300, function () {
                    $(this).remove();
                });
            });

            alertDiv.html(message).append(closeButton);
            alertBox.append(alertDiv);
            alertBox.fadeIn();

            // Auto-remove after 4 seconds
            setTimeout(function () {
                alertDiv.fadeOut(300, function () {
                    $(this).remove();
                });
            }, 4000);
        }
    </script>
    <script>
            const counters = document.querySelectorAll('.counter');
            let hasCounted = false;

            function animateCounters() {
                if (hasCounted) return; // prevents multiple triggers
                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-target');
                    const duration = 2000; // total animation time in ms
                    const stepTime = 10; // how often to update in ms
                    const increment = target / (duration / stepTime);
                    let count = 0;

                    const updateCounter = () => {
                        count += increment;
                        if (count < target) {
                            counter.innerText = Math.floor(count);
                            setTimeout(updateCounter, stepTime);
                        } else {
                            counter.innerText = target;
                        }
                    };

                    updateCounter();
                });
                hasCounted = true;
            }

            // Optional: Trigger when in view using Intersection Observer
            const statsSection = document.querySelector('.stats-card')?.parentElement;

            if ('IntersectionObserver' in window && statsSection) {
                const observer = new IntersectionObserver(entries => {
                    if (entries[0].isIntersecting) {
                        animateCounters();
                        observer.disconnect();
                    }
                }, { threshold: 0.5 });
                observer.observe(statsSection);
            } else {
                // fallback
                window.addEventListener('load', animateCounters);
            }
        </script>
  
    
</body>

</html>