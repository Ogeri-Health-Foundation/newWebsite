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

$page_title = "Ogeri Health Foundation - Blog";

$page_author = "Olayinka!";

$page_description = "";

$page_rel = '';

$page_name = 'Blog';

$customs = array(
  "stylesheets" => ["assets/css/blog.css"],
  "scripts" => ["assets/js/main2.js"]
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

  <!-- <script src="https://kit.fontawesome.com/706f90924a.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css"> -->
 
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

  <style>
     a{
    text-decoration: none !important; 
    color: inherit;
  }
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


  <!-- header section starts -->
  <!-- <section class="headers">
    <img src="./assets/img/bg/Frame 2147226443.png" class="header-img img-fluid img-responsive" alt="header-img">

    <div class="header-details" class="text-danger">
      <a href="./" class="text-white text-decoration-none ">Home &gt;</a>
      <span>Event</span>

      <h1 class="ohf_font text-white">Our Event Page</h1>
    </div>
  </section> -->
  <div class="breadcumb-wrapper event-hero headers">
    <div class="container">
        <div class="breadcumb-content">
            <ul class="breadcumb-menu">
                <li><a href="index.php">Home</a></li>
                <li>Events</li>
            </ul>
            <h1 class="breadcumb-title">Events</h1>
            
        </div>
    </div>
  </div>
  <!-- header section ends -->

  <!-- blog container title starts -->

  <section class="blog-container container mt-5" >
    <!-- container title starts -->
    <div class="container-title text-center ">
      <h3 class="ohf_font text-orange">DISCOVER OUR IMPACT; PAST EVENTS & PRESENT OUTREACH</h3>

      <p>These events have not only improved health outcomes but also fostered a sense of community and social
        responsibility.
        We're proud of our achievements and look forward to continuing our work in healthcare outreach and
        advocacy.</p>
    </div>
    <!-- container title ends -->

    <!-- blog container title starts -->


    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="blog-recent d-flex justify-content-start align-content-center mb-3">
          <div class="recent-title">
            <h3 class="ohf_font text-orange">Upcoming Events</h3>
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
          <?php if ($stmt && $stmt->rowCount() > 0): ?>
            <?php while ($event = $stmt->fetch(PDO::FETCH_ASSOC)):
              $eventName = htmlspecialchars($event['title']);
              $location = htmlspecialchars($event['location']);
              $description = htmlspecialchars($event['description']);
              $date = date("M j, Y", strtotime($event['date']));
              $time = DateTime::createFromFormat("H:i:s.u", $event['time']);
              $image = !empty($event['banner_image']) ? "uploads/" . htmlspecialchars($event['banner_image']) : "assets/img/donate/donation2-1.png";
              $eventid = htmlspecialchars($event['event_id']);
            ?>
              <div class="col-12 col-md-4">
                <div class="card h-100 text-white position-relative overflow-hidden">
                  <img src="<?= $image ?>" class="card-img" alt="..."
                    style="height:320px; object-fit: cover;">

                  <h6 class="text-white position-absolute" style="top: 20px;left: 20px; z-index: 2;">Upcoming
                    Event</h6>

                  <!-- Dark overlay -->
                  <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>

                  <!-- Content -->
                  <div class="card-img-overlay d-flex flex-column justify-content-end" style="z-index: 2;">
                    <h5 class="card-title">
                      <a href="event-details.php?id=<?= $eventid ?>" class="text-decoration-none event-hover"><?= $eventName ?></a>
                    </h5>
                    <p class="card-text event-descrip text-white">
                      <?php echo strlen($description) > 160 ? substr($description, 0, 140) . "..." : $description; ?>
                    </p>
                    <p class="card-text event-descrip text-white">
                      <small>St John’s catholic church lekki lagos, nigeria.</small>
                      <br>
                      <small><?= $date ?> | <?= $time->format("g:i A"); ?> Prompt </small>
                    </p>
                  </div>
                </div>
              </div>

            <?php endwhile; ?>
          <?php else: ?>
            <p style='font-size: 1.2rem; font-weight: 600;'>No event available at the moment.</p>
          <?php endif; ?>

        </div>
        <!-- BLOG LIST ends -->
      </div>
    </div>

    <!-- BLOG PAGINATION STARTS -->
    <?php if ($totalPages > 1): ?>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start gap-2">
          <li class="page-item">
            <a class="page-link" href="events.php?page=<?= max(1, $page - 1) ?>>&search=<?= urlencode($search) ?>" aria-label="Previous">
              <i class="fa-solid fa-angle-left"></i>
            </a>
          </li>

          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item"><a class="page-link <?= $i == $page ? 'pag-active' : '' ?>" href="events.php?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a></li>
          <?php endfor; ?>

          <li class="page-item">
            <a class="page-link" href="events.php?page=<?= min($totalPages, $page + 1) ?>&search=<?= urlencode($search) ?>" aria-label="Next">
              <i class="fa-solid fa-angle-right"></i>
            </a>
          </li>
        </ul>
      </nav>
    <?php endif; ?>



    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="blog-recent d-flex justify-content-start align-content-center mb-3">
          <div class="recent-title">
            <h3 class="ohf_font text-orange">Recent Events</h3>
          </div>
        </div>

        <!-- BLOG LIST starts -->
        <div class="row row-cols-1 row-cols-md-3 g-3 mb-5">
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
                $description = htmlspecialchars($event['description']);
                $eventDate = date("M j, Y", strtotime($event['date']));
                $time = DateTime::createFromFormat("H:i:s.u", $event['time']);
                $image = !empty($event['banner_image']) ? "uploads/" . htmlspecialchars($event['banner_image']) : "assets/img/default-image.jpg";
                $eventid = htmlspecialchars($event['event_id']);
          ?>
                <div class="col-12 col-md-4">
                  <div class="card h-100 text-white position-relative overflow-hidden">
                    <img src="<?= $image ?>" class="card-img" alt="..."
                      style="height:320px; object-fit: cover;">

                    <h6 class="text-white position-absolute" style="top: 20px;left: 20px; z-index: 2;">Recent
                      Event</h6>

                    <!-- Dark overlay -->
                    <div class="position-absolute top-0 start-0 w-100 h-100"
                      style="background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>

                    <!-- Content -->
                    <div class="card-img-overlay d-flex flex-column justify-content-end" style="z-index: 2;">
                      <h5 class="card-title">
                        <a href="event-details.php?id=<?= $eventid ?>" class="text-decoration-none event-hover"><?= $eventName ?></a>
                      </h5>
                      <p class="card-text event-descrip text-white">
                        <?php echo strlen($description) > 160 ? substr($description, 0, 140) . "..." : $description; ?>
                      </p>
                      <p class="card-text event-descrip text-white">
                        <small>St John’s catholic church lekki lagos, nigeria.</small>
                        <br>
                        <small><?= $eventDate ?> | <?= $time->format("g:i A"); ?></small>
                      </p>
                    </div>
                  </div>
                </div>
          <?php
              }
            } else {
              echo "<p style='font-size: 1.2rem; font-weight: 600;'>No recent event available.</p>";
            }
          } catch (Exception $e) {
            echo "<p>Error fetching recent posts: " . $e->getMessage() . "</p>";
          }
          ?>

        </div>
        <!-- BLOG LIST ends -->
      </div>
    </div>

  </section>
  <!-- blog container title starts -->

  <section class="donate-headers position-relative text-white mb-5 text-center px-4" style="padding: 100px 0px; background-image: url('./assets/img/bg/Frame_2147226443.png'); background-size: cover; background-position: center;">

    <!-- Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.6); z-index: 1;">
    </div>

    <!-- Content -->
    <div class="text-center "
      style="z-index: 2; position: relative;">
      <p class="fs-6 fw-semibold mb-3 text-white">Ogeri Health Foundation</p>
      <h3 class="mb-4  ohf_font text-white text-center" >
        It’s not the size of your intention that matters most, but the small, genuine acts of kindness you’re
        willing to do — those are what truly leave a mark.
      </h3>

      <div class="donate_volunteer d-flex gap-3 flex-column flex-sm-row justify-content-center mt-5">
        <a href="./donation.php" class="th-btn bg-white text-dark" style="max-width: 100px;">Donate Now</a>
        <a href="./volunteer.php" class="th-btn style3" style="max-width: 240px;">Become a Volunteer</a>
      </div>
    </div>
  </section>

  <section class="blog-container container">
    <!-- container title starts -->
    <div class="container-title text-center my-5">
      <h3 class="ohf_font text-orange">Snapshots of Impact: A Look Back at Our Past Events</h3>

      <p>These moments reflect the heart of our mission—real people, real impact, and meaningful change across communities.</p>
    </div>
    <!-- container title ends -->
    <div class="container py-5">
      <h2 class="text-center mb-4">Ogeri Health Foundation Gallery</h2>

      <div class="row" data-masonry='{"percentPosition": true }'>
        <div class="col-6 col-md-4 mb-4">
          <img src="./assets/img/Frame 2147226443.png" class="img-fluid rounded" alt="">
        </div>
        <div class="col-6 col-md-4 mb-4">
          <img src="./assets/img/Rectangle 29.png" class="img-fluid rounded" alt="">
        </div>
        <div class="col-6 col-md-4 mb-4">
          <img src="./assets/img/Rectangle 30.png" class="img-fluid rounded" alt="">
        </div>
        <div class="col-6 col-md-4 mb-4">
          <img src="./assets/img/img1.png" class="img-fluid rounded" alt="">
        </div>
        <div class="col-6 col-md-4 mb-4">
          <img src="./assets/img/img2.png" class="img-fluid rounded" alt="">
        </div>
        <div class="col-6 col-md-4 mb-4">
          <img src="./assets/img/img3.png" class="img-fluid rounded" alt="">
        </div>
        <div class="col-6 col-md-4 mb-4">
          <img src="./assets/img/img4.png" class="img-fluid rounded" alt="">
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
  <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

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
  <!-- <script src="assets/js/isotope.pkgd.min.js"></script> -->

  <!-- Main Js File -->
  <script src="assets/js/main.js"></script>
</body>

</html>