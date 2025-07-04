<?php
    session_start();
?>
<?php

    $page_title = "Reset password - Admin- Ogeri Health Foundation";

    $page_author = "Praise!";

    $page_description = "";

    $page_rel = '../';

    $page_name = 'rest-password.php';

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
          <span>Congratulations! You have successfully updated your passwword.</span>
          <button class="btn-close" onclick="closeSuccessMessage()"></button>
        </div>
        <div class="logo-section">
          <img
            src="assets/images/login/name-logo.svg"
            alt=""
            class="logo"
          />
        </div>

        <div class="login-form ">
          <h2 class="text-nowrap">Reset Password</h2>
          <p>Enter your new password </p>
          <form id="loginForm">
            <div class="mb-3 password-wrapper">
              <label for="password" class="form-label">New Password*</label>
              <input
                type="password"
                class="form-control"
                id="password"
                placeholder=""
                required
              />
              <span class="toggle-password" onclick="togglePassword()">
                <i class="fa fa-eye" id="eye-icon"></i>
              </span>
            </div>
            <div class="mb-3 password-wrapper">
              <label for="password" class="form-label">Confirm Password*</label>
              <input
                type="password"
                class="form-control"
                id="confirm-password"
                placeholder=""
                required
              />
              <span class="toggle-password" onclick="togglePassword2()">
                <i class="fa fa-eye" id="eye-icon"></i>
              </span>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">
              Confirm <img src="assets/images/login/forward.svg" alt="" me-3 />
            </button>
          </form>
          <p class="mt-3 sign-up">
            Don't have an account? <a href="#">Sign Up</a>
          </p>
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

      function togglePassword2() {
        var passwordInput = document.getElementById("confirm-password");
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
