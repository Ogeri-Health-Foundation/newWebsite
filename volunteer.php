<?php
session_start();
require 'api/Database/DatabaseConn.php';

 //Create an instance of DatabaseConn and establish connection
 $db = new DatabaseConn();
 $dbh = $db->connect();
?>

<?php

$page_title = "Ogeri Health Foundation - About";

$page_author = "Praise!";

$page_description = "";

$page_rel = '';

$page_name = 'Volunteers';

$customs = array(
    "stylesheets" => ["assets/css/about.css"],
    "scripts" => ["admin/assets/js/demo.js"]
);

$addons = array(
    "stylesheets" => ["https://some-external-url.css"],
    "scripts" => ["https://some-external-url.js"]
);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php  include 'include/head.php'; ?> 
    
    <link rel="stylesheet" href="./assets/css/volunter-2.css" />
    <style>
      .form-select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }
    
    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #4b5563;
    }
    
    .file-upload {
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 2rem;
      border: 2px dashed var(--border);
      border-radius: 8px;
      /* background-color: #fcfcfc; */
      transition: all 0.3s ease;
      cursor: pointer;
      /* height: 100%; */
      
    }
    
    .file-upload:hover {
      border-color: var(--primary-light);
      background-color: rgba(67, 97, 238, 0.03);
    }
    
    .file-upload input {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      opacity: 0;
      cursor: pointer;
      border: 2px solid red;
    }
    
    .file-upload-icon {
      font-size: 2rem;
      color: var(--primary);
      margin-bottom: 0.75rem;
    }
    
    .file-upload-text {
      font-size: 0.875rem;
      color: #6b7280;
      text-align: center;
    }
    
    .file-upload-text strong {
      color: var(--primary);
      text-decoration: underline;
    }
    
    .file-name {
      margin-top: 0.5rem;
      font-size: 0.875rem;
      color: var(--dark);
      display: none;
    }
    
    /* Image preview */
    .image-preview {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      overflow: hidden;
      margin: 1rem auto;
      border: 3px solid var(--primary-light);
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.15);
      display: none;
    }
    
    .image-preview img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .textarea {
      min-height: 120px;
      resize: vertical;
    }
    
    .socials-container {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }
    
    .social-input-group {
      display: flex;
      align-items: center;
      flex: 1 1 calc(50% - 0.5rem);
    }
    
    .social-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 42px;
      height: 42px;
      background-color: #f8f9fa;
      border: 1px solid var(--border);
      border-right: none;
      border-radius: 8px 0 0 8px;
      color: #4b5563;
    }
    
    .social-input-group .form-control {
      border-radius: 0 8px 8px 0;
      flex: 1;
    }
    
    .skills-container {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      padding: 0.5rem;
      border: 1px solid var(--border);
      border-radius: 8px;
      min-height: 48px;
      background-color: #fcfcfc;
    }
    
    .skill-tag {
      display: inline-flex;
      align-items: center;
      padding: 0.25rem 0.75rem;
      background-color: var(--theme-color);
      color: white;
      border-radius: 50px;
      font-size: 0.875rem;
    }
    
    .skill-tag .remove-skill {
      margin-left: 0.5rem;
      cursor: pointer;
    }
    
    .skill-input {
      flex: 1;
      min-width: 100px;
      border: none;
      outline: none;
      background: transparent;
      padding: 0.25rem;
      font-size: 1rem;
    }
    
    .submit-btn {
      background: linear-gradient(135deg, var(--primary), var(--dark));
      color: white;
      border: none;
      padding: 1rem 2rem;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 1rem;
      text-align: center;
      width: 100%;
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
    }
    
    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
    }
    
    /* Success Message Styling */
    .success-message {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }
    
    .success-content {
      background-color: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      text-align: center;
      max-width: 500px;
      width: 90%;
      animation: slide-up 0.4s ease-out;
    }
    
    @keyframes slide-up {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .success-icon {
      width: 80px;
      height: 80px;
      background-color: #4ade80;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
    }
    
    .success-icon i {
      color: white;
      font-size: 2.5rem;
    }
    
    .success-title {
      font-size: 1.5rem;
      color: var(--dark);
      margin-bottom: 1rem;
    }
    
    .success-message p {
      color: #6b7280;
      margin-bottom: 1.5rem;
    }
    
    .success-button {
      background-color: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      font-weight: 500;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .success-button:hover {
      background-color: var(--dark);
    }
    
    /* Resume file icon */
    .resume-icon {
      display: none;
      text-align: center;
      margin-top: 1rem;
    }
    
    .resume-icon i {
      font-size: 2rem;
      color: #6b7280;
    }

    .checklist ul{
      padding-left: 0.5rem;
    }
    
    .resume-file-name {
      font-size: 0.875rem;
      margin-top: 0.5rem;
      color: var(--dark);
    }
    
    @media (max-width: 768px) {
      .volunteer-container {
        padding: 1.5rem;
        margin: 1rem;
      }
      
      .form-group.half-width {
        flex: 1 1 100%;
      }
      
      .social-input-group {
        flex: 1 1 100%;
      }
    }
 
    </style>
  </head>
  <body>
    <!-- HERO SECTION -->
    
      <?php include 'include/header.php'; ?>  
    <section class="hero-section container-fluid">
      <div class="hero-text-container container-sm">
        <p class="page-title text-white fs-4">Volunteers</p>
        <h4 class="hero-tagline text-white">
          Every moment you give can change lives. Join our mission to create
          healthier communities.
        </h4>
        <a href="#volunteerForm">
          <button class="btn register-btn text-white">Register Now</button>
        </a>
        <a href="#volunteerOp">
          <button class="btn discover-btn text-white">Discover Opportunities</button>
        </a>
      </div>
    </section>
    <!-- TESTIMONIAL SECTION -->
    <section class="container px-4 pb-3">
      <div class="testimonial-header text-center">
        <h2>Testimonials</h2>
        <p>What People Say About Our Charity</p>
      </div>

      <div
        id="carouselExample"
        class="carousel slide testimonial-carousel"
        data-bs-ride="carousel"
      >
        <div class="carousel-indicators c-indicator">
          <button
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide-to="0"
            class="active indicator-btn l-btn"
            aria-current="true"
            aria-label="Slide 1"
            focused
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide-to="1"
            aria-label="Slide 2"
            class="indicator-btn"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide-to="2"
            aria-label="Slide 3"
            class="indicator-btn r-btn"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row citem">
              <div class="testimonial-card col-4">
                 <div class="quote-box">
                  <img
                    src="./assets/img/volunteer/icons/quote-cycle.png"
                    alt="quote icon image"
                  />
                </div>
                <p class="testimonial-text">
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et d
                </p>
                <div class="testimonial-footer">
                  <img
                    src="./assets/img/volunteer/img/avatar-testimonial-0.png"
                    alt="image of volunteer"
                  />
                  <div>
                    <p>Opara dara</p>
                    <p>Role</p>
                  </div>
                </div>
              </div>
              <div class="testimonial-card col-4 middle-card">
                <div class="quote-box">
                  <img
                    src="./assets/img/volunteer/icons/quote-cycle-white.png"
                    alt="quote icon image"
                  />
                </div>
                <p>
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et d
                </p>
                <div class="testimonial-footer">
                  <img
                    src="./assets/img/volunteer/img/avatar-testimonial-0.png"
                    alt="image of volunteer"
                  />
                  <div>
                    <p>Opara dara</p>
                    <p>Role</p>
                  </div>
                </div>
              </div>
              <div class="testimonial-card col-4">
                 <div class="quote-box">
                  <img
                    src="./assets/img/volunteer/icons/quote-cycle.png"
                    alt="quote icon image"
                  />
                </div>
                <p>
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et d
                </p>
                <div class="testimonial-footer">
                  <img
                    src="./assets/img/volunteer/img/avatar-testimonial-0.png"
                    alt="image of volunteer"
                  />
                  <div>
                    <p>Opara dara</p>
                    <p>Role</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row citem">
              <div class="testimonial-card col-4">
                 <div class="quote-box">
                  <img
                    src="./assets/img/volunteer/icons/quote-cycle.png"
                    alt="quote icon image"
                  />
                </div>
                <p>
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et d
                </p>
                <div class="testimonial-footer">
                  <img
                    src="./assets/img/volunteer/img/avatar-testimonial-0.png"
                    alt="image of volunteer"
                  />
                  <div>
                    <p>Opara dara</p>
                    <p>Role</p>
                  </div>
                </div>
              </div>
              <div class="testimonial-card col-4 middle-card">
                 <div class="quote-box">
                  <img
                    src="./assets/img/volunteer/icons/quote-cycle-white.png"
                    alt="quote icon image"
                  />
                </div>
                <p>
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et d
                </p>
                <div class="testimonial-footer">
                  <img
                    src="./assets/img/volunteer/img/avatar-testimonial-0.png"
                    alt="image of volunteer"
                  />
                  <div>
                    <p>Opara dara</p>
                    <p>Role</p>
                  </div>
                </div>
              </div>
              <div class="testimonial-card col-4">
                 <div class="quote-box">
                  <img
                    src="./assets/img/volunteer/icons/quote-cycle.png"
                    alt="quote icon image"
                  />
                </div>
                <p>
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed
                  do eiusmod tempor incididunt ut labore et d
                </p>
                <div class="testimonial-footer">
                  <img
                    src="./assets/img/volunteer/img/avatar-testimonial-0.png"
                    alt="image of volunteer"
                  />
                  <div>
                    <p>Opara dara</p>
                    <p>Role</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row citem">
              <div class="testimonial-card col-4">
                 <div class="quote-box">
                    <img
                      src="./assets/img/volunteer/icons/quote-cycle.png"
                      alt="quote icon image"
                    />
                  </div>
                <p>
                  okibe ipsum dolor sit amet, consecte tur adipiscing elit, sed do
                  eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do
                  eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem
                  ipsum dolor sit amet, consecte tur adipiscing elit, sed do
                  eiusmod tempor incididunt ut labore et d
                </p>
                <div class="testimonial-footer">
                  <img
                    src="./assets/img/volunteer/img/avatar-testimonial-0.png"
                    alt="image of volunteer"
                  />
                  <div>
                    <p>Opara dara</p>
                    <p>Role</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev visually-hidden"
          type="button"
          data-bs-target="#carouselExample"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next visually-hidden"
          type="button"
          data-bs-target="#carouselExample"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <!-- VOLUNTEER SECTION -->
    <section class="volunteer-section container px-4 py-5">
      <div class="volunteer-header pb-3 text-center">
        <h2>Meet Our Volunteer</h2>
        <p class="">
          Behind every smile, direction, and helping hand is a volunteer making
          a difference. Meet the heroes who make it all happen!
        </p>
      </div>
      <div
        class="card-container container d-flex flex-column flex-md-row align-items-center justify-content-center"
      >
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

        <div class="volunteer-card">
          <?php
                      $primaryPath = "volunteer_uploads/profiles/" . $profilePicture;
                      $fallbackPath = "admin/assets/images/volunteer-img-uploads/" . $profilePicture;

                      if (file_exists($primaryPath)) {
                          $imgSrc = "https://ogerihealth.org/" . $primaryPath;
                      } else {
                          $imgSrc = $fallbackPath;
                      }
                      ?>
          <img
            src="<?= htmlspecialchars($imgSrc) ?>"
            alt="image of a volunteer"
            class="volunteer-avatar"
          />
          <h3><?= $name ?></h3>
          <p><?= $role ?></p>
          <div class="social-icons" id="social-icons">
            <?php
   
          if (isset($facebook) && !empty($facebook)) {
              echo '<a target="_blank" href="' . htmlspecialchars($facebook) . '" class="volunteer-social"> <img
                src="./assets/img/volunteer/icons/facebook-icon-cycle.png"
                alt="facebook icon"
              /></a>';
          }
          
          if (isset($twitter) && !empty($twitter)) {
              echo '<a target="_blank" href="' . htmlspecialchars($twitter) . '" class="volunteer-social"><img
                src="./assets/img/volunteer/icons/x-icon-cycle.png"
                alt="x icon"
              /></a>';
          }
          
          if (isset($instagram) && !empty($instagram)) {
              echo '<a target="_blank" href="' . htmlspecialchars($instagram) . '" class="volunteer-social"><img
                src="./assets/img/volunteer/icons/instagram-icon-cycle.png"
                alt="instagram icon"
              /></a>';
          }
          
          if (isset($linkedin) && !empty($linkedin)) {
              echo '<a target="_blank" href="' . htmlspecialchars($linkedin) . '" class="volunteer-social"><img
                src="./assets/img/volunteer/icons/linkedin-icon.png"
                alt="linkedin icon"
                class=""
              /></a>';
          }
        ?>
            
          </div>
          <a href="team-details.php?id=<?= $volunteer_id ?>"  class="th-btn">View Details</a>
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
    </section>
    <!-- BENEFIT SECTION -->
    <section
      class="benefit-section container px-4 py-5 gap-4 d-flex flex-column flex-column-reverse flex-lg-row"
    >
      <div class="image-container align-self-center">
        <img
          src="./assets/img/volunteer/img/volunteer-image.png"
          alt=""
          class=""
        />
      </div>
      <div class="benefit-list">
        <h2 class="benefit-header">Benefits Of Volunteering</h2>
        <p class="benefit-sub-header">
          Volunteering opens doors to new experiences, connections, and
          opportunities.
        </p>
        <div class="benefit-container">
          <div class="benefit container-fluid">
            <img
              src="./assets/img/volunteer/icons/location-icon-3.png"
              alt="location pin icon"
            />
            <p>
              Make a Difference – Help bring essential healthcare services to
              underserved communities and contribute to improving lives.
            </p>
          </div>
          <div class="benefit">
            <img
              src="./assets/img/volunteer/icons/location-icon-3.png"
              alt="location pin icon"
            />
            <p>
              Make a Difference – Help bring essential healthcare services to
              underserved communities and contribute to improving lives.
            </p>
          </div>
          <div class="benefit">
            <img
              src="./assets/img/volunteer/icons/location-icon-3.png"
              alt="location pin icon"
            />
            <p>
              Make a Difference – Help bring essential healthcare services to
              underserved communities and contribute to improving lives.
            </p>
          </div>
          <div class="benefit">
            <img
              src="./assets/img/volunteer/icons/location-icon-3.png"
              alt="location pin icon"
            />
            <p>
              Make a Difference – Help bring essential healthcare services to
              underserved communities and contribute to improving lives.
            </p>
          </div>
          <div class="benefit">
            <img
              src="./assets/img/volunteer/icons/location-icon-3.png"
              alt="location pin icon"
            />
            <p>
              Make a Difference – Help bring essential healthcare services to
              underserved communities and contribute to improving lives.
            </p>
          </div>
          <div class="benefit">
            <img
              src="./assets/img/volunteer/icons/location-icon-3.png"
              alt="location pin icon"
            />
            <p>
              Make a Difference – Help bring essential healthcare services to
              underserved communities and contribute to improving lives.
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- VOLUNTEER OPPORTUNITY SECTION -->
    <section class="volunteer-opportunity container px-4 py-5" id="volunteerOp">
      <div class="volunteer-op-header text-center mb-4">
        <h2>Volunteering Opportunities</h2>
        <p>Find the right place to lend your time, talents, and heart.</p>
      </div>

      <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
          try {
              $query = "SELECT * FROM volunteer_opportunities WHERE status = 'published' ORDER BY created_at DESC LIMIT 8";
              $stmt = $dbh->prepare($query);
              $stmt->execute();

              $volunteers = $stmt->fetchAll(PDO::FETCH_ASSOC);
              $chunks = array_chunk($volunteers, 3); // 3 items per slide
              $activeSet = false;

              foreach ($chunks as $index => $chunk) {
                  echo '<div class="carousel-item ' . (!$activeSet ? 'active' : '') . '">';
                  echo '<div class="row citem">';
                  foreach ($chunk as $volunteer) {
                      $title = htmlspecialchars($volunteer['title']);
                      $description = htmlspecialchars($volunteer['description']);
                      $image = !empty($volunteer['image']) ? $volunteer['image'] : "assets/img/gallery/Giving Tuesday.jpg";
                      ?>
                      <div class="volunteer-op-card col-md-4">
                        <img
                          src="admin/assets/images/volunteer-opp-img/<?= $image ?>"
                          alt="<?= $title ?>"
                          class="volunteering-img img-fluid"
                        />
                        <h3><?= $title ?></h3>
                        <p class="px-1"><?= substr($description, 0, 180) ?>...</p>
                        <a class="th-btn" href="#volunteerForm">
                          Apply Now
                          <img
                            src="./assets/img/volunteer/icons/diagonal-arrow-icon.png"
                            alt="arrow icon" class="ms-2"
                          />
                        </a>
                      </div>
                      <?php
                  }
                  echo '</div></div>';
                  $activeSet = true;
              }

              if (count($chunks) === 0) {
                  echo "<p class='text-center'>No volunteering opportunities available at the moment.</p>";
              }
          } catch (PDOException $e) {
              echo "<p class='text-danger text-center'>Error loading opportunities.</p>";
          }
          ?>
        </div>

        <!-- Carousel controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <!-- FORM SECTION -->
    <section class="form-section container px-4 py-5" id="volunteerFormSection">
      <div class="form-header">
        <h2 class="form-header-title">Volunteering Requirement</h2>
        <p class="section-header-description">
          Discover the inspiring stories of individuals and communities
          transformed by our programs. Our success stories highlight the
          real-life impact of your donations and the resilience of those we
          help. These narratives showcase the power of compassion and
          generosity.
        </p>
      </div>
      

      <div class="form-container container  ">
        <form  method="POST" class="volunteer-form" enctype="multipart/form-data" id="volunteerForm">
          <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input
              type="text"
              class="form-control"
              id="name"
              name="name"
              placeholder="John Doe"
            />
          </div>
          <div class="mb-3">
            <label for="emailAddress" class="form-label">Email address</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              placeholder="name@example.com"
            />
          </div>
          <div class="mb-3">
            <label for="telephone" class="form-label">Phone Number</label>
            <input
              type="tel"
              class="form-control"
              id="phone"
              name="phone"
              placeholder="+234802542365"
            />
          </div>
          <div class="mb-3">
            <label for="profession" class="form-label">Select Your Gender</label>
            <select
              class="form-select"
              aria-label="Default select example"
              name="gender"
              id="gender"
            >
              <option selected disabled>Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="mb-3">

            <label for="homeAddress" class="form-label">Home address</label>
            <input
              type="text"
              class="form-control"
              id="address"
              name="home_address"
              placeholder="Enter your complete home address"
            />
          </div>
          <div class="mb-3">
            <label for="profession" class="form-label">Profession</label>
            <input
              type="text"
              class="form-control"
              id="profession"
              name="profession"
              placeholder="Enter your profession"
            />
          </div>
          <div class="mb-3">
            <label for="profession" class="form-label">Role</label>
            <select
              class="form-select"
              aria-label="Default select example"
              name="role"
              id="role"
            >
              <option value="" disabled selected>Select volunteer role</option>
              <option value="Patient Clinic">Patient Clinic</option>
              <option value="Fundraising">Fundraising</option>
              <option value="Administration">Administration</option>
              <option value="Marketing">Marketing</option>
              <option value="Events">Events</option>
              <option value="Community Outreach">Community Outreach</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="profilePicture" class="form-label">Profile Picture</label>
            <div class="file-input-wrapper profileWrapper">
              <!-- <input
                type="file"
                class="form-control profile-file-btn"
                id="profilePicture"
                placeholder="John Doe"
                hidden
              /> -->
               <div class="image-preview" id="imagePreview">
                <img src="" alt="Profile Preview" id="previewImg">
              </div>
              <div id="profile-upload" class="file-upload">
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
                <img src="./assets/img/volunteer/icons/avatar-icon.png" alt="" />
                <p>
                  Drag and drop your photo or
                  <span class="browse-text">browse</span> JPG, PNG or GIF(max.2MB)
                </p>
                <p class="file-name" id="profile-file-name"></p>
              </div>
            </div>
          </div>
          <div class="form-group full-width mb-3">
            <label class="form-label">Resume/CV</label>
            <div class="file-upload bg-white" id="resume-upload">
              <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx">
              <div class="file-upload-icon">
                <i class="fas fa-file-alt"></i>
              </div>
              <p class="file-upload-text">Drag and drop your resume or <strong>browse</strong><br>PDF, DOC or DOCX (max. 5MB)</p>
            </div>
            <div class="resume-icon" id="resumeIcon">
              <i class="fas fa-file-pdf"></i>
              <p class="resume-file-name" id="resume-file-name"></p>
            </div>
          </div>
          <div class="mb-3">
            <label for="bio" class="form-label">Short Bio</label>
            <textarea
              class="form-control"
              id="bio"
              name="bio"
              rows="10"
              placeholder="Tell us about yourself"
            ></textarea>
          </div>
          <div class="social-link-container mb-3">
            <div class="row">
              <div class="input-group mb-3 col-12">
                <span class="input-group-text" id="basic-addon1"
                  ><img
                    src="./assets/img/volunteer/icons/facebook-icon-form.png"
                    class="img-"
                    alt=""
                /></span>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Username"
                  aria-label="Username"
                  aria-describedby="basic-addon1"
                  id="facebookUsername"
                  name="facebook"
                />
              </div>
              <div class="input-group mb-3 col-12">
                <span class="input-group-text" id="basic-addon2"
                  ><img
                    src="./assets/img/volunteer/icons/linkedin-icon-form.png"
                    alt=""
                /></span>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Username"
                  aria-label="Username"
                  aria-describedby="basic-addon2"
                  id="linkedUsername"
                  name="linkedin"
                />
              </div>
            </div>
            <div class="row">
              <div class="input-group mb-3 col-12">
                <span class="input-group-text" id="basic-addon3"
                  ><img src="./assets/img/volunteer/icons/x-icon-form.png" alt="x icon"
                /></span>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Username"
                  aria-label="Username"
                  aria-describedby="basic-addon3"
                  id="xUsername"
                  name="twitter"
                />
              </div>
              <div class="input-group mb-3 col-12">
                <span class="input-group-text" id="basic-addon4"
                  ><img
                    src="./assets/img/volunteer/icons/instagram-icon-form.png"
                    alt="instagram icon"
                /></span>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Username"
                  aria-label="Username"
                  aria-describedby="basic-addon4"
                  id="instagramUsername"
                  name="instagram"
                />
              </div>
            </div>
          </div>
          <div class="form-group full-width mb-3">
            <label for="skills" class="form-label">Skills (press Enter to add)</label>
            <div class="skills-container" id="skills-container">
              <input type="text" id="skills-input" class="skill-input" placeholder="Add skills...">
            </div>
            <input type="hidden" name="skills" id="skills-hidden">
          </div>
          <div class="mb-3">
            <label for="reason" class="form-label"
              >Why Do You Want To Volunteer</label
            >
            <textarea
              class="form-control"
              id="motivation"
              name="motivation"
              rows="10"
              placeholder="Share you motivation for volunteering with us."
            ></textarea>
          </div>
          <button
            id="submitBtn"
            type="submit"
            
            class="th-btn style3 d-block mx-auto w-75"
          >Submit Application</button>
        </form>
      </div>
      <div id="errorMessage"></div>
      <div class="success-message d-none" id="successMessage">
          <div class="success-content">
            <div class="success-icon">
              <i class="fas fa-check"></i>
            </div>
            <h3 class="success-title">Application Submitted Successfully!</h3>
            <p>Thank you for your interest in volunteering with us. We have received your application and will be in touch with you shortly.</p>
            <button class="success-button" id="closeSuccessBtn">Close</button>
          </div>
        </div>
    </section>
    <!-- FOOTER SECTION -->
     <?php include "include/footer.php" ; ?>
    <!-- <script src="./assets/js/volunteer.js"></script> -->
    <script>
    // File upload handling with image preview
    document.getElementById('profile_picture').addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        // Display file name
        const fileNameElement = document.getElementById('profile-file-name');
        fileNameElement.textContent = file.name;
        fileNameElement.style.display = 'block';
        
        // Preview image
        const reader = new FileReader();
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        reader.onload = function(e) {
          previewImg.src = e.target.result;
          preview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
      }
    });
    
    document.getElementById('resume').addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const fileNameElement = document.getElementById('resume-file-name');
        fileNameElement.textContent = file.name;
        
        const resumeIcon = document.getElementById('resumeIcon');
        resumeIcon.style.display = 'block';
        
        // Set appropriate icon based on file type
        const fileIcon = resumeIcon.querySelector('i');
        if (file.name.endsWith('.pdf')) {
          fileIcon.className = 'fas fa-file-pdf';
        } else if (file.name.endsWith('.doc') || file.name.endsWith('.docx')) {
          fileIcon.className = 'fas fa-file-word';
        } else {
          fileIcon.className = 'fas fa-file-alt';
        }
      }
    });
    
    // Skills input handling
    const skillsInput = document.getElementById('skills-input');
    const skillsContainer = document.getElementById('skills-container');
    const skillsHidden = document.getElementById('skills-hidden');
    const skills = [];
    
    skillsInput.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' && this.value.trim() !== '') {
        e.preventDefault();
        const skill = this.value.trim();
        if (!skills.includes(skill)) {
          addSkill(skill);
          this.value = '';
          updateHiddenField();
        }
      }
    });
    
    function addSkill(skill) {
      skills.push(skill);
      
      const skillTag = document.createElement('div');
      skillTag.className = 'skill-tag';
      skillTag.innerHTML = `${skill} <span class="remove-skill">&times;</span>`;
      
      skillTag.querySelector('.remove-skill').addEventListener('click', function() {
        skillsContainer.removeChild(skillTag);
        const index = skills.indexOf(skill);
        if (index > -1) {
          skills.splice(index, 1);
          updateHiddenField();
        }
      });
      
      skillsContainer.insertBefore(skillTag, skillsInput);
    }
    
    function updateHiddenField() {
      skillsHidden.value = skills.join(',');
    }
    function showError(message) {
        const errorBox = document.getElementById('errorMessage');
        errorBox.textContent = message;
        errorBox.style.display = 'block';

        // Auto-hide after 5 seconds
        setTimeout(() => {
          errorBox.style.display = 'none';
        }, 5000);
      }
      function clearPreviewAndSkills() {
        const imagePreview = document.getElementById('imagePreview');
        const resumeIcon = document.getElementById('resumeIcon');
        const profileFileName = document.getElementById('profile-file-name');
        const resumeFileName = document.getElementById('resume-file-name');

        if (imagePreview) imagePreview.style.display = 'none';
        if (resumeIcon) resumeIcon.style.display = 'none';
        if (profileFileName) {
          profileFileName.textContent = '';
          profileFileName.style.display = 'none';
        }
        if (resumeFileName) {
          resumeFileName.textContent = '';
          resumeFileName.style.display = 'none';
        }

        // Clear skill tags
        const skillTags = document.querySelectorAll('.skill-tag');
        skillTags.forEach(tag => {
          skillsContainer.removeChild(tag);
        });

        skills.length = 0;
        updateHiddenField();
      }
   document.addEventListener('DOMContentLoaded', function () {
  const volunteerForm = document.getElementById('volunteerForm');
  const successMessage = document.getElementById('successMessage');
  const errorMessageBox = document.getElementById('errorMessage'); // <- We'll add this too

  if (volunteerForm) {
    volunteerForm.addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(volunteerForm);

      fetch('api/v1/post_volunteer.php', {
        method: 'POST',
        body: formData,
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            document.getElementById('successMessage').style.display = 'flex';
            successMessage.classList.remove('d-none'); // Show success box
            volunteerForm.reset(); 
             clearPreviewAndSkills();
          } else {
            showError(data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showError('There was an error submitting your application. Please try again.');
        });
    });
  }
});

    
    // Close success message
    document.getElementById('closeSuccessBtn').addEventListener('click', function () {
      document.getElementById('successMessage').style.display = 'none';
      document.getElementById('volunteerForm').reset();

      
    });
  </script>
  <!-- <script>
    $(document).ready(function () {
        $(".ajax-contact").off("submit").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission

            let form = this;
            let formData = new FormData(form);

            $.ajax({
                url: $(form).attr("action"),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        showAlert(response.message, "success");
                        form.reset(); // Reset form
                        console.log("Form submitted");

                    } else {
                        showAlert(response.message, "error");
                    }
                },
                error: function (xhr, status, error) {
                    showAlert("Something went wrong. Please try again.", "error");
                    console.log(xhr.responseText);
                }
            });
        });

        function showAlert(message, type = "success") {
            let alertBox = $("#alertBox");

            let alertDiv = $("<div>")
                .addClass("alert")
                .addClass(type === "success" ? "alert-success" : "alert-danger");

            let closeButton = $("<span>")
                .addClass("alert-close")
                .html("&times;")
                .css({ float: "right", cursor: "pointer" })
                .click(function () {
                    $(this).parent().fadeOut(300, function () {
                        $(this).remove();
                    });
                });

            alertDiv.html(message).append(closeButton);
            alertBox.append(alertDiv).fadeIn();

            setTimeout(function () {
                alertDiv.fadeOut(2000, function () {
                    $(this).remove();
                });
            }, 4000);
        }
    });
    </script> -->
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