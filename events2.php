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
<?php
require 'events-data.php'; // Include the events array
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

  <?php include 'include/header.php'; ?>

  <!--==============================
    Breadcumb
============================== -->
  <div class="breadcumb-wrapper " data-bg-src="assets/img/about/DSC_1335.jpg" data-overlay="theme">
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title">Events Page</h1>
        <ul class="breadcumb-menu">
          <li><a href="index.php">Home</a></li>
          <li>Events</li>
        </ul>
      </div>
    </div>
  </div>

  <style>
    img.global-stylee {
      height: 550px;
      width: 100%;
    }

    img.little-img {
      width: 100%;
      height: 60px;
    }

    @media (max-width: 763px) {
      img.global-stylee {
        height: 300px;
      }
    }
  </style>
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
          $eventsPerPage = 3;
          $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
          $offset = ($page - 1) * $eventsPerPage;

          // Handle search
          $search = isset($_GET['search']) ? trim($_GET['search']) : '';
          $searchSql = '';
          $params = [];

          if (!empty($search)) {
            $searchSql = " AND (title LIKE :search OR description LIKE :search OR location LIKE :search OR date LIKE :search)";
            $params[':search'] = "%$search%";
          }

          // Count total events for pagination
          $countQuery = "SELECT COUNT(*) as total FROM events WHERE 1=1 $searchSql";
          $countStmt = $dbh->prepare($countQuery);
          if (!empty($search)) $countStmt->bindValue(':search', $params[':search'], PDO::PARAM_STR);
          $countStmt->execute();
          $totalEvents = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
          $totalPages = ceil($totalEvents / $eventsPerPage);

          // Fetch events
          $query = "SELECT * FROM events WHERE 1=1 $searchSql ORDER BY date DESC LIMIT :offset, :limit";
          $stmt = $dbh->prepare($query);
          if (!empty($search)) $stmt->bindValue(':search', $params[':search'], PDO::PARAM_STR);
          $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
          $stmt->bindParam(':limit', $eventsPerPage, PDO::PARAM_INT);
          $stmt->execute();
        } catch (Exception $e) {
          echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
          $stmt = null;
        }
        ?>


        <div class="col-xxl-8 col-lg-7">
          <?php if ($stmt && $stmt->rowCount() > 0): ?>
            <?php while ($event = $stmt->fetch(PDO::FETCH_ASSOC)):
              $eventName = htmlspecialchars($event['title']);
              $description = htmlspecialchars($event['description']);
              $date = date("M j, Y", strtotime($event['date']));
              $image = !empty($event['banner_image']) ? "uploads/" . htmlspecialchars($event['banner_image']) : "assets/img/donate/donation2-1.png";
              $eventid = htmlspecialchars($event['event_id']);
            ?>
              <div class="th-blog blog-single has-post-thumbnail">
                <div class="blog-img">
                  <a href="event-details.php?id=<?= $eventid ?>">
                    <img src="<?= $image ?>" class="global-stylee" alt="Event Image">
                  </a>
                </div>
                <div class="blog-content">
                  <div class="blog-meta">
                    <a href="events.php">
                      <i class="fas fa-calendar-days"></i><?= $date ?>
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
            <p style='font-size: 2rem; font-weight: 800;'>No events available.</p>
          <?php endif; ?>


          <!-- Pagination -->
          <?php if ($totalPages > 1): ?>
            <div class="th-pagination">
              <ul>
                <!-- Previous -->
                <li>
                  <a href="events.php?page=<?= max(1, $page - 1) ?>&search=<?= urlencode($search) ?>">
                    <i class="fas fa-arrow-left"></i>
                  </a>
                </li>

                <!-- Page Numbers -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                  <li class="<?= $i == $page ? 'active' : '' ?>">
                    <a href="events.php?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                  </li>
                <?php endfor; ?>

                <!-- Next -->
                <li>
                  <a href="events.php?page=<?= min($totalPages, $page + 1) ?>&search=<?= urlencode($search) ?>">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </li>
              </ul>
            </div>
          <?php endif; ?>
        </div>
        <!-- Sidebar -->
        <div class="col-xxl-4 col-lg-4">
          <aside class="sidebar-area">

            <!-- Search -->
            <div class="widget widget_search">
              <form class="search-form" method="GET" action="events.php">
                <input type="text" name="search" placeholder="Enter Keyword" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
                <button type="submit"><i class="far fa-search"></i></button>
              </form>
            </div>


            <!-- Category -->
            <!-- <div class="widget widget_categories">
                <h3 class="widget_title">Category</h3>
                <ul>
                  <li>
                    <a href="events.php">Donations</a>
                    <span><i class="fas fa-arrow-right"></i></span>
                  </li>
                  <li>
                    <a href="events.php">Educations</a>
                    <span><i class="fas fa-arrow-right"></i></span>
                  </li>
                  <li>
                    <a href="events.php">Fundraising</a>
                    <span><i class="fas fa-arrow-right"></i></span>
                  </li>
                  <li>
                    <a href="events.php">Foods</a>
                    <span><i class="fas fa-arrow-right"></i></span>
                  </li>
                  <li>
                    <a href="events.php">Medical Help</a>
                    <span><i class="fas fa-arrow-right"></i></span>
                  </li>
                  <li>
                    <a href="events.php">Water Support</a>
                    <span><i class="fas fa-arrow-right"></i></span>
                  </li>
                </ul>
              </div> -->

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
                  $query = "SELECT * FROM events ORDER BY date DESC LIMIT 3";
                  $stmt = $dbh->prepare($query);
                  $stmt->execute();

                  if ($stmt->rowCount() > 0) {
                    while ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $eventName = htmlspecialchars($event['title']);
                      $eventDate = date("F, Y", strtotime($event['date']));
                      $image = !empty($event['banner_image']) ? "uploads/" . htmlspecialchars($event['banner_image']) : "assets/img/default-image.jpg";
                      $eventid = htmlspecialchars($event['event_id']);
                ?>
                      <div class="recent-post">
                        <div class="media-img">
                          <a href="event-details.php?id=<?= $eventid ?>">
                            <img src="<?= $image ?>" class="little-img" alt="Blog Image" />
                          </a>
                        </div>
                        <div class="media-body">
                          <div class="recent-post-meta">
                            <a href="events.php">
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



            <!-- Tag Cloud -->
            <!-- <div class="widget widget_tag_cloud">
                <h3 class="widget_title">Popular Tags</h3>
                <div class="tagcloud">
                  <a href="events.php">Donations</a>
                  <a href="events.php">Help</a>
                  <a href="events.php">Foods</a>
                  <a href="events.php">Educations</a>
                  <a href="events.php">Fundraising</a>
                  <a href="events.php">Tips</a>
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