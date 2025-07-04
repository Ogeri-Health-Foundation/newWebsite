<?php
session_start();
require 'api/Database/DatabaseConn.php';

 // Create an instance of DatabaseConn and establish connection
 $db = new DatabaseConn();
 $dbh = $db->connect();
?>

<?php

$page_title = "Ogeri Health Foundation - Home";

$page_author = "Mobolaji!";

$page_description = "";

$page_rel = '';

$page_name = 'index.php';

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
</head>

<body>
  <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

  <!--********************************
   		Code Start From Here 
	******************************** -->

  <!--==============================
    Header
============================== -->

  <?php include 'include/header.php'; ?>

  <style>
    .blog-single {
    position: relative;
    margin-bottom: var(--blog-space-y, 40px);
    background-color: var(--white-color);
    border-radius: 30px;
    overflow: hidden;
    width: 300px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.06);
}

.custom-blob {
  width: 100%;
  max-width: 800px;
  aspect-ratio: 1 / 1;
  background-color: #f0f4f8;
  margin: auto;
  overflow: hidden;

  /* More centered and expanded path to show full image */
  clip-path: path("M412,308.5Q371,367,308.5,397.5Q246,428,179,418Q112,408,79.5,346Q47,284,39,221Q31,158,78,104Q125,50,192.5,39Q260,28,318.5,60Q377,92,408.5,146Q440,200,412,308.5Z");
}

.custom-blob img {
  width: 100%;
  height: 420px;
  object-fit: cover;
  display: block;
}

@media (max-width: 750px) {
  .custom-blob {
    aspect-ratio: 3 / 4;
    max-width: 100%;
  }
  
  .custom-blob img{
    /* margin-right: 800px; */
  }
  
}



  </style>

  <!--==============================
Hero Area
==============================-->
  <div
    class="th-hero-wrapper hero-2"
    id="hero"
    data-bg-src="assets/img/hero/hero_bg_2_1.png"
    data-overlay="gray">
    <div
      class="shape-mockup hero-shape-2-1 jump"
      data-top="14%"
      data-left="5%">
      <div class="color-masking">
        <div
          class="masking-src"
          data-mask-src="assets/img/hero/hero-bg-shape2-1.png"></div>
        <img src="assets/img/hero/hero-bg-shape2-1.png" alt="shape" />
      </div>
    </div>
    <div
      class="shape-mockup hero-shape-2-2 jump-reverse"
      data-top="9%"
      data-left="45%">
      <img src="assets/img/hero/hero-bg-shape2-2.png" alt="shape" />
    </div>
    <div
      class="shape-mockup hero-shape-2-4 ripple-animation"
      data-bottom="15%"
      data-left="45%">
      <div class="color-masking">
        <div
          class="masking-src"
          data-mask-src="assets/img/hero/hero-bg-shape2-4.png"></div>
        <img src="assets/img/hero/hero-bg-shape2-4.png" alt="shape" />
      </div>
    </div>
    <div
      class="shape-mockup hero-shape-2-5"
      data-bottom="-3%"
      data-left="8.5%">
      <div class="color-masking2">
        <div
          class="masking-src"
          data-mask-src="assets/img/hero/hero-bg-shape2-5.png"></div>
        <img src="assets/img/hero/hero-bg-shape2-5.png" alt="shape" />
      </div>
    </div>
    <div class="shape-mockup hero-shape-2-6" data-bottom="-5%" data-left="3%">
      <div class="color-masking">
        <div
          class="masking-src"
          data-mask-src="assets/img/hero/hero-bg-shape2-6.png"></div>
        <img src="assets/img/hero/hero-bg-shape2-6.png" alt="shape" />
      </div>
    </div>
    <div class="shape-mockup hero-shape-2-7" data-bottom="-7%" data-left="0%">
      <img src="assets/img/hero/hero-bg-shape2-7.png" alt="shape" />
    </div>
    <div class="shape-mockup hero-shape-2-8" data-top="0%" data-right="0%">
      <div class="color-masking2">
        <div
          class="masking-src"
          data-mask-src="assets/img/hero/hero-bg-shape2-8.png"></div>
        <img src="assets/img/hero/hero-bg-shape2-8.png" alt="shape" />
      </div>
    </div>
    <div
      class="shape-mockup hero-shape-2-9"
      data-bottom="0%"
      data-left="0%"
      data-right="0">
      <img src="assets/img/hero/hero-bg-shape2-9.png" alt="shape" />
    </div>
    <div class="container">
      <div class="row gx-40 align-items-center flex-row-reverse">
        <div class="col-lg-6">
          <!--<div class="hero-2-img">-->
  <div class="custom-blob d-none d-lg-block">
    <img src="assets/img/hero/my-hero-image.jpg" alt="Nurse checking the vitals of a patient" class="" />
  </div>

          <!--  <div-->
          <!--    class="hero-2-shape"-->
          <!--    data-mask-src="assets/img/hero/hero-thumb-shape2-1.png"></div>-->
          <!--</div>-->
        </div>
        <div class="col-lg-6">
          <div class="hero-style2">
            <span class="sub-title after-none">Bringing Hope through Health</span>
            <h1 class="hero-title">
              <span class="title1">Building <span class="text-theme2">Healthier-</span>
                <div class="color-masking shake d-inline-flex">
                  <div
                    class="masking-src"
                    data-mask-src="assets/img/hero/hero-bg-shape2-3.png"></div>
                  <img
                    src="assets/img/hero/hero-bg-shape2-3.png"
                    alt="shape" />
                </div>
              </span>
              <span class="title2">Communities, </span>
              <span class="text-theme2"> One Step</span>
              <span class="title2"> At A Time</span>
            </h1>
            <p class="hero-text">
              Take Action for Better Health: Explore, Support, and Join Us in
              Making a Difference Today
            </p>
            <div class="btn-wrap">
              <a href="about.html" class="th-btn">Get Involved<i class="fa-solid fa-arrow-up-right ms-2"></i></a>
              <!-- <a
                  href="https://www.youtube.com/watch?v=_sI_Ps7JSEk"
                  class="play-btn style3 popup-video"
                  ><i class="fas fa-play"></i
                ></a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--======== / Feature Section ========-->
  <section class="space-top">
    <div class="container">
      <div class="row gy-4 justify-content-center">
        <div class="col-lg-3 col-md-6">
          <div class="feature-card">
            <div class="feature-card-bg-shape">
              <img
                src="assets/img/shape/feature-card-bg-shape1-1.png"
                alt="img" />
            </div>
            <div class="box-icon">
              <img src="assets/img/icon/heroIcon1.svg" alt="icon" />
            </div>
            <h3 class="box-title">Start donating</h3>
            <p class="box-text">
              Make an impact today by contributing to our mission of
              empowering communities with better health and education. Your
              support transforms lives.
            </p>
            <!-- <a class="link-btn style2" href="about.html"
                >View Details <i class="fa-solid fa-arrow-up-right ms-2"></i
              ></a> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="feature-card">
            <div class="feature-card-bg-shape">
              <img
                src="assets/img/shape/feature-card-bg-shape1-1.png"
                alt="img" />
            </div>
            <div class="box-icon">
              <img src="assets/img/icon/heroIcon2.svg" alt="icon" />
            </div>
            <h3 class="box-title">Quick fundraising</h3>
            <p class="box-text">
              Join us in creating change by organizing or participating in a
              fundraising campaign. Together, we can make healthcare and
              education accessible to all.
            </p>
            <!-- <a class="link-btn style2" href="about.html"
                >View Details <i class="fa-solid fa-arrow-up-right ms-2"></i
              ></a> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="feature-card">
            <div class="feature-card-bg-shape">
              <img
                src="assets/img/shape/feature-card-bg-shape1-1.png"
                alt="img" />
            </div>
            <div class="box-icon">
              <img src="assets/img/icon/heroIcon3.svg" alt="icon" />
            </div>
            <h3 class="box-title">Become a Volunteer</h3>
            <p class="box-text">
              Be part of our journey to build healthier communities. Share
              your time, skills, and passion to make a difference in the lives
              of those in need.
            </p>
            <!-- <a class="link-btn style2" href="about.html"
                >View Details <i class="fa-solid fa-arrow-up-right ms-2"></i
              ></a> -->
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="feature-card">
            <div class="feature-card-bg-shape">
              <img
                src="assets/img/shape/feature-card-bg-shape1-1.png"
                alt="img" />
            </div>
            <div class="box-icon">
              <img src="assets/img/icon/heroIcon4.svg" alt="icon" />
            </div>
            <h3 class="box-title">Partner With us</h3>
            <p class="box-text">
              Collaborate with us to expand our reach and amplify our impact.
              Let’s work together to bring sustainable health solutions to
              underserved communities.
            </p>
            <!-- <a class="link-btn style2" href="about.html"
                >View Details <i class="fa-solid fa-arrow-up-right ms-2"></i
              ></a> -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--==============================
About Area  
==============================-->
  <div class="overflow-hidden space" id="about-sec">
    <div
      class="shape-mockup about-bg-shape2-1 jump-reverse"
      data-top="10%"
      data-right="5%">
      <img src="assets/img/shape/heart-shape1.png" alt="shape" />
    </div>
    <div class="container">
      <div class="row gx-60 gy-60 align-items-center">
        <div class="col-lg-6">
          <div class=" " >
            <div style="width: 100%; height: 100%; position: relative;" class="">
              <img
                src="assets/img/ogeri_img/hero_og_1.jpg"
                alt="About"
                class=""
                style="  object-fit: contain; width: 100%;" />
                <div class="d-none d-md-block d-lg-flex justify-content-between mt-2">
                  <img src="assets/img/normal/DSC_1360.jpg" alt="About" style="width: 49%;">
                  <img src="assets/img/ogeri_img/hero_og_2.jpg" alt="" style="width: 49%;">
                </div>
            </div>
            <!-- <div class="img1">
               <img src="assets/img/normal/about_2_1.png" alt="About" /> 
              <img src="assets/img/ogeri_img/hero_og_1.jpg" alt="About" class="border" style="width: 485px; height: 605px; object-fit: contain;" />
            </div>
            <div class="img2 jump add-border-blue">
              <img src="assets/img/normal/DSC_1360.jpg" alt="About" />
            </div>
            <div
              class="img3 moving"
              data-mask-src="assets/img/normal/about_2_3-mask.png">
              <img
                data-mask-src="assets/img/normal/about_2_3-mask.png"
                src="assets/img/ogeri_img/hero_og_2.jpg"
                alt="About"
                style="width: 357px; height: 231px; object-fit: contain;" />
            </div>
            <div class="about-shape2-1 jump">
              <div class="color-masking">
                <div
                  class="masking-src"
                  data-mask-src="assets/img/shape/about_shape2_1.png"></div>
                <img src="assets/img/shape/about_shape2_1.png" alt="img" />
              </div>
            </div>
            <div class="about-shape2-2 jump-reverse">
              <div class="color-masking2">
                <div
                  class="masking-src"
                  data-mask-src="assets/img/shape/about_shape2_2.png"></div>
                <img src="assets/img/shape/about_shape2_2.png" alt="img" />
              </div>
            </div> -->
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-wrap2">
            <div class="title-area mb-35">
              <span class="sub-title after-none before-none">Welcome to The OGERI Health Foundation</span>
              <h2 class="sec-title">About Us</h2>
              <p class="mt-30">
                The OGERI Health Foundation is committed to improving health
                and empowering communities across Africa, starting with our
                impactful initiatives in Nigeria. Through health education,
                disease prevention, and innovative healthcare programs, we
                strive to address critical health challenges and create
                lasting change. Our journey began in Southeastern Nigeria,
                where we launched community outreach programs focused on blood
                pressure screenings, health education, and empowering
                individuals to take control of their health.
              </p>
            </div>
            <div class="about-feature-grid">
              <div class="box-icon">
                <img src="assets/img/icon/about-icon2-1.svg" alt="icon" />
              </div>
              <div class="media-body">
                <h4 class="box-title">Our Mission</h4>
                <p class="box-text">
                  To improve health outcomes and empower communities across
                  Africa, starting in Nigeria, by providing accessible
                  healthcare solutions, advancing health education, and
                  promoting preventive care to build healthier and
                  self-reliant futures for all.
                </p>
              </div>
            </div>
            <div class="about-feature-grid">
              <div class="box-icon">
                <img src="assets/img/icon/about-icon2-2.svg" alt="icon" />
              </div>
              <div class="media-body">
                <h4 class="box-title">Our Vision</h4>
                <p class="box-text">
                  A world where every individual has the knowledge, resources,
                  and support to take control of their health, fostering
                  empowered communities and healthier generations.
                </p>
              </div>
            </div>
            <div class="btn-wrap mt-40">
              <a href="about.php" class="th-btn">Learn More<i class="fas fa-arrow-up-right ms-2"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--==============================
Counter Area  
==============================-->
  <div class="space-bottom">
    <div class="container">
      <div class="counter-wrap">
        <div class="counter-card">
          <div class="media-body">
            <h2 class="box-number text-theme">
              <span class="counter-number">257</span><span class="fw-light">+</span>
            </h2>
            <p class="box-text">People screened</p>
          </div>
        </div>
        <div class="divider"></div>
        <div class="counter-card">
          <div class="media-body">
            <h2 class="box-number text-theme2">
              <span class="counter-number">11</span><span class="fw-light">+</span>
            </h2>
            <p class="box-text">Health Outreaches</p>
          </div>
        </div>
        <div class="divider"></div>
        <div class="counter-card">
          <div class="media-body">
            <h2 class="box-number text-theme">
              <span class="counter-number">90</span><span class="fw-light">+</span>
            </h2>
            <p class="box-text">Patients Diagnosed with High Blood Pressure</p>
          </div>
        </div>
        <div class="divider"></div>
      </div>
    </div>
  </div>
  <!--==============================
Service Area  
==============================-->
  <section class="space-bottom overflow-hidden" id="service-sec">
    <div
      class="service-wrap1 space th-radius overflow-hidden"
      data-bg-src="assets/img/bg/gray-bg2.png"
      data-overlay="gray"
      data-opacity="5">
      <div
        class="shape-mockup service-bg-shape1-5 d-xxl-inline-block d-none z-index-3 spin"
        data-top="15%"
        data-left="18%">
        <div class="color-masking">
          <div
            class="masking-src"
            data-mask-src="assets/img/shape/service_shape2_1.png"></div>
          <img src="assets/img/shape/service_shape2_1.png" alt="img" />
        </div>
      </div>
      <div
        class="shape-mockup service-bg-shape1-6 d-xxl-inline-block d-none z-index-3 jump"
        data-bottom="28%"
        data-right="5%">
        <div class="color-masking2">
          <div
            class="masking-src"
            data-mask-src="assets/img/shape/service_shape2_2.png"></div>
          <img src="assets/img/shape/service_shape2_2.png" alt="img" />
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7">
            <div class="title-area text-center">
              <span class="sub-title after-none before-none">Our Programs</span>
              <h2 class="sec-title">
                We Do it for all People - Humanist Services
              </h2>
            </div>
          </div>
          <div>
            <p class="text-dark mb-3 text-center">
              At OGERI Health Foundation, we believe that quality healthcare
              and education should be accessible to all, regardless of
              background or financial status. Our humanist approach ensures
              that every initiative is driven by compassion, inclusivity, and
              empowerment.
            </p>
          </div>
        </div>
        <div class="row gy-30 gx-30 justify-content-center">
          <div class="col-xl-4 col-md-6">
            <div class="service-card">
              <div class="box-thumb ">
                <img
                  src="assets/img/outreach.jpg"
                  alt="img" />
              </div>
              <div class="box-icon">
                <img
                  src="assets/img/icon/service-icon/service-card-icon1-3.svg"
                  alt="Icon" />
              </div>

              <div class="box-content">
                <h3 class="box-title">
                  <a href="what-we-do.php">Community Health Outreach</a>
                </h3>
                <p class="box-text">
                  We bring free health checks, education, and medical support directly to communities.
                </p>
                <a href="what-we-do.php" class="th-btn">Learn More<i class="fas fa-arrow-up-right ms-2"></i></a>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="service-card style2">
              <div class="box-thumb">
                <img
                  src="assets/img/app.jpg"
                  alt="img" />
              </div>
              <div class="box-icon">
                <img style="height:55px"
                  src="assets/img/appIcon.png"
                  alt="Icon" />
              </div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="what-we-do.php">Advancing Healthcare Through Digital Solutions</a>
                </h3>
                <p class="box-text">
                  We are using technology to make healthcare more accessible and efficient, <b>using our ELECTRONIC HEALTH RECORD(EHR) SYSTEM
                    and also Streamlining Patient care</b>
                </p>
                <a href="what-we-do.php" class="th-btn">Learn More<i class="fas fa-arrow-up-right ms-2"></i></a>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="service-card style2">
              <div class="box-thumb">
                <img
                  src="assets/img/partnership.jpg"
                  alt="img" />
              </div>
              <div class="box-icon">
                <img
                  style="height:55px"
                  alt="Icon"
                  src="assets/img/advocacyIcon.png" />
              </div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="what-we-do.php">Partnerships & Advocacy</a>
                </h3>
                <p class="box-text">
                  We co-create programs with local communities, ensuring that our initiatives are relevant, practical, and sustainable.
                </p>
                <a href="what-we-do.php" class="th-btn">Learn More<i class="fas fa-arrow-up-right ms-2"></i></a>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="service-card style2">
              <div class="box-thumb">
                <img
                  src="assets/img/research.jpg"
                  alt="img" />
              </div>
              <div class="box-icon">
                <img
                  src="assets/img/icon/service-icon/service-card-icon1-2.svg"
                  alt="Icon" />
              </div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="what-we-do.php">Research & Innovation
                  </a>
                </h3>
                <p class="box-text">
                  Improving Community Health – We collaborate with experts to develop solutions tailored to the real health challenges faced by our communities.
                </p>
                <a href="what-we-do.php" class="th-btn">Learn More<i class="fas fa-arrow-up-right ms-2"></i></a>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-md-6">
            <div class="service-card style2">
              <div class="box-thumb">
                <img

                  src="assets/img/heart.jpg"
                  alt="img" />
              </div>
              <div class="box-icon">
                <img
                  style="height:55px"
                  src="assets/img/heartIcon.png"
                  alt="Icon" />
              </div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="what-we-do.php">Heart Health Awareness
                  </a>
                </h3>
                <p class="box-text">
                  We teach people how to protect their hearts through engaging programs like: School Science Quizzes, Community Talks & Digital Resources and adult Literacy
                </p>
                <a href="what-we-do.php" class="th-btn">Learn More<i class="fas fa-arrow-up-right ms-2"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--==============================
Video Area  
==============================-->
  <!-- <div class="video-area-2 space bg-theme-dark">
      <div
        class="shape-mockup video-bg-shape2-1"
        data-top="0"
        data-left="0"
        data-bottom="0"
      >
        <img src="assets/img/shape/video_shape2_1.png" alt="img" />
      </div>
      <div class="container">
        <div class="row gy-40 gx-80 justify-content-between">
          <div class="col-lg-6">
            <div class="title-area mb-35">
              <span class="sub-title after-none before-none"
                >Make a Donations
              </span>
              <h2 class="sec-title text-white">
                Give Time, Change Lives Become a Donate Now
              </h2>
              <p class="text-light">
                Volunteers are the heart of our organization. Join our team to
                make a hands-on difference in your community. Whether you have a
                few hours or a few days, your time and skills can help us
                achieve our goals.
              </p>
            </div>
            <div class="donation-card style2">
              <div class="box-thumb">
                <img src="assets/img/donation/donation2-1.png" alt="image" />
              </div>
              <div class="box-content">
                <h3 class="box-title">
                  <a href="blog-details.html"
                    >Big charity: build school for poor children</a
                  >
                </h3>
                <p>Stay informed about our upcoming events and campaigns.</p>
                <div class="donation-card_progress-wrap">
                  <div class="progress">
                    <div class="progress-bar" style="width: 85%">
                      <div class="progress-value">85%</div>
                    </div>
                  </div>
                  <div class="donation-card_progress-content">
                    <span class="donation-card_raise">$5,00.00 Raised</span>
                    <span class="donation-card_goal text-theme2"
                      >Goal - $10,00.00</span
                    >
                  </div>
                </div>
                <a href="blog-details.html" class="th-btn style6"
                  >Donate Now <i class="fas fa-arrow-up-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="video-thumb2-1 video-box-center">
              <img src="assets/img/normal/video-thumb2-1.png" alt="img" />
              <h2 class="video-title">Watch Now</h2>
              <a
                href="https://www.youtube.com/watch?v=_sI_Ps7JSEk"
                class="play-btn style5 popup-video"
                ><i class="fa-sharp fa-solid fa-play"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  <!--==============================
Testimonial Area  
==============================-->
  <section class="testi-area-2 space-bottom" id="testi-sec">
    <div class="container">
      <div class="title-area text-center">
        <span class="sub-title after-none before-none">Testimonials</span>
        <h2 class="sec-title">Success Stories</h2>
      </div>
      <div class="row gx-0 justify-content-center">
        <div class="col-lg-12">
          <div class="slider-area testi-thumb-slider-wrap2">
            <div
              class="swiper th-slider testi-thumb-slider2"
              data-slider-options='{"loop": false,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"4"},"992":{"slidesPerView":"4","spaceBetween": "70"},"1200":{"slidesPerView":"5","spaceBetween": "100"},"1600":{"slidesPerView":"5","spaceBetween": "178"}}}'>
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="testi-box-img">
                    <img
                      class="testi-img"
                      src="assets/img/testimonial/grace_testimonial.jpg"
                      alt="img" />
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="testi-box-img">
                    <img
                      class="testi-img"
                      src="assets/img/testimonial/adebola_testimonial.jpg"
                      alt="img" />
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="testi-box-img">
                    <img
                      class="testi-img"
                      src="assets/img/testimonial/ifeanyi_testimonial.jpg"
                      alt="img" />
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="testi-box-img">
                    <img
                      class="testi-img"
                      src="assets/img/testimonial/drmary_testimonial.jpg"
                      alt="img" />
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="testi-box-img">
                    <img
                      class="testi-img"
                      src="assets/img/testimonial/chinedu_testimonial.jpg"
                      alt="img" />
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-bg-shape2-1">
              <img
                src="assets/img/testimonial/testimonial-bg-shape2-1.png"
                alt="img" />
            </div>
          </div>
        </div>
        <div class="col-lg-11">
          <div class="testi-slider2 slider-area">
            <div
              class="swiper th-slider"
              id="testiSlide2"
              data-slider-options='{"loop":false,"autoHeight": "true", "thumbs":{"swiper":".testi-thumb-slider2"}}'>
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="testi-card2">
                    <p class="box-text">
                      "Before OGERI Health Foundation came to our village, I
                      had no idea my blood pressure was dangerously high.
                      Their free screening and education saved my life. Now, I
                      check my blood pressure regularly and encourage others
                      to do the same."
                    </p>
                    <!-- <span class="testi-card_review">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span> -->
                    <h3 class="box-title">Grace U.</h3>
                    <p class="box-desig">Anambra, Nigeria</p>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="testi-card2">
                    <p class="box-text">
                      "As a mother of three, I struggled to access affordable
                      healthcare. OGERI's outreach program provided my
                      children with free medical checkups and essential health
                      education. Their kindness and commitment to our
                      well-being have been a blessing."
                    </p>
                    <!-- <span class="testi-card_review">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span> -->
                    <h3 class="box-title">Adebola O.</h3>
                    <p class="box-desig">Lagos, Nigeria</p>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="testi-card2">
                    <p class="box-text">
                      "I lost my father to a preventable illness. Thanks to
                      OGERI's health awareness campaigns, I now understand the
                      importance of regular checkups and preventive care.
                      Their work is truly life-changing."
                    </p>
                    <!-- <span class="testi-card_review">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span> -->
                    <h3 class="box-title">Ifeanyi E.</h3>
                    <p class="box-desig">Enugu, Nigeria</p>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="testi-card2">
                    <p class="box-text">
                      "OGERI Health Foundation’s commitment to grassroots
                      healthcare is inspiring. Their work in educating
                      communities and providing preventive care is a model for
                      how healthcare should be approached."
                    </p>
                    <!-- <span class="testi-card_review">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span> -->
                    <h3 class="box-title">Dr. Mary A.</h3>
                    <p class="box-desig">Community Health Volunteer</p>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="testi-card2">
                    <p class="box-text">
                      "I used to ignore my health because hospitals were too
                      expensive. OGERI's free checkups and education gave me
                      the confidence to prioritize my health. Today, I’m
                      healthier, and I even help others learn about preventive
                      care."
                    </p>
                    <!-- <span class="testi-card_review">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span> -->
                    <h3 class="box-title">Chinedu M.</h3>
                    <p class="box-desig">Abia, Nigeria</p>
                  </div>
                </div>
              </div>
            </div>
            <button
              data-slider-prev="#testiSlide2"
              class="slider-arrow style-border slider-prev">
              <i class="far fa-arrow-left"></i>
            </button>
            <button
              data-slider-next="#testiSlide2"
              class="slider-arrow style-border slider-next">
              <i class="far fa-arrow-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--==============================
Event Area  
==============================-->
  <section
    class="space overflow-hidden"
    data-bg-src="assets/img/bg/event-bg1-1.png">
    <div
      class="shape-mockup event-bg-shape1-1 movingX d-lg-block d-none"
      data-top="0"
      data-right="0">
      <div class="color-masking2">
        <div
          class="masking-src"
          data-mask-src="assets/img/shape/event_bg_shape1_1.png"></div>
        <img src="assets/img/shape/event_bg_shape1_1.png" alt="img" />
      </div>
    </div>
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-8">
          <div class="title-area">
            <span id="events" class="sub-title before-none after-none">Events & Programs</span>
            <h2 class="sec-title text-white">Our Monthly Outreaches</h2>
          </div>
        </div>
        <div class="col-auto">
          <div class="sec-btn">
            <a class="th-btn" href="contact.php">Contact Us Now <i class="fas fa-arrow-up-right ms-2"></i></a>
          </div>
        </div>
      </div>

      <!-- <div class="event-card-wrap">
        <div class="event-card" style=" width: 30%;">
          <div
            class="event-card_img"
            data-mask-src="assets/img/event/event_card1_1-mask.png">
            <img src="assets/img/ohf-feb-pic/image8.jpg" alt="event" style=" width: 100%;" />
          </div>
          <div class="event-card-hover-wrap">
            <div
              class="event-card-hover_img"
              data-mask-src="assets/img/event/event_card1_2-mask.png">
              <img src="assets/img/ohf-feb-pic/image8.jpg" alt="event" style=" width: 100%; aspect-ratio:3/3" />
              <div class="event-card-date">Feb 2024</div>
            </div>
            <div class="event-card-content">
              <div class="event-card-meta">
                <span class="event-card_location"><i class="far fa-map-marker-alt"></i>Afikpo North</span>
                <span class="event-card_time"><i class="far fa-clock"></i>10:00 am</span>
              </div>
              <h3 class="event-card_title">
                <a href="event-details.php?id=2">Febuary Outreach Event</a>
              </h3>
              <a href="event-details.php?id=2" class="link-btn">View more <i class="fas fa-arrow-up-right ms-2"></i></a>
            </div>
          </div>
        </div> -->

        <div class="event-card-wrap">
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
          <div class="th-blog blog-single has-post-thumbnail">
                            <div class="blog-img" style="width: 300px; height: 200px;">
                                <a href="event-details.php?id=<?= $eventid ?>">
                                    <img src="<?= $image ?>" class="w-100" alt="Event Image">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <a href="events.php">
                                        <i class="fas fa-calendar-days"></i><?= $date ?>
                                    </a>
                                    <a href="events.php">
                                        <i class="fas fa-clock"></i><?= $status ?>
                                    </a>
                                </div>
                                <h2 class="blog-title">
                                    <a href="event-details.php?id=<?= $eventid ?>"><?= $eventName ?></a>
                                </h2>
                                <p class="blog-text"><?= $description ?></p>
                                <a href="event-details.php?id=<?= $eventid ?>" class="th-btn btn-sm">
                                    Read More <i class="fas fa-arrow-up-right ms-2"></i>
                                </a>
                            </div>
                        </div>
          <?php endwhile; ?>
                <?php else: ?>
                    <p style='font-size: 2rem; font-weight: 800;'>No Events available.</p>
                <?php endif; ?>

          

          <!-- <div class="event-card">
            <div
              class="event-card_img"
              data-mask-src="assets/img/event/event_card1_1-mask.png"
            >
              <img src="assets/img/event/event1-3.png" alt="event" />
            </div>
            <div class="event-card-hover-wrap">
              <div
                class="event-card-hover_img"
                data-mask-src="assets/img/event/event_card1_2-mask.png"
              >
                <img src="assets/img/event/event1-3-hover.png" alt="event" />
                <div class="event-card-date">24 Oct 2024</div>
              </div>
              <div class="event-card-content">
                <div class="event-card-meta">
                  <span class="event-card_location"
                    ><i class="far fa-map-marker-alt"></i>African poor
                    city</span
                  >
                  <span class="event-card_time"
                    ><i class="far fa-clock"></i>10:30 am</span
                  >
                </div>
                <h3 class="event-card_title">
                  <a href="event-details.html"
                    >Charities working in high impact causes</a
                  >
                </h3>
                <a href="event-details.html" class="link-btn"
                  >View more <i class="fas fa-arrow-up-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>

          <div class="event-card">
            <div
              class="event-card_img"
              data-mask-src="assets/img/event/event_card1_1-mask.png"
            >
              <img src="assets/img/event/event1-4.png" alt="event" />
            </div>
            <div class="event-card-hover-wrap">
              <div
                class="event-card-hover_img"
                data-mask-src="assets/img/event/event_card1_2-mask.png"
              >
                <img src="assets/img/event/event1-4-hover.png" alt="event" />
                <div class="event-card-date">15 Nov 2024</div>
              </div>
              <div class="event-card-content">
                <div class="event-card-meta">
                  <span class="event-card_location"
                    ><i class="far fa-map-marker-alt"></i>African poor
                    city</span
                  >
                  <span class="event-card_time"
                    ><i class="far fa-clock"></i>11:00 am</span
                  >
                </div>
                <h3 class="event-card_title">
                  <a href="event-details.html"
                    >Charities working in high impact causes</a
                  >
                </h3>
                <a href="event-details.html" class="link-btn"
                  >View more <i class="fas fa-arrow-up-right ms-2"></i
                ></a>
              </div>
            </div>
          </div>

          <div class="event-card">
            <div
              class="event-card_img"
              data-mask-src="assets/img/event/event_card1_1-mask.png"
            >
              <img src="assets/img/event/event1-5.png" alt="event" />
            </div>
            <div class="event-card-hover-wrap">
              <div
                class="event-card-hover_img"
                data-mask-src="assets/img/event/event_card1_2-mask.png"
              >
                <img src="assets/img/event/event1-5-hover.png" alt="event" />
                <div class="event-card-date">19 Dec 2024</div>
              </div>
              <div class="event-card-content">
                <div class="event-card-meta">
                  <span class="event-card_location"
                    ><i class="far fa-map-marker-alt"></i>African poor
                    city</span
                  >
                  <span class="event-card_time"
                    ><i class="far fa-clock"></i>12:00 am</span
                  >
                </div>
                <h3 class="event-card_title">
                  <a href="event-details.html"
                    >Charities working in high impact causes</a
                  >
                </h3>
                <a href="event-details.html" class="link-btn"
                  >View more <i class="fas fa-arrow-up-right ms-2"></i
                ></a>
              </div>
            </div> -->
      </div>
    </div>
    </div>
  </section>
  <!--==============================
Process Area  
==============================-->
  <section class="space overflow-hidden">
    <div
      class="shape-mockup process-shape1-1 jump-reverse d-xxl-block d-none"
      data-top="20%"
      data-left="0">
      <img src="assets/img/about/work-process-hand.png" alt="img" />
    </div>
    <div class="container">
      <div class="title-area text-center">
        <span class="sub-title after-none before-none">Our Work Process
        </span>
        <h2 class="sec-title">How We Make a Difference</h2>
        <div>
          <p class="text-dark mb-3">
            At OGERI Health Foundation, we follow a structured approach to
            ensure our initiatives create a lasting impact in the communities
            we serve.
          </p>
        </div>
      </div>
      <div class="row gy-40 justify-content-center">
        <div class="col-lg-4 col-md-6 process-card-wrap">
          <div class="process-card">
            <div class="process-card-thumb-wrap">
              <div
                class="process-card-thumb"
                data-mask-src="assets/img/process/process-card-shape.png">
                <img
                  src="assets/img/about/process-card-1-1.png"
                  alt="img" />
              </div>
              <div class="process-card-icon">
                <img src="assets/img/icon/process-icon1-1.svg" alt="img" />
              </div>
              <div class="process-card-shape">
                <img
                  src="assets/img/process/process-card-shape2.png"
                  alt="img" />
              </div>
            </div>
            <div class="box-content">
              <h3 class="box-title">Identify & Mobilize</h3>
              <p class="box-text">
                We assess community health challenges, collaborate with local
                leaders, medical experts, and volunteers, and develop tailored
                outreach plans.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 process-card-wrap">
          <div class="process-card">
            <div class="process-card-thumb-wrap">
              <div
                class="process-card-thumb"
                data-mask-src="assets/img/process/process-card-shape.png">
                <img
                  src="assets/img/about/process-card-1-1.png"
                  alt="img" />
              </div>
              <div class="process-card-icon">
                <img src="assets/img/icon/process-icon1-2.svg" alt="img" />
              </div>
              <div class="process-card-shape">
                <img
                  src="assets/img/process/process-card-shape2.png"
                  alt="img" />
              </div>
            </div>
            <div class="box-content">
              <h3 class="box-title">Implement & Educate</h3>
              <p class="box-text">
                We conduct free medical checkups, screenings, and health
                education programs, ensuring individuals have the knowledge
                and resources to improve their health.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 process-card-wrap">
          <div class="process-card">
            <div class="process-card-thumb-wrap">
              <div
                class="process-card-thumb"
                data-mask-src="assets/img/process/process-card-shape.png">
                <img
                  src="assets/img/about/process-card-1-1.png"
                  alt="img" />
              </div>
              <div class="process-card-icon">
                <img src="assets/img/icon/process-icon1-3.svg" alt="img" />
              </div>
              <div class="process-card-shape">
                <img
                  src="assets/img/process/process-card-shape2.png"
                  alt="img" />
              </div>
            </div>
            <div class="box-content">
              <h3 class="box-title">Follow-Up & Sustain</h3>
              <p class="box-text">
                We provide ongoing support, track progress, and develop
                long-term partnerships to expand our programs and sustain
                health improvements in communities.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--==============================
Price Area  
==============================-->

    <section class="overflow-hidden space" id="blog-sec">
      <div
        class="shape-mockup blog-bg-shape2-1 jump-reverse d-xl-block d-none"
        data-top="20%"
        data-right="0"
      >
        <img src="assets/img/about/testimonial-heart.png" alt="img" />
      </div>
      <div class="container">
        <div class="title-area text-center">
          <span class="sub-title after-none before-none">News & Articles</span>
          <h2 class="sec-title">Our Latest News & Articles</h2>
        </div>
        <div class="slider-area">
          <div
            class="swiper th-slider has-shadow"
            id="blogSlider2"
            data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}'
          >
            <div class="swiper-wrapper">
            
            <?php
            try{
              if (!isset($dbh)) {
                throw new Exception("Database connection not found.");
            }
              
              $query = "SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at ASC";
              $stmt = $dbh->prepare($query);
              $stmt->execute();
            } catch (Exception $e) {
              echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
              $stmt = null;
          }
                ?>
             <?php if ($stmt && $stmt->rowCount() > 0): ?>
                <?php while ($blog = $stmt->fetch(PDO::FETCH_ASSOC)):
                    $image = !empty($blog['image']) ? "uploads/" . htmlspecialchars($blog['image']) : "assets/img/default-image.jpg";
                    $blogid = htmlspecialchars($blog['blog_id']);
                    $date = new DateTime($blog['published_at']);
                ?>

              <div class="swiper-slide">
                <div class="blog-card">
                  <div class="blog-img">
                    <a href="blog-details.php?id=<?= $blogid ?>">
                      <div
                        class="blog-img-shape1"
                        data-mask-src="assets/img/blog/blog-card-bg-shape1-2.png"
                      ></div>
                      <img
                        src="<?= $image ?>"
                        alt="blog image"
                      />
                    </a>
                  </div>
                  <div class="blog-content">
                    <div
                      class="blog-card-shape"
                      data-mask-src="assets/img/blog/blog-card-bg-shape1-1.png"
                    ></div>
                    <div class="blog-meta">
                      <a href=""
                        ><i class="fas fa-calendar"></i><?= $date->format('F Y') ?></a
                      >
                      <a href="blog.html"
                        ><i class="fas fa-tags"></i><?= htmlspecialchars($blog['category']) ?></a
                      >
                    </div>
                    <h3 class="box-title">
                      <a href="blog-details.php?id=<?= $blogid ?>"><?= htmlspecialchars($blog['blog_title']) ?></a>
                    </h3>
                    <a href="blog-details.php?id=<?= $blogid ?>" class="th-btn"
                      >Read More <i class="fas fa-arrow-up-right ms-2"></i
                    ></a>
                  </div>
                
                </div>
              </div>
              <?php endwhile; ?>
                <?php else: ?>
                    <p style='font-size: 2rem; font-weight: 800;'>No blogs available.</p>
                <?php endif; ?>
            </div>
          </div>
        </div>
        <button
          data-slider-prev="#blogSlider2"
          class="slider-arrow slider-prev">
          <i class="far fa-arrow-left"></i>
        </button>
        <button
          data-slider-next="#blogSlider2"
          class="slider-arrow slider-next">
          <i class="far fa-arrow-right"></i>
        </button>
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
    <svg
      class="progress-circle svg-content"
      width="100%"
      height="100%"
      viewBox="-1 -1 102 102">
      <path
        d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
        style="
            transition: stroke-dashoffset 10ms linear 0s;
            stroke-dasharray: 307.919, 307.919;
            stroke-dashoffset: 307.919;
          "></path>
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
</body>

</html>