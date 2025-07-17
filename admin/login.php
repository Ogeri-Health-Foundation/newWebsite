<?php
session_start();
?>
<?php

$page_title = "login - Admin- Ogeri Health Foundation";

$page_author = "Your name here!";

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

  <?php include __DIR__ . '/include/head.php'; ?>

  <style>
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
      width: auto;
      max-width: 300px;
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
      background: rgb(250, 209, 209);
      color: rgb(185, 16, 16);
      display: flex;
      align-items: center;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 600;
      justify-content: center;
      border-radius: 50%;
      margin-right: 10px;
    }
  </style>

</head>
<body">
  <script>
    window.onload = function() {
      // fetch("https://ogerihealth.org/api/v1/auth.php") 
      fetch("../api/v1/auth.php")
        .then(response => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then(data => {
          console.log("Auth Data:", data);
          if (data.status === "success") {

            // location.href = "https://ogerihealth.org/admin/resources.php";
            location.href = "../admin/resources.php";
          }
        })
        .catch(error => {
          console.error("Fetch error:", error);
        });
    };
  </script>

  <div class="login-container">
    <div class="image-section d-none d-md-block">
      <button class="back-button">
        <img src="assets/images/login/back.svg" alt="" />
      </button>
    </div>
    <div class="login-section container">



      <!-- error or success message -->
      <div id="toast-success">
        <div class="icon">✔</div>
        <div id="toast-message">login success</div>
        <button class="close-btn" onclick="hideToast()">&times;</button>
      </div>

      <div id="bad-toast">
        <div class="bad-icon"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg></div>
        <div id="bad-toast-message">login not successful</div>
        <button class="close-btn" onclick="hideToast()">&times;</button>
      </div>



      <div class="logo-section">
        <img
          src="assets/images/login/name-logo.svg"
          alt=""
          class="logo" />
      </div>

      <div class="login-form ">
        <h2 class="text-nowrap">Log In</h2>
        <p>Log In as an Admin</p>

        <form id="loginForm" method="post">
          <div class="mb-3">
            <label for="email" class="form-label">Email address*</label>
            <input
              type="email"
              class="form-control"
              name="email"
              id="email"
              placeholder="Enter your email"
              required />
          </div>
          <div class="mb-3 password-wrapper">
            <label for="password" class="form-label">Password*</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              placeholder="Enter your password"
              required />
            <span class="toggle-password" onclick="togglePassword()">
              <i class="fa fa-eye" id="eye-icon"></i>
            </span>
          </div>
          <div class="d-flex justify-content-between">
            <!-- <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="remember" />
              <label class="form-check-label" for="remember">Remember me</label>
            </div> -->

            <!-- <a href="" class="forgot-link">Forgot Password ?</a> -->
          </div>
          <button type="submit" class="submit btn btn-primary w-100">
            Log In <img src="assets/images/login/forward.svg" alt="" me-3 />
          </button>
        </form>
        <!-- <p class="mt-3 sign-up">
          Don't have an account? <a href="#">Sign Up</a>
        </p> -->
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














    const form = document.querySelector('form');
    const Button = form.querySelector('.submit');
    const errorText = document.querySelector('.success-message');

    form.onsubmit = (e) => {
      e.preventDefault();
    };

    Button.onclick = () => {
      Button.disabled = true;
      const originalHTML = Button.innerHTML;
      Button.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Logging in...`;
      let xhr = new XMLHttpRequest();
      xhr.open('POST', '../api/v1/loginRoute.php', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // Ensure AJAX request

      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          try {
            let response = JSON.parse(xhr.responseText);
            if (xhr.status === 200) {

              const toast = document.getElementById('toast-success');
              const toastMesaage = document.getElementById('toast-message');
              toast.classList.add('show');
              toastMesaage.textContent = response.message;
              // setTimeout(hideToast, 3000);

              function hideToast() {
                const toast = document.getElementById('toast-success');
                toast.classList.remove('show');
              }

              if (response.message === "Signed In Successfully") {
                setTimeout(() => {
                  window.location.href = "index.php";
                }, 2000);
              }
            } else {

              const BadToast = document.getElementById('bad-toast');
              const BadToastMesaage = document.getElementById('bad-toast-message');
              BadToast.classList.add('show');
              BadToastMesaage.textContent = response.message || `Error ${xhr.status}: ${xhr.statusText}`;;
              setTimeout(hideBadToast, 3000);

              function hideBadToast() {
                const BadToast = document.getElementById('bad-toast');
                BadToast.classList.remove('show');
              }


            }
          } catch (error) {

            console.error("Invalid JSON response:", error);
            errorText.textContent = "An unexpected error occurred. Please try again.";
            errorText.style.display = 'block';
            errorText.style.color = 'red';
          }
        }
      };

      xhr.onerror = () => {

        errorText.textContent = "Network error. Please check your connection.";
        errorText.style.display = 'block';
        errorText.style.color = 'red';
      };

      let formData = new FormData(form);
      xhr.send(formData);
    };
  </script>
  </body>

</html>