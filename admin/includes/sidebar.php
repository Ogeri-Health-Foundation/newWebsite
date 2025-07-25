<!-- Sidebar code goes here -->
<?php

function active($bar)
{
    global $page;
    if ($page == $bar) {
        echo ' current';
    }
}

?>


<link rel="stylesheet" href="<?php echo $page_rel; ?>admin/assets/css/sidebar.css">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper (must be after jQuery if used) 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
<style>
    /* main {
    padding: 90px 0px;
	padding-left: var(--w)!important;
    overflow-y: none;
   
    background-color: #FBFFFE;
} */
</style>


<!-- <aside id="sidebar" class="bg-white p-4 d-none d-lg-block">

    <nav class="navbar pt-4"> 

        <ul class="navbar-nav gap-4 w-100 px-4">

            <li class="nav-item">
                <a href="<?php echo $page_rel; ?>admin/dashboard" class="nav-link<?php active('dashboard'); ?>">
                    <img src="<?php echo $page_rel; ?>admin/assets/images/sidebar/dashboard.png" alt="">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $page_rel; ?>admin/users/listing" class="nav-link<?php active('users'); ?>">
                    <img src="<?php echo $page_rel; ?>admin/assets/images/sidebar/users.png" alt="">
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $page_rel; ?>admin/properties/listing" class="nav-link<?php active('properties'); ?>">
                    <img src="<?php echo $page_rel; ?>admin/assets/images/sidebar/properties.png" alt="">
                    Properties
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $page_rel; ?>admin/transactions/listing" class="nav-link<?php active('transactions'); ?>">
                    <img src="<?php echo $page_rel; ?>admin/assets/images/sidebar/transactions.png" alt="">
                    Transactions
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $page_rel; ?>messenger/chatroom" class="nav-link<?php active('reports'); ?>">
                    <img src="<?php echo $page_rel; ?>admin/assets/images/sidebar/report.png" alt="">
                    Reports
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo $page_rel; ?>messenger/chatroom" class="nav-link<?php active('support'); ?>">
                    <img src="<?php echo $page_rel; ?>admin/assets/images/sidebar/support.png" alt="">
                    Support
                </a>
            </li>

        </ul>

    </nav>

</aside> -->

<aside class="sidebar-left" id="sidebar">
    <div class="sidebar d-flex flex-column">
        <a href="<?php echo $page_rel; ?>admin/index.php"><i class="fas fa-home"></i> <span>Dashboard</span></a>
        <a href="<?php echo $page_rel; ?>admin/resources.php"><i class="fas fa-folder"></i> <span>Resources</span></a>
        <a href="<?php echo $page_rel; ?>admin/volunteer/volunteers.php"><i class="fa fa-user"></i>
            <span>Volunteer</span></a>
        <a href="<?php echo $page_rel; ?>admin/donations.php"><i class="fa fa-file"></i> <span>Donations</span></a>
        <a href="<?php echo $page_rel; ?>admin/partnership/partnership.php"><i class="fa fa-users"></i>
            <span>Partnership</span></a>
        <a href="<?php echo $page_rel; ?>admin/events.php"><i class="fa fa-calendar"></i> <span>Events</span></a>
        <a href="<?php echo $page_rel; ?>admin/contacts.php"><i class="fa fa-calendar"></i> <span>Contacts</span></a>
        <a href="<?php echo $page_rel; ?>admin/subcribers.php"><i class="fa fa-book"></i> <span>Subscribers</span></a>
        <hr class="my-2 hr" />
        <a href="#"><i class="fas fa-cog"></i> <span>Settings</span></a>
        <a href="#" class="text-danger" onclick="logoutUser(this)"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
    </div>
</aside>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
  <div id="logout-toast" class="toast align-items-center text-bg-success border-0 shadow" style="max-width: 300px;" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="logout-toast-message">
        Logged out successfully.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const sidebarLinks = document.querySelectorAll(".sidebar a");

        // Get the current page without query parameters
        const currentPage = window.location.pathname.split("/").pop();

        sidebarLinks.forEach((link) => {
            const linkHref = link.getAttribute("href");

            // Ignore links with href="#"
            if (!linkHref || linkHref === "#") return;

            // Extract file name from the link
            const linkPath = new URL(linkHref, window.location.origin).pathname.split("/").pop();

            // Remove 'active' from all links
            link.classList.remove("activee");

            // Assign 'active' if the current page matches the link
            if (currentPage === linkPath) {
                link.classList.add("activee");
            }
        });
    });
</script>
<script>
  let logoutInProgress = false;

  function logoutUser(el) {
    if (logoutInProgress) return;

    logoutInProgress = true;

    // Show spinner on the button/link
    const originalHTML = el.innerHTML;
    el.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Logging out...`;

    fetch("../api/v1/logout.php")
      .then(response => response.json())
      .then(data => {
        // Show Bootstrap toast
        const toastEl = document.getElementById('logout-toast');
        const toastMsg = document.getElementById('logout-toast-message');
        toastMsg.textContent = data.message || "Logout successful.";
        const toast = new bootstrap.Toast(toastEl);
        toast.show();

        setTimeout(() => {
          window.location.href = "../admin/login.php";
        }, 2000);
      })
      .catch(err => {
        console.error("Logout failed:", err);
        const toastEl = document.getElementById('logout-toast');
        const toastMsg = document.getElementById('logout-toast-message');
        toastMsg.textContent = "Logout failed. Please try again.";
        toastEl.classList.replace("text-bg-success", "text-bg-danger");
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
        setTimeout(() => {
          window.location.href = "../admin/login.php";
        }, 2500);
      })
      .finally(() => {
        el.innerHTML = originalHTML;
      });
  }
</script>