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
            location.href = "../admin/index.php";
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
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eye-icon");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
      passwordInput.type = "password";
      eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
    }
  }

  const form = document.querySelector("form");
  const Button = form.querySelector(".submit");

  form.onsubmit = (e) => e.preventDefault();

  Button.onclick = () => {
    Button.disabled = true;
    const originalHTML = Button.innerHTML;
    Button.innerHTML =
      `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Logging in...`;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../api/v1/loginRoute.php", true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.onload = () => {
      // ✅ Always restore button state
      Button.disabled = false;
      Button.innerHTML = originalHTML;

      if (xhr.readyState === XMLHttpRequest.DONE) {
        try {
          const response = JSON.parse(xhr.responseText);
          const msg = response.message || "";

          // ✅ Case 1: Full login success
          if (response.status === 200 && msg.toLowerCase().includes("login successful")) {
            showSuccessToast(msg);
            setTimeout(() => (window.location.href = "index.php"), 1500);

          // ✅ Case 2: OTP sent flow
          } else if (response.status === 200 && msg.toLowerCase().includes("otp sent")) {
            showInfoToast(msg);

          // ❌ Case 3: Any other failure
          } else {
            showErrorToast(msg || `Error ${xhr.status}: ${xhr.statusText}`);
          }

        } catch (error) {
          console.error("Invalid JSON response:", error);
          showErrorToast("An unexpected error occurred. Please try again.");
        }
      }
    };

    xhr.onerror = () => {
      // ✅ Always restore button
      Button.disabled = false;
      Button.innerHTML = originalHTML;
      showErrorToast("Network error. Please check your connection.");
    };

    const formData = new FormData(form);
    xhr.send(formData);
  };

  // ✅ Toast helpers
  function showSuccessToast(message) {
    const toast = document.getElementById("toast-success");
    const msgEl = document.getElementById("toast-message");
    msgEl.textContent = message;
    toast.classList.add("show");
    setTimeout(() => toast.classList.remove("show"), 2000);
  }

  function showInfoToast(message) {
    const toast = document.getElementById("info-toast");
    const msgEl = document.getElementById("info-toast-message");
    msgEl.textContent = message;
    toast.classList.add("show");
    setTimeout(() => toast.classList.remove("show"), 3000);
  }

  function showErrorToast(message) {
    const toast = document.getElementById("bad-toast");
    const msgEl = document.getElementById("bad-toast-message");
    msgEl.textContent = message;
    toast.classList.add("show");
    setTimeout(() => toast.classList.remove("show"), 3000);
  }
</script>

  </body>

</html>