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

   

    <script>
      document.addEventListener("DOMContentLoaded", function () {
      function sendEngagement() {
  fetch("http://localhost/ohfWebsite/api/v2/update_engagement.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
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
  img.global-stylee{
    height: 550px;
    width: 100%;
  }
  img.little-img{
    width: 100%;
    height: 60px;
  }
  .active-category {
  font-weight: bold;
  background-color: #ff6e3b !important;
  color: white !important;
}
  @media (max-width: 763px){
    img.global-stylee{
    height: 300px;
  }
  }
</style>
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

  <?php include 'include/header.php'; ?>

    <!--==============================
    Breadcumb
============================== -->
<div class="breadcumb-wrapper " data-bg-src="assets/img/about/DSC_1337.jpg" data-overlay="theme">
  <div class="container">
      <div class="breadcumb-content">
          <h1 class="breadcumb-title">Blog Page</h1>
          <ul class="breadcumb-menu">
              <li><a href="index.php">Home</a></li>
              <li>Blog</li>
          </ul>
      </div>
  </div>
</div>
    <!--==============================
Blog Area
==============================-->
    <section class="th-blog-wrapper space-top space-extra-bottom">
      <div class="container">
        <div class="row gx-40">
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

          <div class="col-xxl-8 col-lg-7">
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
            <div class="th-blog blog-single has-post-thumbnail">
              <div class="blog-img">
                <a href="blog-details.php?id=<?= $blogid ?>"
                  ><img src="<?= $image ?>" class="global-stylee" alt="Blog Image"
                />
                
              </a>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <a href="blog.php"
                    ><i class="fas fa-calendar-days"></i><?= $date ?></a
                  >
                  <a href="blog.php"><i class="fas fa-tags"></i><?= $category ?></a>
                 
                </div>
                <h2 class="blog-title">
                  <a href="blog-details.php"
                    ><?= $blogName ?>
                    </a
                  >
                </h2>
                <p class="blog-text">
                <?= $description ?>
                </p>
                <a href="blog-details.php?id=<?= $blogid ?>" class="th-btn btn-sm"
                  >Read More <i class="fas fa-arrow-up-right ms-2"></i
                ></a>
              </div>
            </div>
            <?php endwhile; ?>
                <?php else: ?>
                    <p style='font-size: 2rem; font-weight: 800;'>No blogs available.</p>
                <?php endif; ?>

           <!-- Pagination -->
           <?php if ($totalPages > 1): ?>
                <div class="th-pagination">
                    <ul>
                        <!-- Previous Page -->
                        <li>
                            <a href="blog.php?page=<?= max(1, $page - 1) ?>">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="<?= $i == $page ? 'active' : '' ?>">
                                <a href="blog.php?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next Page -->
                        <li>
                            <a href="blog.php?page=<?= min($totalPages, $page + 1) ?>">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
            </div>
          <div class="col-xxl-4 col-lg-5">
            <aside class="sidebar-area">
              <div class="widget widget_search">
                <form class="search-form" action="blog.php" method="GET">
                  <input type="text" name="search" placeholder="Enter Keyword" value="<?= htmlspecialchars($search) ?>" />
                  <button type="submit"><i class="far fa-search"></i></button>
                </form>
              </div>
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

                <div class="widget widget_categories">
                  <h3 class="widget_title">Categories</h3>
                  <ul>
                    <!-- Reset / All option -->
                    <li>
                      <a href="blog.php" class="<?= ($selectedCategory === '') ? 'active-category' : '' ?>">
                        All Categories
                      </a>
                      <span><i class="fas fa-arrow-right"></i></span>
                    </li>

                    <!-- Real categories -->
                    <?php foreach ($categories as $cat): ?>
                      <li>
                        <a href="blog.php?category=<?= urlencode($cat) ?>"
                          class="<?= ($selectedCategory === $cat) ? 'active-category' : '' ?>">
                          <?= $cat ?>
                        </a>
                        <span><i class="fas fa-arrow-right"></i></span>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
               <!-- //Recent Posts -->
               <div class="widget">
                  <h3 class="widget_title">Recent Posts</h3>

                  <div class="recent-post-wrap">
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
                                  <div class="recent-post">
                                      <div class="media-img">
                                          <a href="blog-details.php?id=<?= $eventid ?>">
                                              <img src="<?= $image ?>" class="little-img" alt="Blog Image" />
                                          </a>
                                      </div>
                                      <div class="media-body">
                                          <div class="recent-post-meta">
                                              <a href="blog.php">
                                                  <i class="fas fa-calendar-days"></i> <?= $eventDate ?>
                                              </a>
                                          </div>
                                          <h4 class="post-title">
                                              <a class="text-inherit" href="event-details.php?id=<?= $eventid ?>">
                                                  <?= $eventName ?>
                                              </a>
                                          </h4>
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
              </div>
              <!-- <div class="widget widget_tag_cloud">
                <h3 class="widget_title">Popular Tags</h3>
                <div class="tagcloud">
                  <a href="blog.php">Donations</a>
                  <a href="blog.php">Help</a>
                  <a href="blog.php">Foods</a>
                  <a href="blog.php">Educations</a>
                  <a href="blog.php">Fundraising</a>
                  <a href="blog.php">Tips</a>
                </div>
              </div> -->
            </aside>
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
      <svg
        class="progress-circle svg-content"
        width="100%"
        height="100%"
        viewBox="-1 -1 102 102"
      >
        <path
          d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
          style="
            transition: stroke-dashoffset 10ms linear 0s;
            stroke-dasharray: 307.919, 307.919;
            stroke-dashoffset: 307.919;
          "
        ></path>
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
