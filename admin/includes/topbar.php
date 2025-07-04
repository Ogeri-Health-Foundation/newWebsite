
<!-- Topbar -->

<?php
	if (isset($deeper_page_rel)) {
		$real_page_rel = $page_rel;
		$page_rel = $deeper_page_rel;
	}
?>



<link rel="stylesheet" href="<?php echo $page_rel; ?>admin/assets/css/topbar.css">
<style>
  .badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: red;
      color: white;
      border-radius: 50%;
      width: 18px;
      height: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 600;
    }

    svg {
      width: 20px;
      height: 20px;
    }
</style>


<nav class="navbar d-flex align-items-center justify-content-between ">
      <!-- Logo -->
      <div class="logo d-flex align-items-center">
        <img
          src="<?php echo $page_rel; ?>admin/assets/images/login/name-logo.svg"
          alt="Ogeri Health Foundation"
        />
      </div>

      <!-- Search Bar -->
      <div class="input-group search-bar">
        <span class="input-group-text">
          <img src="<?php echo $page_rel; ?>admin/assets/images/includes/Left Icon.svg" alt="" />
        </span>
        <input
          type="text"
          class="form-control"
          placeholder="Search any keywords"
        />
        <span class="input-group-text">
          <img src="<?php echo $page_rel; ?>admin/assets/images/includes/Right Icon.svg" alt="" />
        </span>
      </div>

      <!-- User Section -->
      <div class="user-info">
        <span class="notification" style="position: relative; cursor: pointer;" onclick="redirectAdmin()">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.5 19H8C4 19 2 18 2 13V8C2 4 4 2 8 2H16C20 2 22 4 22 8V13C22 17 20 19 16 19H15.5C15.19 19 14.89 19.15 14.7 19.4L13.2 21.4C12.54 22.28 11.46 22.28 10.8 21.4L9.3 19.4C9.14 19.18 8.77 19 8.5 19Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M15.9965 11H16.0054" stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.9955 11H12.0045" stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.99451 11H8.00349" stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

<span id="badge" class="badge"></span>
        </span>
        <div class="dropdown">
          <button
            class="btn dropdown-toggle d-flex align-items-center"
            type="button"
            data-bs-toggle="dropdown"
          >
            <div class="user-avatar">PO</div>
            <div class="ms-2 name-div">
              <span class="d-block">Patricia Oko</span>
              <small class="text-muted"
                ><span class="mx-2"
                  ><img src="<?php echo $page_rel; ?>admin/assets/images/includes/dot.svg" alt="" /></span
                >Super Admin</small
              >
            </div>
            <i class="fas fa-chevron-down ms-2"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>


<?php
	if (isset($deeper_page_rel)) {
		$page_rel = $real_page_rel;
	}
?>
 <script>
      const sidebarLinks = document.querySelectorAll(".sidebar a");

      // Get current page URL
      const currentPage = window.location.pathname.split("/").pop();

      sidebarLinks.forEach((link) => {
        // Extract the link href value
        const linkHref = link.getAttribute("href");

        // Check if the link matches the current page
        if (currentPage === linkHref) {
          // Remove active class from all links
          sidebarLinks.forEach((l) => l.classList.remove("active"));

          // Add active class to the current link
          link.classList.add("active");
        }
      });

      function redirectAdmin(){
      location.href = "message-admin.php";
    }

    </script>

<script>

window.onload = function () {

  const Badge = document.getElementById("badge");

fetch("http://localhost/ohfWebsite/api/v1/getMessageCount.php")
.then(async response => {
  const data = await response.json(); 
  message = data.message;
  Badge.textContent = message;

 

  console.log("Auth Data:", data);
  return data;
})
.catch(error => {
  console.error("Fetch error:", error);
});


};


</script>
