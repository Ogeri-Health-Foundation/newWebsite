<div id="alertBox"></div>
<footer class="footer-wrapper footer-default" data-bg-src="assets/img/bg/footer-default-bg-mask.png" style="background-color: rgb(45, 63, 83);">
    
    <div class="footer-bg-shape2 shape-mockup jump" data-top="20%" data-right="0">
        <img src="assets/img/about/testimonial-heart.png" alt="img">
    </div>
    <div class="footer-bg-shape3 shape-mockup d-none" data-bottom="0" data-right="0">
        <img src="assets/img/shape/footer-bg-shape2.png" alt="img">
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="subscribe-box">
                <div class="row gy-40 align-items-center justify-content-center">
                    <div class="col-xl-6">
                        <h4 class="subscribe-box_title">Subscribe to Our Newsletter</h4>
                        <p class="subscribe-box_text">Regular inspections and feedback mechanisms</p>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <form class="newsletter-form" id="subscribeForm">
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Enter Email Address" required>
                            </div>
                            <button type="submit" class="th-btn style3">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <div class="about-logo2">
                                <a href="index.php" class="about-logo_link">
                                    <img src="assets/img/logo 24b 1.png" alt="Donat">
                                    <div class="about-logo_text">
                                        <span>
                                            THE
                                        </span>
                                        <H2>OGERI</H2>
                                        <span>
                                            HEALTH FOUNDATION
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <p class="about-text"> To improve health outcomes and empower communities across Africa, starting in Nigeria, by providing accessible healthcare.</p>

                            <a href="donation.php" class="th-btn"><i class="fas fa-heart me-2"></i>Donate Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Quick Links</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="blog.php">Blogs/Articles</a></li>
                                <li><a href="events.php">Our Events</a></li>
                                <li><a href="contact.php">Privacy Policy</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Pages</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="donation.php">Give Donation</a></li>
                                <li><a href="community-member.php">Community Members</a></li>
                                <li><a href="partnership.php">Partner With Us</a></li>
                                <li><a href="volunteer.php">Volunteer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="th-widget-contact">
                            <h3 class="widget_title">Contact Us</h3>
                            <div class="info-card">
                             
                               
                            </div>
                            <div class="info-card">
                                <div class="box-icon">
                                    <i class="fal fa-envelope-open"></i>
                                    <div class="bg-shape1" data-mask-src="assets/img/shape/info_card_icon_bg_shape_1_1.png"></div>
                                    <div class="bg-shape2" data-mask-src="assets/img/shape/info_card_icon_bg_shape_1_1.png"></div>
                                </div>
                                <div class="box-content">
                                    <p class="box-text">Email us any time:</p>
                                    <h4 class="box-title"><a href="mailto:info@ogerihealth.org">info@ogerihealth.org</a></h4>
                                </div>
                            </div>
                            <div class="th-social style2">
                                <a href="https://www.facebook.com/ogerihealth/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/ogerihealth/"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.linkedin.com/company/ogerihealth"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row justify-content-center gy-3 align-items-center">
                <div class="col-lg-12">
                    <p class="copyright-text text-center">
                        <i class="fal fa-copyright"></i> Copyright 2024 <a href="index.php">The Ogeri Health Foundation</a>. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800, // You can adjust duration if needed
    once: true     // Animate only once when scrolled into view
  });
</script>
<script>
    
$(document).ready(function () {
  
  $("#subscribeForm").on("submit", function (e) {
    e.preventDefault();

    const email = $(this).find("input[name='email']").val();

    $.ajax({
      url: "subscribers.php",
      method: "POST",
      data: { email: email },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          showAlert(response.message, "success");
          $("#subscribeForm")[0].reset();
        } else {
          showAlert(response.message || "An error occurred!", "error");
        }
      },
      error: function (xhr, status, error) {
        showAlert("Server error: " + error, "error");
      }
    });
  });
});

    function showAlert(message, type = "success") {
        let alertBox = $("#alertBox");
        let alertDiv = $("<div>").addClass("alert").addClass(type === "success" ? "alert-success" : "alert-error");
        let closeButton = $("<span>").addClass("alert-close").html("&times;").click(function () {
            $(this).parent().fadeOut(300, function () {
                $(this).remove();
            });
        });

        alertDiv.html(message).append(closeButton);
        alertBox.html(alertDiv).fadeIn();

        setTimeout(() => {
            alertDiv.fadeOut(300, () => alertDiv.remove());
        }, 4000);
    }
</script>

<script>
// Scroll background effect
window.addEventListener('scroll', () => {
  const header = document.getElementById('header');
  if (window.scrollY > 10) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});

// Mobile menu toggle

// Mobile dropdown toggle
// const getInvolvedBtn = document.getElementById('getInvolvedBtn');
// const getInvolvedMenu = document.getElementById('getInvolvedMenu');

// getInvolvedBtn.addEventListener('click', (e) => {
//   e.preventDefault();
//   getInvolvedMenu.classList.toggle('open');
// });
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const toggleLink = document.getElementById('getInvolvedToggle');
  const dropdown = document.getElementById('getInvolvedDropdown');

  // Initially hide dropdown
  dropdown.style.display = 'none';

  toggleLink.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent link navigation
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
  });
});
</script>
<script>
  const mobileMenu = document.getElementById("mobile-menu");
  const menuIcon2 = document.getElementById("menu-icon2");
  const closeMobileMenu = document.getElementById("mobile-menu-close");

  const toggleGetInvolved = document.getElementById("toggleGetInvolved");
  const getInvolvedItem = document.getElementById("getInvolvedItem");

  menuIcon2.addEventListener("click", () => {
    mobileMenu.classList.add("open");
  });

  closeMobileMenu.addEventListener("click", () => {
    mobileMenu.classList.remove("open");
  });

  toggleGetInvolved.addEventListener("click", () => {
    getInvolvedItem.classList.toggle("open");
  });
</script>