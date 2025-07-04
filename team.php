<?php
session_start();
require 'api/Database/DatabaseConn.php';

 // Create an instance of DatabaseConn and establish connection
 $db = new DatabaseConn();
 $dbh = $db->connect();
?>

<?php

$page_title = "Ogeri Health Foundation - Volunteers";

$page_author = "Okibe!";

$page_description = "";

$page_rel = '';

$page_name = 'team.php';

$customs = array(
    "stylesheets" => ["assets/css/volunteer.css"],
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


<style>
    :root {
      --primary: #4361ee;
      --primary-light: #4895ef;
      --dark: #3a0ca3;
      --light: #f8f9fa;
      --success: #4cc9f0;
      --border: #dee2e6;
      --text: #212529;
      --shadow: rgba(0, 0, 0, 0.05);
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
      background-color: #f8fafc;
      color: var(--text);
      line-height: 1.6;
    }
    
    .volunteer-container {
      max-width: 900px;
      margin: 2rem auto;
      padding: 2rem;
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 30px var(--shadow);
    }
    
    .form-title {
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: var(--dark);
      text-align: center;
    }
    
    .volunteer-form {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }
    
    .form-row {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      width: 100%;
    }
    
    .form-group {
      flex: 1 1 300px;
      position: relative;
    }
    
    .form-group.full-width {
      flex: 1 1 100%;
    }
    
    .form-group.half-width {
      flex: 1 1 calc(50% - 0.5rem);
    }
    
    .form-control {
      width: 100%;
      padding: 0.75rem 1rem;
      font-size: 1rem;
      border: 1px solid var(--border);
      border-radius: 8px;
      transition: all 0.3s ease;
      background-color: #fcfcfc;
    }
    
    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }
    
    .form-select {
      width: 100%;
      padding: 0.75rem 1rem;
      font-size: 1rem;
      border: 1px solid var(--border);
      border-radius: 8px;
      background-color: #fcfcfc;
      cursor: pointer;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23212529' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 16px;
    }
    
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
      background-color: #fcfcfc;
      transition: all 0.3s ease;
      cursor: pointer;
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
      background-color: var(--primary-light);
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
<body>

    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->


    <!--********************************
   		Code Start From Here 
	******************************** -->

    <?php include 'include/header.php'; ?>


    <!--==============================
    Breadcumb
============================== -->
    
    <div class="breadcumb-wrapper " data-bg-src="assets/img/ogeri_img/volunteer_banner.jpg" data-overlay="theme">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Volunteers</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.php">Home</a></li>
                    <li>Volunteers</li>
                </ul>
            </div>
        </div>
    </div><!--==============================
Team Area  
==============================-->
    <section class="space">
        <div class="container">
        <div id="alertBox" class="alert-box">
           
        </div>
            <div class="title-area text-center">
                <span class="sub-title after-none before-none"><i class="far fa-heart text-theme"></i> Our
                    Volunteer</span>
                <h2 class="sec-title">Meet The Optimistic Volunteers</h2>
            </div>
            <div class="row gy-40 ">
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
               
               <!-- Single Item -->
               <div class="col-lg-3 col-md-6  mx-auto">
                   <div class="th-team team-card3">
                   <?php
                      $primaryPath = "volunteer_uploads/profiles/" . $profilePicture;
                      $fallbackPath = "admin/assets/images/volunteer-img-uploads/" . $profilePicture;

                      if (file_exists($primaryPath)) {
                          $imgSrc = "https://ogerihealth.org/" . $primaryPath;
                      } else {
                          $imgSrc = $fallbackPath;
                      }
                      ?>

                        <div class="team-img">
                            <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($name) ?>">
                        </div>

                       <div class="team-card-content ">
                           <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="box-title">
                                        <a href="team-details.php?id=<?= $volunteer_id ?>"><?= $name ?></a>
                                    </h3>
                                    <span>
                                        <a href="team-details.php?id=<?= $volunteer_id ?>" class="team-desig"><?= $role ?></a>
                                    </span>
                                </div>
                                
                                
                                <a href="team-details.php?id=<?= $volunteer_id ?>" class="team-desig2 btn btn-team">Read More</a>
                                
                            </div>
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
    <!-- voluntering benefits area -->
    <section class="mt-5 mb-3">
        <div class="container g-n2">
            <div class="title-area text-center">
                <span class="sub-title after-none before-none"><i class="far fa-heart text-theme"></i>Benefits of
                    Volunteering</span>
                <h2 class="sec-title">Benefits of Volunteering</h2>
            </div>
            <!-- <h2 class="h2 mt-1 sec-title text-center">Benefits of Volunteering</h2> -->
            <div class="volunteer-box">
                <div class="row gx-5">
                    <div class="col-md-6">
                        <img src="assets/img/gallery/DSC_1375 (1).jpg" class="img-fluid volunteer-img" alt="Benefits of Volunteering">
                        <!-- Content Column -->
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="checklist">
                            <ul>
                                <li><i class="fas fa-check-circle"></i>Make a Difference – Help bring essential healthcare services to underserved communities and contribute to improving lives.
                                </li>
                                <li><i class="fas fa-check-circle"></i>Gain Valuable Experience – Develop hands-on skills in public health, community outreach, and leadership, while working alongside medical professionals and experts.</li>
                                <li><i class="fas fa-check-circle"></i>Be Part of a Community – Join a passionate network of changemakers, build meaningful connections, and collaborate with people who share your commitment to health equity.
                                </li>
                                <li><i class="fas fa-check-circle"></i>Enhance Your Career – Whether you're a student, professional, or just looking to give back, volunteering can boost your resume and open doors to new opportunities in healthcare, advocacy, and social impact.
                                </li>
                                <li><i class="fas fa-check-circle"></i>Personal Growth & Fulfillment – Experience the joy and satisfaction of knowing your efforts are creating lasting change for individuals and communities.
                                </li>
                            </ul>
                        </div>
                        <!-- <p>Your time, skills, and passion can make all the difference. Join us today and be part of the movement for better health!</p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- volunteering oppotunities -->
    <section class="space" id="donation-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="title-area text-center">
                        <span class="sub-title after-none before-none"><i class="far fa-heart text-theme"></i>Volunteering opportunities</span>
                        <h2 class="sec-title">Volunteering Opportunities</h2>
                    </div>
                </div>
            </div>
            <div class="row gy-30">
            <?php
              
              
               
              
               
              try {
                  // Prepare and execute query
                  $query = "SELECT * FROM volunteer_opportunities WHERE status = 'published' ORDER BY created_at DESC LIMIT 8";
                  $stmt = $dbh->prepare($query);
                  $stmt->execute();
              
                  // Fetch results
                  if ($stmt->rowCount() > 0) {
                      while ($volunteer = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          $title = htmlspecialchars($volunteer['title']);
                          $description = htmlspecialchars($volunteer['description']);
                       //    $phone = htmlspecialchars($volunteer['phone']);
                         
                          $image = !empty($volunteer['image']) ? $volunteer['image'] : "assets/img/gallery/Giving Tuesday.jpg"; 
                          
              ?>
              
                <div class="col-xl-6">
                    <div class="donation-card style3">
                        <div class="box-thumb">
                            <img src="admin/assets/images/volunteer-opp-img/<?= $image ?>" alt="image">
                            <div class="donation-card-shape" data-mask-src="assets/img/donation/donation-card-shape2-1.png"></div>
                        </div>
                        <div class="box-content">
                            <h3 class="box-title"><a href="contact.php"><?= $title ?></a></h3>
                            <p>Join our community of dedicated supporter by becoming member. Enjoy exclusive benefit.</p>
                            <a href="team.php#team-sec" class="th-btn style6">Volunteer Now <i class="fas fa-arrow-up-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <?php
                       } // End while loop
                   } else {
                       echo "<p>No volunteers Opportunities available at the moment.</p>";
                   }
               } catch (PDOException $e) {
                   die("Database query failed: " . $e->getMessage());
               }
               ?>

                

            </div>
        </div>
    </section>

    <!--==============================
Team Area  
==============================-->
    <section class="space " id="team-sec">
        <div class="container">
            <div class="row gy-40 gx-80">
                <div class="col-xl-8 mx-auto">
                    <h2 class="title mt-n2 mb-25 text-center">Let’s join our community
                        to become a volunteer</h2>
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="page-img">
                                <img src="assets/img/team/volunteer-1dd.jpg" alt="team">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="page-img">
                                <img src="assets/img/team/volunteer-260-200.jpg" alt="team">
                            </div>
                        </div>
                    </div> -->
                    <h3 class="h5 mt-n2">Volunteer Requirements</h3>
                    <p class="mb-30">Discover the inspiring stories of individuals and communities transformed by our programs. Our success stories highlight the real-life impact of your donations and the resilience of those we help. These narratives showcase the power of compassion and generosity.</p>
                    <div class="checklist">
                        <!-- <ul>
                        <li><i class="fas fa-check-circle"></i>Making this first true generator simply text</li>
                        <li><i class="fas fa-check-circle"></i>Many desktop publish packages nothing</li>
                        <li><i class="fas fa-check-circle"></i>If you are going to passage</li>
                        <li><i class="fas fa-check-circle"></i>It has roots in a piece</li>
                        <li><i class="fas fa-check-circle"></i>Sed ut perspiciatis unde iste natus</li>
                    </ul> -->
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mx-auto">
                <div class="add-team-form">
                <form action="volunteer-form-script.php" method="POST" class="volunteer-form" enctype="multipart/form-data" id="volunteerForm">
                  <!-- Personal Information -->
                  <div class="form-row">
                    <div class="form-group">
                      <label for="name" class="form-label">Full Name</label>
                      <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="email" class="form-label">Email Address</label>
                      <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                    </div>
                  </div>
                  
                  <div class="form-row">
                    <div class="form-group">
                      <label for="phone" class="form-label">Phone Number</label>
                      <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="gender" class="form-label">Gender</label>
                      <select id="gender" name="gender" class="form-select" required>
                        <option value="" disabled selected>Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                        <option value="Prefer not to say">Prefer not to say</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group full-width">
                    <label for="address" class="form-label">Home Address</label>
                    <input type="text" id="address" name="home_address" class="form-control" placeholder="Enter your complete address" required>
                  </div>
                  
                  <div class="form-row">
                    <div class="form-group">
                      <label for="profession" class="form-label">Profession</label>
                      <input type="text" id="profession" name="profession" class="form-control" placeholder="Enter your profession">
                    </div>
                    
                    <div class="form-group">
                      <label for="role" class="form-label">Volunteer Role</label>
                      <select id="role" name="role" class="form-select" required>
                        <option value="" disabled selected>Select volunteer role</option>
                        <option value="Patient Clinic">Patient Clinic</option>
                        <option value="Fundraising">Fundraising</option>
                        <option value="Administration">Administration</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Events">Events</option>
                        <option value="Community Outreach">Community Outreach</option>
                      </select>
                    </div>
                  </div>
                  
                  <!-- Profile Picture Upload with Preview -->
                  <div class="form-group full-width">
                    <label class="form-label">Profile Picture</label>
                    
                    <div class="image-preview" id="imagePreview">
                      <img src="" alt="Profile Preview" id="previewImg">
                    </div>
                    
                    <div class="file-upload" id="profile-upload">
                      <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
                      <div class="file-upload-icon">
                        <i class="fas fa-user-circle"></i>
                      </div>
                      <p class="file-upload-text">Drag and drop your profile photo or <strong>browse</strong><br>JPG, PNG or GIF (max. 2MB)</p>
                      <p class="file-name" id="profile-file-name"></p>
                    </div>
                  </div>
                  
                  <!-- Resume Upload -->
                  <div class="form-group full-width">
                    <label class="form-label">Resume/CV</label>
                    <div class="file-upload" id="resume-upload">
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
                  
                  <!-- Bio -->
                  <div class="form-group full-width">
                    <label for="bio" class="form-label">Short Bio</label>
                    <textarea id="bio" name="bio" class="form-control textarea" placeholder="Tell us a little about yourself..."></textarea>
                  </div>
                  
                  <!-- Social Links -->
                  <div class="form-group full-width">
                    <label class="form-label">Social Media Links</label>
                    <div class="socials-container">
                      <div class="social-input-group">
                        <div class="social-icon">
                          <i class="fab fa-linkedin"></i>
                        </div>
                        <input type="url" name="linkedin" class="form-control" placeholder="LinkedIn URL">
                      </div>
                      
                      <div class="social-input-group">
                        <div class="social-icon">
                          <i class="fab fa-twitter"></i>
                        </div>
                        <input type="url" name="twitter" class="form-control" placeholder="Twitter URL">
                      </div>
                      
                      <div class="social-input-group">
                        <div class="social-icon">
                          <i class="fab fa-facebook"></i>
                        </div>
                        <input type="url" name="facebook" class="form-control" placeholder="Facebook URL">
                      </div>
                      
                      <div class="social-input-group">
                        <div class="social-icon">
                          <i class="fab fa-instagram"></i>
                        </div>
                        <input type="url" name="instagram" class="form-control" placeholder="Instagram URL">
                      </div>
                    </div>
                  </div>
                  
                  <!-- Skills -->
                  <div class="form-group full-width">
                    <label for="skills" class="form-label">Skills (press Enter to add)</label>
                    <div class="skills-container" id="skills-container">
                      <input type="text" id="skills-input" class="skill-input" placeholder="Add skills...">
                    </div>
                    <input type="hidden" name="skills" id="skills-hidden">
                  </div>
                  
                  <!-- Motivation -->
                  <div class="form-group full-width">
                    <label for="motivation" class="form-label">Why do you want to volunteer?</label>
                    <textarea id="motivation" name="motivation" class="form-control textarea" placeholder="Share your motivation for volunteering with us..."></textarea>
                  </div>
                  
                  <!-- Submit Button -->
                  <button type="submit" class="submit-btn">Submit Application</button>
                </form>
  
  

                </div>
            </div>
        </div>
        <div class="success-message" id="successMessage">
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
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div>

    <!--==============================
    All Js File
============================== -->
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
    
    // Form submission handling
    document.getElementById('volunteerForm').addEventListener('submit', function(e) {
      e.preventDefault(); // Prevent actual form submission for demo purposes
      
      // Show success message
      // document.getElementById('successMessage').style.display = 'flex';
      
      // In a real implementation, you would submit the form data via AJAX here
      const formData = new FormData(this);
      fetch('https://ogerihealth.org/api/v1/post_volunteer.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        // Show success message
        document.getElementById('successMessage').style.display = 'flex';
      })
      .catch(error => {
        console.error('Error:', error);
        alert('There was an error submitting your application. Please try again.');
      });
    });
    
    // Close success message
    document.getElementById('closeSuccessBtn').addEventListener('click', function() {
      document.getElementById('successMessage').style.display = 'none';
      document.getElementById('volunteerForm').reset(); // Reset form after successful submission
      
      // Reset preview elements
      document.getElementById('imagePreview').style.display = 'none';
      document.getElementById('resumeIcon').style.display = 'none';
      document.getElementById('profile-file-name').style.display = 'none';
      
      // Clear skills
      const skillTags = document.querySelectorAll('.skill-tag');
      skillTags.forEach(tag => {
        skillsContainer.removeChild(tag);
      });
      skills.length = 0;
      updateHiddenField();
    });
  </script>
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

   

    <script>
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
</script>




</body>

</html>