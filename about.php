<?php
session_start();
require 'api/Database/DatabaseConn.php';

 // Create an instance of DatabaseConn and establish connection
 $db = new DatabaseConn();
 $dbh = $db->connect();
?>

<?php

$page_title = "Ogeri Health Foundation - About";

$page_author = "Praise!";

$page_description = "";

$page_rel = '';

$page_name = 'About';

$customs = array(
    "stylesheets" => ["assets/css/about.css"],
    "scripts" => [""]
);

$addons = array(
    "stylesheets" => ["https://some-external-url.css"],
    "scripts" => ["https://some-external-url.js"]
);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    
   
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <?php include 'include/head.php'; ?>

    

</head>
<body>
    <?php include 'include/header.php'; ?>

    <main>
        <div class="breadcumb-wrapper about-hero">
            <div class="container">
                <div class="breadcumb-content">
                    <ul class="breadcumb-menu">
                        <li><a href="index.php">Home</a></li>
                        <li>About Us</li>
                    </ul>
                    <h1 class="breadcumb-title">About Us</h1>
                    
                </div>
            </div>
        </div>

        <section class="" style="background-color:#F8F4F4;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mt-5">
                        <h4 class="text-theme2 text-center text-sm-start">WELCOME TO OGERI HEALTH FOUNDATION</h4>
                        <p class="sub-head my-3 text-dark text-center text-sm-start">We Believe We Can Save More Lives With You </p>

                        <p class="about-text mb-5 px-2 px-sm-0 text-black">
                            The OGERI Health Foundation is committed to improving health and empowering communities across Africa, starting with our impactful initiatives in Nigeria. Through health education, disease prevention, and innovative healthcare programs as  we strive to address critical health challenges and create lasting change. Our journey began in Southeastern Nigeria, where we launched community outreach programs focused on blood pressure screenings, health education, and empowering individuals to take control of their health.
                        </p>

                        <a href="volunteer.php" class="th-btn style3 my-3">Be a Volunteer</a>
                    </div>
                    <div class="col-md-6 ">
                        <img src="assets/img/about/first-img.jpg" alt="">
                    </div>
                </div> 
            </div>
        </section>
        
        <section class="" style="background-color: #F8F4F4;">
            <div class="pt-5 container">
                <div class="text-center">
                    <p class="text-dark">Let's Start Donating</p>
                    <h4 class="text-theme2">See Your Impact: Transparent Donation Causes</h4>
                </div>
                <div class="container mt-5">
                    <div class="row justify-content-center gy-4">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                            <div class="impact-circle text-center">
                                <p class="text-dark fs-3"><b><span class="counter" data-target="10000">0</span>+</b></p>
                                <p class="w-75 mx-auto">People Treated Through Medical Outreach Programs</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                            <div class="impact-circle bg-theme text-white text-center">
                                <p class="text-white fs-3"><b><span class="counter" data-target="5000">0</span>+</b></p>
                                <p class="text-white w-75 mx-auto">Children vaccinated and protected from preventable diseases</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                            <div class="impact-circle text-center">
                                <p class="text-dark fs-3"><b><span class="counter" data-target="1200">0</span>+</b></p>
                                <p class="w-75 mx-auto">Families received life-saving medications</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                            <div class="impact-circle bg-theme text-white text-center">
                                <p class="text-white fs-3"><b><span class="counter" data-target="50">0</span>+</b></p>
                                <p class="text-white w-75 mx-auto">Communities reached with health education initiatives</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>

        <section class="" style="background-color: #F8F4F4;">
            <div class="container py-5">
                <h4 class="text-center">Our Mission And Vision</h4>
                <div class="row mt-5">
                    <div class="col-md-6 mb-3">
                        <div class="mission-card">
                            <div class="d-flex align-items-center">
                                
                                <h5 class="text-theme2"><i class="fa-solid fa-bullseye-arrow fa-fade fa-xl me-3 " style="color: #24ABA0"></i>Our mission</h5>
                            </div>
                            <p class="text-white">To improve health outcomes and empower communities across Africa, starting in Nigeria, by providing accessible healthcare solutions, advancing health education, and promoting preventive care to build healthier and self-reliant futures for all.</p>

                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="mission-card bg-theme">
                            <div class="d-flex align-items-center">

                                <h5 class="text-theme2"><i class="fa-solid fa-binoculars fa-fade fa-xl me-3 " style="color: #2d3f53bd"></i>Our vision</h5>
                            </div>
                            <p class="text-white">To improve health outcomes and empower communities across Africa, starting in Nigeria, by providing accessible healthcare solutions, advancing health education, and promoting preventive care to build healthier and self-reliant futures for all.</p>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-5">
            <div class="container">
                <div class="text-center">
                    
                    <h4 class="text-theme2">Our Core Values</h4>
                    <p class="text-dark">Guiding Principles That Drive Our Mission</p>
                </div>

                <div class="row g-4   mt-5">
                    <div class="col-md-6 d-flex justify-content-center">
                        <div class="values-card ">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <img src="assets/img/about/donor-friendly.svg" alt="">
                                <h5 class="text-theme2">Donor Friendly</h5>
                            </div>
                            <p>Stay updated with the latest news, events, and impact stories from our organization. Subscribe to our newsletter</p>

                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center">
                        <div class="values-card ">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <img src="assets/img/about/fundrising.svg" alt="">
                                <h5 class="text-theme2">Fundraising Trust</h5>
                            </div>
                            <p>Stay updated with the latest news, events, and impact stories from our organization. Subscribe to our newsletter</p>

                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center">
                        <div class="values-card ">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <img src="assets/img/about/charity.svg" alt="">
                                <h5 class="text-theme2">Charity Donate</h5>
                            </div>
                            <p>Stay updated with the latest news, events, and impact stories from our organization. Subscribe to our newsletter</p>

                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center">
                        <div class="values-card ">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <img src="assets/img/about/treatment.svg" alt="">
                                <h5 class="text-theme2">Treatment Help</h5>
                            </div>
                            <p>Stay updated with the latest news, events, and impact stories from our organization. Subscribe to our newsletter</p>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section style="background-color: #F8F4F4;">
            <div class="container mt-5 py-5">
                <h4 class="text-theme2 text-center">Meet The Brilliant Leaders Of Ogeri Health Foundation </h4>

                <div class="row mt-5">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
                        <div class="leader-div"  data-aos="flip-left"
     data-aos-delay="200">
                            <img src="assets/img/about/outreach-1.svg" alt="" class="leader-img"  >
                            <div class="text-center leader-card">
                                <p class="text-theme2 leader-name" >Dr Joseph Ekuma Irem</p>
                                <p class="text-dark mt-1">Chief Operating Officer</p>

                                <div class="th-social style2 text-center">
                                    <a target="_blank" href="https://www.linkedin.com/in/obyenwo/"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3" >
                        <div class="leader-div"  data-aos="flip-left"
     data-aos-delay="200">
                            <img src="assets/img/about/outreach-1.svg" alt="" class="leader-img" >
                            <div class="text-center leader-card">
                                <p class="text-theme2 leader-name">Otu Irem</p>
                                <p class="text-dark mt-1">Outreach Cordinator</p>

                                <div class="th-social style2 text-center">
                                    <a target="_blank" href="https://www.linkedin.com/in/obyenwo/"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                    <div class="col-md-6 mb-3" >
                        <div class="leader-div"  data-aos="flip-right"
     data-aos-delay="200">
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
                    <div class="row text-center justify-content-center position-relative gy-5">
                        
                        <!-- Step 1 -->
                        <div class="col-12 col-md-4 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
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
                        <div class="d-none d-md-block position-absolute connector" style="top: 160px; left: 27%; width: 14%;">
                            <svg viewBox="0 0 200 50" preserveAspectRatio="none" style="width: 100%; height: 50px;">
                                <path d="M0,25 C50,0 150,50 200,25" stroke="#ccc" stroke-dasharray="5,5" fill="transparent" />
                            </svg>
                        </div>

                        <!-- Step 2 -->
                        <div class="col-12 col-md-4 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
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
                        <div class="d-none d-md-block position-absolute connector" style="top: 160px; left: 60%; width: 14%;">
                            <svg viewBox="0 0 200 50" preserveAspectRatio="none" style="width: 100%; height: 50px;">
                                <path d="M0,25 C50,0 150,50 200,25" stroke="#ccc" stroke-dasharray="5,5" fill="transparent" />
                            </svg>
                        </div>

                        <!-- Step 3 -->
                        <div class="col-12 col-md-4 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="300">
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

        <section class="py-5" style="background:  url('assets/img/about/test-bg.jpg') center/cover no-repeat;">
            <div class="container">
                <div class="text-center text-white mb-5">
                    <p class="text-white">Testimonials</p>
                    <h4 class="text-theme2 fw-semibold">What People Say About Our Charity</h4>
                </div>

                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner  py-5 px-2">

                        <!-- Slide 1 -->
                        <div class="carousel-item active">
                            <div class="row justify-content-center">
                                <!-- Testimonial Card 1 -->
                                <div class="col-md-4 mb-4" data-aos="fade-up">
                                    <div class="bg-white p-4 rounded shadow position-relative h-100 test-card">
                                        <i class="fas fa-quote-left"></i>
                                        <p class="text-muted mt-4">Lorem ipsum dolor sit amet, consectetur tur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <div class="d-flex align-items-center mt-4">
                                        <img src="assets/img/about/vol-1.svg" alt="profile" class="rounded-circle me-3" width="50" height="50">
                                        <div>
                                            <h6 class="mb-0">Opara Dara</h6>
                                            <small class="text-muted">Teacher</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial Card 2 (highlighted) -->
                                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                                    <div class="p-4 rounded shadow text-white test-card" style="background-color: #1AC0A2;">
                                        <i class="fas fa-quote-left bg-white" style="color: #24ABA0"></i>
                                        <p class="mt-4">Lorem ipsum dolor sit amet, consectetur tur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <div class="d-flex align-items-center mt-4">
                                        <img src="assets/img/about/vol-2.svg" alt="profile" class="rounded-circle me-3" width="50" height="50">
                                        <div>
                                            <h6 class="mb-0 text-white">Opara Dara</h6>
                                            <small>Teacher</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial Card 3 -->
                                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                                    <div class="bg-white p-4 rounded shadow position-relative test-card">
                                        <i class="fas fa-quote-left"></i>
                                        <p class="text-muted mt-4">Lorem ipsum dolor sit amet, consectetur tur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <div class="d-flex align-items-center mt-4">
                                        <img src="assets/img/about/vol-3.svg" alt="profile" class="rounded-circle me-3" width="50" height="50">
                                        <div>
                                            <h6 class="mb-0">Opara Dara</h6>
                                            <small class="text-muted">Teacher</small>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                

                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="carousel-item">
                            <div class="row justify-content-center">
                                <div class="col-md-4 mb-4">
                                    <div class="bg-white p-4 rounded shadow position-relative test-card">
                                        <i class="fas fa-quote-left"></i>
                                        <p class="text-muted mt-4">Lorem ipsum dolor sit amet...</p>
                                        <div class="d-flex align-items-center mt-4">
                                            <img src="assets/img/about/vol-3.svg" class="rounded-circle me-3" width="50" height="50">
                                            <div>
                                                <h6 class="mb-0">Opara Dara</h6>
                                                <small class="text-muted">Teacher</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="bg-white p-4 rounded shadow position-relative test-card">
                                        <i class="fas fa-quote-left"></i>
                                        <p class="text-muted mt-4">Lorem ipsum dolor sit amet...</p>
                                        <div class="d-flex align-items-center mt-4">
                                            <img src="assets/img/about/vol-3.svg" class="rounded-circle me-3" width="50" height="50">
                                            <div>
                                                <h6 class="mb-0">Opara Dara</h6>
                                                <small class="text-muted">Teacher</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional slides go here (optional) -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active carousel-indicator-dot" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="carousel-indicator-dot"></button>
                        </div>

                    </div>

                    <!-- Custom Carousel Indicators -->
                    <!-- <div class="d-flex justify-content-center mt-4">
                        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active carousel-indicator-dot" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" class="carousel-indicator-dot" aria-label="Slide 2"></button>
                        
                    </div> -->
                </div>
            </div>
        </section>
    </main>
    <?php include 'include/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
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
    
</body>
</html>