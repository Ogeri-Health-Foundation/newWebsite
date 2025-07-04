<?php
session_start();
require 'api/Database/DatabaseConn.php';

// Create an instance of DatabaseConn and establish connection
$db = new DatabaseConn();
$dbh = $db->connect();
?>

<?php

$page_title = "Ogeri Health Foundation - Blog";

$page_author = "Olayinka!";

$page_description = "";

$page_rel = '';

$page_name = 'Blog';

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


  <script src="https://kit.fontawesome.com/706f90924a.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/blog.css">
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      function sendEngagement() {
        fetch("http://localhost/ohfWebsite/api/v2/update_engagement.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "engagement=1",
          })
          .then(response => response.json())
          .then(data => console.log(data.message))
          .catch(error => console.error("Error:", error));
      }
      // setInterval(() => {
      sendEngagement();

      // }, 5000); 
    });
  </script>
</head>

<body>

  <style>
    img.global-stylee {
      height: 550px;
      width: 100%;
    }

    img.little-img {
      width: 100%;
      height: 60px;
    }

    .active-category {
      font-weight: bold;
      background-color: #ff6e3b !important;
      color: white !important;
    }

    @media (max-width: 763px) {
      img.global-stylee {
        height: 300px;
      }
    }
  </style>


  <!--********************************
   		Code Start From Here 
	******************************** -->

  <?php include 'include/header.php'; ?>

  <!--==============================
    Breadcumb
============================== -->


  <!-- header section starts -->
  <section class="header">
    <img src="./assets/img/bg/Frame 2147226443.png" class="header-img img-fluid img-responsive" alt="header-img">

    <div class="header-details" class="text-danger">
      <a href="./" class="text-white text-decoration-none ">Home &gt;</a>
      <span>Blog</span>

      <h1 class="ohf_font text-white">Our Blog Page</h1>
    </div>
  </section>
  <!-- header section ends -->

  <!-- blog container title starts -->

  <section class="blog-container container">
    <!-- container title starts -->
    <div class="container-title text-center my-5">
      <h3 class="ohf_font text-orange">OUR BLOG POST</h3>

      <p>Discover valuable health tips, news and stories from our outreach efforts</p>
    </div>
    <!-- container title ends -->

    <div class="row">
      <div class="col-12 col-sm-12 col-md-8 col-lg-8">
        <div class="blog-recent d-flex justify-content-between align-content-center mb-3">
          <div class="recent-title">
            <h3 class="ohf_font text-orange">Recent Articles</h3>
          </div>

          <div class="recent-arrow-nav d-flex">
            <!-- Right Arrow Button -->
            <button type="button"
              class="btn p-0 d-flex align-items-center justify-content-center me-2 rounded-circle btn-1">
              <i class="fa-solid fa-arrow-left fs-6"></i>
            </button>

            <!-- Left Arrow Button -->
            <button type="button"
              class="btn p-0 d-flex align-items-center justify-content-center rounded-circle btn-2">
              <i class="fa-solid fa-arrow-right fs-6"></i>
            </button>
          </div>
        </div>

        <!-- BLOG LIST starts -->
        <div class="row row-cols-1 row-cols-md-3 g-3 mb-5">
          <?php
          try {
            if (!isset($dbh)) {
              throw new Exception("Database connection not found.");
            }

            // Pagination settings
            $eventsPerPage = 3; // Adjust the number of events per page
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $eventsPerPage;

            // Get total number of events
            // Capture filters
            $search = isset($_GET['search']) ? trim($_GET['search']) : '';
            $selectedCategory = isset($_GET['category']) ? trim($_GET['category']) : '';

            // Count query
            $countQuery = "SELECT COUNT(*) as total FROM blog_posts WHERE status = 'published'";
            $conditions = [];
            $params = [];

            if ($search !== '') {
              $conditions[] = "(blog_title LIKE :search OR blog_description LIKE :search)";
              $params[':search'] = '%' . $search . '%';
            }
            if ($selectedCategory !== '') {
              $conditions[] = "category = :category";
              $params[':category'] = $selectedCategory;
            }

            if (!empty($conditions)) {
              $countQuery .= " AND " . implode(" AND ", $conditions);
            }
            $countStmt = $dbh->prepare($countQuery);
            $countStmt->execute($params);
            $totalEvents = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
            $totalPages = ceil($totalEvents / $eventsPerPage);

            // Data query
            $query = "SELECT * FROM blog_posts WHERE status = 'published'";
            if (!empty($conditions)) {
              $query .= " AND " . implode(" AND ", $conditions);
            }
            $query .= " ORDER BY published_at DESC LIMIT :limit OFFSET :offset";
            $stmt = $dbh->prepare($query);
            foreach ($params as $key => $value) {
              $stmt->bindValue($key, $value);
            }
            $stmt->bindValue(':limit', $eventsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
          } catch (Exception $e) {
            echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
            $stmt = null;
          }
          ?>

          <?php if ($stmt && $stmt->rowCount() > 0): ?>
            <?php while ($blog = $stmt->fetch(PDO::FETCH_ASSOC)):
              $blogName = htmlspecialchars($blog['blog_title']);
              $description = htmlspecialchars($blog['blog_description']);
              $category = htmlspecialchars($blog['category']);
              $status = htmlspecialchars($blog['status']);
              $date = date("M j, Y", strtotime($blog['published_at']));
              $image = !empty($blog['image']) ? "uploads/" . htmlspecialchars($blog['image']) : "assets/img/donate/donation2-1.png";
              $blogid = htmlspecialchars($blog['blog_id']);
            ?>
              <div class="col-12 col-md-6">
                <div class="card h-100 pb-3">
                  <div class="img-section position-relative">
                    <img src="<?= $image ?>" class="card-img-top" alt="Blog Image"
                      style="border-bottom: 4px solid sandybrown;height:225px">

                    <div class="remarks">
                      <div class="author">Admin</div>
                      <div class="date ms-2"><?= $date ?></div>
                      <div class="comments ms-2">Comments 22</div>
                    </div>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title text-center ohf_font mt-3"><?= $blogNamev ?></h5>
                    <p class="card-text text-center">
                      <?= $description ?>
                    </p>
                  </div>

                  <a href="blog-details.php?id=<?= $blogid ?>" class="btn bg-green w-50 mx-auto btn-green mt-4">Read More

                    <i class="fa-solid fa-arrow-right fs-12 ms-1"></i>
                  </a>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <p style='font-size: 2rem; font-weight: 800;'>No blogs available.</p>
          <?php endif; ?>

        </div>
        <!-- BLOG LIST ends -->

        <!-- BLOG PAGINATION STARTS -->
        <?php if ($totalPages > 1): ?>

          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-start gap-2">
              <li class="page-item disabled">
                <a class="page-link" href="blog.php?page=<?= max(1, $page - 1) ?>" aria-label="Previous">
                  <i class="fa-solid fa-angle-left"></i>
                </a>
              </li>

              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item"><a class="page-link <?= $i == $page ? 'pag-active' : '' ?>" href="blog.php?page=<?= $i ?>"><?= $i ?></a></li>
              <?php endfor; ?>

              <li class="page-item">
                <a class="page-link" href="blog.php?page=<?= min($totalPages, $page + 1) ?>" aria-label="Next">
                  <i class="fa-solid fa-angle-right"></i>
                </a>
              </li>
            </ul>
          </nav>
        <?php endif; ?>

        <!-- BLOG PAGINATION ENDS -->
      </div>


      <div class="col-12 col-sm-12 col-md-4 col-lg-4">


        <div class="blog-search" style=" margin-top: 62px;">
          <form action="blog.php" method="GET" class="searchForm">
            <input type="search" name="search" id="search" placeholder="Enter Keyword..."
              class="searchInput" value="<?= htmlspecialchars($search) ?>">
            <button type="submit" id="blog-search-btn" class="btn" name="submit">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>
        </div>

        <div class="blog-search blog-categories mt-4">
          <h4 class="ohf_font text-orange">Categories</h4>
          <?php
          $categories = [
            'Community Health Stories',
            'Hypertension & Heart Health',
            'Health Education & Lifestyle',
            'Digital Health & Innovation',
            'Outreach Highlights',
            'Research & Insights',
            'Volunteer & Partner Spotlights',
            'Events & Announcements',
            'Health Centre Strengthening',
            'Funding & Support'
          ];
          ?>

          <div class="category-lists">

            <?php foreach ($categories as $cat): ?>

              <a href="blog.php?category=<?= urlencode($cat) ?>" class=" d-flex justify-content-between cat-link btn my-3 <?= ($selectedCategory === $cat) ? 'active-cat' : '' ?>">
                <div class="cat-title"><?= $cat ?></div>
                <div class="cat-icon">
                  <i class="fa-solid fa-arrow-right"></i>
                </div>
              </a>
            <?php endforeach; ?>

          </div>
        </div>

        <div class="blog-search mt-4">
          <h4 class="ohf_font text-orange">Recent Posts</h4>

          <?php
          try {
            if (!isset($dbh)) {
              throw new Exception("Database connection not found.");
            }

            // Fetch the three most recent events
            $query = "SELECT * FROM blog_posts WHERE status = 'published' ORDER BY published_at DESC LIMIT 3";
            $stmt = $dbh->prepare($query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
              while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $eventName = htmlspecialchars($event['blog_title']);
                $eventDate = date("F, Y", strtotime($event['published_at']));
                $image = !empty($event['image']) ? "uploads/" . htmlspecialchars($event['image']) : "assets/img/default-image.jpg";
                $eventid = htmlspecialchars($event['blog_id']);
          ?>

                <div class="related-container-list my-3">
                  <a href="blog-details.php?id=<?= $eventid ?>">
                    <div class="related-img">
                      <img src="<?= $image ?>" alt="" class="img-fluid">
                    </div>
                  </a>

                  <div class="related-content">
                    <div class="related-date">
                      <i class="fa-solid fa-calendar-days text-orange"></i> &nbsp;
                      <span class="date-text"><?= $eventDate ?></span>
                    </div>
                    <a href="blog-details.php?id=<?= $eventid ?>" class="text-decoration-none">
                      <h6 class="related-title text-dark text_hover"><?= $eventName ?></h6>
                    </a>
                  </div>
                </div>

          <?php
              }
            } else {
              echo "<p style='font-size: 1.2rem; font-weight: 600;'>No recent posts available.</p>";
            }
          } catch (Exception $e) {
            echo "<p>Error fetching recent posts: " . $e->getMessage() . "</p>";
          }
          ?>


        </div>

        <div class="blog-search mt-4">
          <h4 class="ohf_font text-orange">Popular Tags</h4>

          <div class="tags mt-3">
            <a href="" class="tag btn text-muted">Donations</a>
            <a href="" class="tag btn text-muted">Food</a>
            <a href="" class="tag btn text-muted">Help</a>
            <a href="" class="tag btn text-muted">Education</a>
            <a href="" class="tag btn text-muted">Fundraising</a>
            <a href="" class="tag btn text-muted">Tips</a>
          </div>



        </div>



      </div>
    </div>

  </section>
  <!-- blog container title starts -->




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