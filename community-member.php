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

    $page_title = "Ogeri Health Foundation - Community Members";

    $page_author = "Okibe!";

    $page_description = "";

    $page_rel = '';

    $page_name = 'comunity-member.php';

    $customs = array(
                "stylesheets" => ["assets/css/index.css", "assets/css/community-2.css"],
                "scripts" => ["assets/js/main2.js"]
               );

    $addons = array(
                "stylesheets" => ["https://some-external-url.css"],
                "scripts" => ["https://some-external-url.js"]
               );

?>

<style>
   a{
    text-decoration: none !important; 
    color: inherit;
  }
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
    <!-- <link rel="stylesheet" href="./assets/css/bootstrap.min.css" /> -->
    
    <!-- <link rel="stylesheet" href="./assets/css/community-2.css" /> -->
   

</head>


  <body>
    <!-- HERO SECTION -->
     <?php include 'include/header.php'; ?>
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
    </div></div>
    <section
      class="hero-section container-fluid d-flex justify-content-center flex-column align-items-center mb-4"
    >
      <p class="hero-0">Community Members</p>
      <h2 class="hero-1">Together for Health, Together for Hope</h2>
      <a href="#get-help" class="hero-btn" >Get Medical Support</a>
    </section>
    <!-- PROVIDER SECTION -->
    <section class="providers-section container">
      <div
        class="provider-intro-sect d-md-flex justify-content-md-between align-items-md-center container py-5"
      >
        <div class="provider-text-container container">
          <p class="provider-text">Health Providers</p>
          <h3 class="provider-text-header">Meet Our Healthcare Providers</h3>
        </div>
        <div class="provider-intro">
          <p>
            From your first visit to your ongoing care, our healthcare providers
            are here to listen, support, and guide you. Discover the faces and
            stories of the people who are committed to making your health their
            priority.
          </p>
        </div>
      </div>
      <!-- provider-cards-container container d-flex flex-column justify-content-around align-content-center flex-lg-row  -->
      <div class="container py-4 row gap-4 justify-content-center">
        <?php
        //   require 'api/Database/DatabaseConn.php';

        //   $db = new DatabaseConn();
        //   $dbh = $db->connect();

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
            <div class="col-12 col-sm-6 col-lg-3 d-flex justify-content-center" style="width: 100%; max-width: 350px; min-width: 200px;">
              <div class="provider-card shadow-sm d-flex flex-column" style="width: 100%;">
                <div class="provider-img-wrapper position-relative">
                  <img
                    src="<?= !empty($worker['image']) ? 'Staff_images/' . htmlspecialchars($worker['image']) : 'assets/img/default-image.jpg' ?>"
                    alt="<?= htmlspecialchars($worker['name']) ?>"
                    class="provider-img"
                  />
                  <span class="provider-hours">
                    <div class="color-indicator <?= $worker['is_available'] == 1 ? 'active' : '' ?>"></div>
                    <span><?= $worker['is_available'] == 1 ? 'Online' : 'Offline' ?></span>
                  </span>
                </div>

                <div class="p-3 d-flex flex-column flex-grow-1">
                  <p class="provider-name"><?= htmlspecialchars($worker['name']) ?></p>
                  <p class="provider-title text-muted small mb-1"><?= htmlspecialchars($worker['area_of_specialization']) ?></p>
                  <!-- <p class="provider-details text-muted flex-grow-1">
                    Far far away, behind the word mountains, far from the countries Voka
                  </p> -->

                  <!-- <button class="provider-contact btn btn-outline-primary w-100 mt-3 d-flex justify-content-between align-items-center">
                    Get In Touch
                    <img src="./assets/img/community/icons/diagonal-arrow.svg" alt="" width="16" />
                  </button> -->
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>


        
      </div>
    </section>
    <!-- NEWS ARTCLE SECTION -->
     <section class="news-art-section pt-2" style="background-color: #F8F4F4;">
        <div class="container">
            <div class="news-art-header-container d-flex flex-column flex-md-row justify-content-between px-4">
            <div class="news-art-text">
                <h2 class="">News article</h2>
                <p class="news-art-subhead d-block mt-4">Our Latest News & Articles</p>
            </div>
            <div class="news-art-nav mb-3 d-flex align-items-center gap-3">
                <button class="arrow-btn left-arrow">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="arrow-btn right-arrow">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            </div>

            <div class="news-art-card-wrapper">
                <div class="news-art-card-track">
                    <?php
                    
                    $query = "SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at ASC";
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();

                    while ($blog = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $image = !empty($blog['image']) ? "uploads/" . htmlspecialchars($blog['image']) : "assets/img/default-image.jpg";
                        $blogid = htmlspecialchars($blog['blog_id']);
                        $date = new DateTime($blog['published_at']);
                    ?>
                    <div class="news-art-card">
                    <img src="<?= $image ?>" alt="article" class="news-art-img" />
                    <div class="article-details" style="background-color: var(--theme-color2);">
                        <span class="art-author">Admin</span>
                        <span class="art-date"><?= $date->format('F Y') ?></span>
                        <span class="art-comments-count"><?= ucwords(str_replace('_', ' ', htmlspecialchars($blog['category']))) ?></span>
                    </div>
                    <h5 class="art-title px-2"><?= htmlspecialchars($blog['blog_title']) ?></h5>
                    <p class="art-summary"><?= htmlspecialchars($blog['blog_description']) ?></p>
                    <a class="th-btn mt-4 text-decoration-none" href="blog-details.php?id=<?= $blogid ?>">
                        Read More <img src="./assets/img/community/icons/right-arrow.svg" alt="arrow" class="ms-2" />
                    </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- SUPPORT SECTION -->
    <section class="container support-section pt-3 pb-4" id="get-help">
      <h2 class="support-title text-center">Get Medical Support</h2>
      <div class="container form-container mt-3">
        <form  class=" container-sm form" method="POST" id="postForm">
          <input type="text" name="name" id="name" placeholder="Name" class="mb-3" />
          <br />
          <input type="email" name="email" id="email" placeholder="Email" class="mb-3" /> <br />
          <input type="tel" name="number" id="number" placeholder="Phone Number" class="mb-3" /> <br />
          <textarea
            name="message"
            id="message"
            placeholder="Type your message here"
            
          ></textarea>
          <br />
          <button type="button" id="Publish" class="th-btn style3 w-50 mx-auto d-block my-2">
           
            Submit
            </button>
           
        </form>
      </div>
    </section>
    <?php include 'include/footer.php'; ?>
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
        <script>
document.addEventListener("DOMContentLoaded", () => {
  const track = document.querySelector(".news-art-card-track");
  const leftArrow = document.querySelector(".left-arrow");
  const rightArrow = document.querySelector(".right-arrow");
  const scrollAmount = 320;

  const updateArrows = () => {
    const scrollLeft = track.scrollLeft;
    const maxScrollLeft = track.scrollWidth - track.clientWidth;

    // Toggle visibility of arrows based on scroll position
    leftArrow.classList.toggle("hidden", scrollLeft <= 10);
    rightArrow.classList.toggle("hidden", scrollLeft >= maxScrollLeft - 10);
  };

  // Scroll on arrow click
  rightArrow.addEventListener("click", () => {
    track.scrollBy({ left: scrollAmount, behavior: "smooth" });
  });

  leftArrow.addEventListener("click", () => {
    track.scrollBy({ left: -scrollAmount, behavior: "smooth" });
  });

  // Update arrow visibility after scroll
  track.addEventListener("scroll", updateArrows);

  // Observe first and last cards to hide arrows at limits
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        if (entry.target.classList.contains("first-card")) {
          leftArrow.classList.add("hidden");
        } else if (entry.target.classList.contains("last-card")) {
          rightArrow.classList.add("hidden");
        }
      }
    });
  }, { root: track, threshold: 1 });

  // Observe edges
  const cards = track.querySelectorAll(".news-art-card");
  if (cards.length > 0) {
    cards[0].classList.add("first-card");
    cards[cards.length - 1].classList.add("last-card");
    observer.observe(cards[0]);
    observer.observe(cards[cards.length - 1]);
  }

  // Initial call
  updateArrows();
});
</script>
        <script src="assets/js/vendor/jquery-3.7.1.min.js"></script>
       
        <script src="assets/js/swiper-bundle.min.js"></script>
        
        <script src="assets/js/bootstrap.min.js"></script>
        
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
       
        <script src="assets/js/jquery.counterup.min.js"></script>
        
        <script src="assets/js/jquery-ui.min.js"></script>
      
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
  </body>
</html>
