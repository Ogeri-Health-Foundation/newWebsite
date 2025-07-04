<?php
session_start();
?>
<?php

$page_title = "XYZ Page - Admin- Ogeri Health Foundation";

$page_author = "Your name here!";

$page_description = "";

$page_rel = '../';

$page_name = 'admin';

$customs = array(
    "stylesheets" => ["admin/assets/css/demo.css"],
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

    <?php include $page_rel . 'includes/head.php'; ?>

</head>

<body>


    <?php $page = ''; ?>
    <?php include $page_rel . 'admin/includes/topbar.php'; ?>



    <main class="main-content">

        <section class="container hero">
            <!------------------------->
            <!-- Hero stuffs go here -->
            <!------------------------->
        </section>


        <section class="meaningful-name-for-this-section">
            <!------------>
            <!-- Stuffs -->
            <!------------>
        </section>


        <section class="meaningful-name-for-this-section">
            <!------------>
            <!-- Stuffs -->
            <!------------>
        </section>

    </main>



    <?php include $page_rel . 'admin/includes/sidebar.php'; ?>

</body>

</html>