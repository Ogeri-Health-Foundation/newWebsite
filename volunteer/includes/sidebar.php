<!-- Sidebar -->
<?php

    function active($bar) {
        global $page;
        if ($page == $bar) {
            echo ' current';
        }
    }

?>


<link rel="stylesheet" href="<?php echo $page_rel; ?>property-owner/assets/css/includes/sidebar.css">


<aside id="sidebar" class="bg-white p-4 d-none d-lg-block">

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

</aside>

