<?php
    session_start();
?>
<?php

    $page_title = "login - Volunteer - Ogeri Health Foundation";

    $page_author = "Praise!";

    $page_description = "";

    $page_rel = '../';

    $page_name = 'login.php';

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
          <img src="<?php echo $page_rel; ?>admin/assets/images/login/back.svg" alt="" />
        </button>
      </div>
      <div class="login-section container">
        <div class="success-message" id="successMessage">
          <span>Congratulations! You have successfully logged in.</span>
          <button class="btn-close" onclick="closeSuccessMessage()"></button>
        </div>
        <div class="logo-section">
          <img
            src="<?php echo $page_rel; ?>admin/assets/images/login/name-logo.svg"
            alt=""
            class="logo"
          />
        </div>

        <div class="login-form ">
          <h2 class="text-nowrap">Log In</h2>
          <p>Log In as a Volunteer</p>
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
            <div class="mb-3 password-wrapper">
              <label for="password" class="form-label">Password*</label>
              <input
                type="password"
                class="form-control"
                id="password"
                placeholder="Enter your password"
                required
              />
              <span class="toggle-password" onclick="togglePassword()">
                <i class="fa fa-eye" id="eye-icon"></i>
              </span>
            </div>
            <div class="d-flex justify-content-between">
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" />
                <label class="form-check-label" for="remember"
                  >Remember me</label
                >
              </div>

              <a href="" class="forgot-link">Forgot Password ?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">
              Log In <img src="<?php echo $page_rel; ?>admin/assets/images/login/forward.svg" alt="" me-3 />
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

      function closeSuccessMessage() {
        document.getElementById("successMessage").style.display = "none";
      }
    </script>
  </body>
</html>
