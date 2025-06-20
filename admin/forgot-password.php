<?php
    session_start();
?>
<?php

    $page_title = "Forgot Password - Admin- Ogeri Health Foundation";

    $page_author = "Praise!";

    $page_description = "";

    $page_rel = '../';

    $page_name = 'forgot-password.php';

    $customs = array(
                "stylesheets" => ["admin/assets/css/login.css"],
                "scripts" => ["admin/assets/js/demo.js"]
               );

    $addons = array(
                "stylesheets" => ["https://some-external-url.css"],
                "scripts" => ["https://some-external-url.js"]
               );

?>
<!DOCTYPE html>
<html>
<head>
    
    <?php include $page_rel.'include/head.php'; ?>
   

</head>
<body">
    <div class="login-container">
      <div class="image-section d-none d-md-block">
        <button class="back-button">
          <img src="assets/images/login/back.svg" alt="" />
        </button>
      </div>
      <div class="login-section container">
        <div class="success-message" id="successMessage">
          <span>Congratulations! You have successfully logged in.</span>
          <button class="btn-close" onclick="closeSuccessMessage()"></button>
        </div>
        <div class="logo-section">
          <img
            src="assets/images/login/name-logo.svg"
            alt=""
            class="logo"
          />
        </div>

        <div class="login-form mt-5">
          <h3 class="text-nowrap">Forgot Password</h3>
          <p class=" w-75">Forgot your password? Enter your email address below, and we will send you instructions to reset it.</p>
          <form id="loginForm">
            <div class="mb-3">
              <label for="email" class="form-label">Email address*</label>
              <input
                type="email"
                class="form-control"
                id="email"
                placeholder="Enter your email"
                required
              />
            </div>
            
            <button type="submit" class="btn btn-primary w-100">
              Proceed <img src="assets/images/login/forward.svg" alt="" me-3 />
            </button>
          </form>
          
        </div>
      </div>
    </div>

    <script src="assets/js/login.js"></script>
    <script>
      
      function togglePassword() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.getElementById("eye-icon");
        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          eyeIcon.classList.remove("fa-eye");
          eyeIcon.classList.add("fa-eye-slash");
        } else {
          passwordInput.type = "password";
          eyeIcon.classList.remove("fa-eye-slash");
          eyeIcon.classList.add("fa-eye");
        }
      }

      function closeSuccessMessage() {
        document.getElementById("successMessage").style.display = "none";
      }
    </script>
  </body>
</html>
