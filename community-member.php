<?php

    $page_title = "Ogeri Health Foundation - Community Members";

    $page_author = "Okibe!";

    $page_description = "";

    $page_rel = '';

    $page_name = 'comunity-member.php';

    $customs = array(
                "stylesheets" => ["assets/css/community.css"],
                "scripts" => ["admin/assets/js/demo.js"]
               );

    $addons = array(
                "stylesheets" => ["https://some-external-url.css"],
                "scripts" => ["https://some-external-url.js"]
               );

?>

<style>
    #toast-success {
            position: fixed;
            bottom: -100px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            color: #4a5568;
            display: flex;
            align-items: center;
            width: auto;
            z-index: 99999;
            max-width: auto;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: bottom 0.5s ease;
        }
        .show {
            bottom: 20px !important;
        }
        .icon {
            width: 26px;
            height: 26px;
            background: #d1fae5;
            color: #10b981;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 10px;
        }
        .close-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            font-size: 20px;
            margin-left: 5px;
        }




        #bad-toast {
            position: fixed;
            bottom: -100px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            color: #4a5568;
            display: flex;
            align-items: center;
            z-index: 99999;
            width: auto;
            max-width: auto;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: bottom 0.5s ease;
        }
        .bad-show {
            bottom: 20px !important;
        }
        .bad-icon {
            width: 26px;
            height: 26px;
            background:rgb(250, 209, 209);
            color:rgb(185, 16, 16);
            display: flex;
            align-items: center;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 600;
            justify-content: center;
            border-radius: 50%;
            margin-right: 10px;
        }

        .cta-blink a {
            animation: blink 1.2s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
       
   </style>

<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">

<head>
    <?php include 'include/head.php'; ?>
   

</head>
 
    

</head>

<body>

<div id="toast-success">
        <div class="icon">✔</div>
        <div id="toast-message">login success</div>
        <button class="close-btn" onclick="hideToast()">&times;</button>
    </div>

    <div id="bad-toast">
    <div class="bad-icon"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg></div>
        <div id="bad-toast-message">login not successful</div>
        <button class="close-btn" onclick="hideToast()">&times;</button>
    </div>


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
    <div class="breadcumb-wrapper " data-bg-src="assets/img/partnership.jpg" data-overlay="theme">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Community members</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li>Community</li>
                </ul>
            </div>
        </div>
    </div><!--==============================


    
Team Area  
==============================-->
    <!-- healthcare workers -->
     <?php
    require 'api/Database/DatabaseConn.php';

    $db = new DatabaseConn();
    $dbh = $db->connect();

    // Query to get health workers from different tables
    $query = "
        SELECT doctor_name AS name, area_of_specialization, status, is_available, image FROM doctors
        UNION ALL
        SELECT nurse_name AS name, area_of_specialization, status, is_available, image FROM nurses
        UNION ALL
        SELECT physiologist_name AS name, area_of_specialization, status, is_available, image FROM physiologist
    ";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $healthWorkers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <section class="space health-worker-section text-center container">
        <div class="title-area text-center">
            <span class="sub-title after-none before-none">
                <i class="far fa-heart text-theme"></i> Health care providers
            </span>
            <h2 class="sec-title">Meet our Health care providers</h2>
        </div>

        <div class="provider-card-box-container">
            <div class="mother-container row gap-2 mx-auto">
                <?php if (empty($healthWorkers)): ?>
                    <div style="text-align: center; padding: 40px 20px;">
                        <h3 style="color: #888; font-weight: 600;">No Health Worker at the moment</h3>
                        <p class="cta-blink" style="margin-top: 20px;">
                            <a href="contact.php" style="color: var(--theme-color2); font-size: 1.2rem; text-decoration: none; font-weight: bold;">
                                Contact us to become a member <span style="font-size: 1.5rem;">➜</span>
                            </a>
                        </p>
                    </div>
                <?php else: ?>
                    <?php foreach ($healthWorkers as $worker): ?>
                        <div class="main-provider-container col-md-4 mb-3">
                            <div class="img-container">
                                <img src="<?= !empty($worker['image']) ? 'Staff_images/' . htmlspecialchars($worker['image']) : 'assets/img/default-image.jpg' ?>"
                                    alt="<?= htmlspecialchars($worker['name']) ?>"
                                    class="provider-img"
                                    width="202.35"
                                    height="209.94">
                            </div>

                            <div class="info-container">
                                <div class="provider-info">
                                    <div class="provider-name"><?= htmlspecialchars($worker['name']) ?></div>
                                    <div class="provider-specialty">
                                        Area of expertise: <?= htmlspecialchars($worker['area_of_specialization']) ?>
                                    </div>
                                </div>

                                <div class="availability">
                                    <div class="availability_stats">
                                        <span>Status:</span>
                                        <div class="color-indicator <?= $worker['is_available'] == 1 ? 'active' : '' ?>"></div>
                                        <span style="opacity:0.8;"><?= $worker['is_available'] == 1 ? 'Online' : 'Offline' ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

       <!--==============================
Blog Area  
==============================-->
    <section class="overflow-hidden" id="blog-sec">
        <div
          class="shape-mockup blog-bg-shape2-1 jump-reverse d-xl-block d-none"
          data-top="20%"
          data-right="0"
        >
          <img src="assets/img/about/testimonial-heart.png" alt="img"  />
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
    // require 'api/Database/DatabaseConn.php'; 

   
    $dbh = $db->connect();
    
    $query = "SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at ASC";
    $stmt = $dbh->prepare($query);
    $stmt->execute();

    while ($blog = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $image = !empty($blog['image']) ? "uploads/" . htmlspecialchars($blog['image']) : "assets/img/default-image.jpg";
      $blogid = htmlspecialchars($blog['blog_id']);
      $date = new DateTime($blog['published_at']);
  ?>
    <div class="swiper-slide">
      <div class="blog-card">
        <div class="blog-img">
          <a href="blog-details.php?id=<?= $blogid ?>">
            <div class="blog-img-shape1" data-mask-src="assets/img/blog/blog-card-bg-shape1-2.png"></div>
            <img src="<?= $image ?>" alt="blog image" />
          </a>
        </div>
        <div class="blog-content">
          <div class="blog-card-shape" data-mask-src="assets/img/blog/blog-card-bg-shape1-1.png"></div>
          <div class="blog-meta">
          <a href="blog.html"><i class="fas fa-calendar"></i><?= $date->format('F Y') ?></a>
            <a href="blog.html"><i class="fas fa-tags"></i><?= htmlspecialchars($blog['category']) ?></a>
          </div>
          <h3 class="box-title">
            <a href="blog-details.php?id=<?= $blogid ?>"><?= htmlspecialchars($blog['blog_title']) ?></a>
          </h3>
          <a href="blog-details.php?id=<?= $blogid ?>" class="th-btn">
            Read More <i class="fas fa-arrow-up-right ms-2"></i>
          </a>
        </div>
      </div>
    </div>
  <?php } ?>
</div>


            </div>
            <button
              data-slider-prev="#blogSlider2"
              class="slider-arrow slider-prev"
            >
              <i class="far fa-arrow-left"></i>
            </button>
            <button
              data-slider-next="#blogSlider2"
              class="slider-arrow slider-next"
            >
              <i class="far fa-arrow-right"></i>
            </button>
          </div>
        </div>
      </section>

       <!--==============================
    Form Area  
    ==============================-->

        <section class="space-bottom mb-5 mt-5 ">
            <div class="container">
                    <div class="col-xl-6  mx-auto">
                        <h2 class="title mt-n2 mb-25 text-center"> Get Medical Support</h2>
                        <div class="add-team-form">
                            <form method="POST" id="postForm" class="contact-form ajax-contact">
                                <div class="row">
                                    <div class="form-group style-border col-12">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                                    </div>
                                    <div class="form-group style-border col-12">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                                    </div>
                                    <div class="form-group style-border col-12">
                                        <input type="number" class="form-control" name="number" id="number" placeholder="Phone Number">
                                    </div>
                                    <div class="form-group style-border col-12">
                                        <textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Type Your Message"></textarea>
                                    </div>
                                    <div class="form-btn col-12">
                                        <button class="th-btn style3" id="Publish">Send Request</button>
                                    </div>
                                </div>
                                <!-- <p class="form-messages mb-0 mt-3"></p> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <script>
           document.getElementById("Publish").addEventListener("click", function() {
    const form = document.getElementById("postForm");

    form.onsubmit = (e) => {
    e.preventDefault();
};
    let formData = new FormData(form);
    let isValid = true;


for (let [key, value] of formData.entries()) {
    if (typeof value === "string") {
        let trimmedValue = value.trim(); 
        formData.set(key, trimmedValue); 

        if (trimmedValue === "") {
            isValid = false;
            
            const BadToast = document.getElementById('bad-toast');
                    const BadToastMesaage = document.getElementById('bad-toast-message');
                    BadToast.classList.add('show');
                    BadToastMesaage.textContent = `${key} cannot be empty or only spaces.`;
                    setTimeout(hideBadToast, 5000);

                    function hideBadToast() {
                    const BadToast = document.getElementById('bad-toast');
                    BadToast.classList.remove('show');
                    }
            return; 
        }
    }
}

if (!isValid) return; 

    fetch("api/v1/medical_report.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success === true){
        const toast = document.getElementById('toast-success');
                    const toastMesaage = document.getElementById('toast-message');
                    toast.classList.add('show');
                    toastMesaage.textContent = data.message;
                    setTimeout(hideToast, 5000);
                    form.reset();

                function hideToast() {
                const toast = document.getElementById('toast-success');
                toast.classList.remove('show');
        }
    }
    else{
        const BadToast = document.getElementById('bad-toast');
                    const BadToastMesaage = document.getElementById('bad-toast-message');
                    BadToast.classList.add('show');
                    BadToastMesaage.textContent = data.message || `Error ${xhr.status}: ${xhr.statusText}`;;
                    setTimeout(hideBadToast, 5000);

                    function hideBadToast() {
                    const BadToast = document.getElementById('bad-toast');
                    BadToast.classList.remove('show');
                    }
    }
    })
   
    .catch(error => {
        console.error("Error:", error);
        // alert("An error occurred.");
    });
});
        </script>

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
</body>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetchHealthWorkers();
    });

    function fetchHealthWorkers() {
        fetch("https://ogerihealth.org/api/v1/health_workers.php")
            .then(response => response.json())
            .then(healthWorkers => {
                const providerContainer = document.querySelector(".mother-container");

                if (!providerContainer) {
                    console.error("Provider container not found!");
                    return;
                }

                // Clear any existing content
                providerContainer.innerHTML = "";

                if (!Array.isArray(healthWorkers) || healthWorkers.length === 0) {
                    providerContainer.innerHTML = `
                        <div style="text-align: center; padding: 40px 20px;">
                            <h3 style="color: #888; font-weight: 600;">No Health Worker at the moment</h3>
                            <p class="cta-blink" style="margin-top: 20px;">
                                <a href="#team" style="color: var(--theme-color2); font-size: 1.2rem; text-decoration: none; font-weight: bold;">
                                    Contact us to become a member <span style="font-size: 1.5rem;">➜</span>
                                </a>
                            </p>
                        </div>
                    `;
                    return;
                }

                // Loop through and display each health worker
                healthWorkers.forEach(worker => {
                    providerContainer.innerHTML += `
                    <div class="main-provider-container col-md-4 mb-3">
                        <div class="img-container">
                            <img src="https://ogerihealth.org/Staff_images/${worker.image}" 
                                alt="${worker.doctor_name}" 
                                class="provider-img" 
                                width="202.35" 
                                height="209.94">
                        </div>
                        
                        <div class="info-container">
                            <div class="provider-info">
                                <div class="provider-name">${worker.doctor_name}</div>
                                <div class="provider-specialty">
                                    Area of expertise: ${worker.area_of_specialization}
                                </div>
                            </div>

                            <div class="availability">
                                <div class="availability_stats">
                                    <span>Status:</span>
                                    <div class="color-indicator ${worker.is_available == 1 ? 'active' : ''}"></div>
                                    <span style="opacity:0.8;">${worker.is_available == 1 ? 'Online' : 'Offline'}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                });
            })
            .catch(error => {
                console.error("Error fetching health workers:", error);
            });
    }
</script>





</html>