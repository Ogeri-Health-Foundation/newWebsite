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
        <a href="<?php echo $page_rel; ?>admin/contact.php"><i class="fa fa-calendar"></i> <span>Contacts</span></a>
        <hr class="my-2 hr" />
        <a href="#"><i class="fas fa-cog"></i> <span>Settings</span></a>
        <a href="#" class="text-danger"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
    </div>
</aside>

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