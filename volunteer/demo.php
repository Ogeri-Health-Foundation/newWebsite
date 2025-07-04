<?php
    session_start();
?>
<?php

    $page_title = "XYZ Page - Voluteers - Ogeri Health Foundation";

    $page_author = "Your name here!";

    $page_description = "";

    $page_rel = '../';

    $page_name = 'volunteer';

    $customs = array(
                "stylesheets" => ["volunteer/assets/css/demo.css"],
                "scripts" => ["volunteer/assets/js/demo.js"]
               );

    $addons = array(
                "stylesheets" => ["https://some-external-url.css"],
                "scripts" => ["https://some-external-url.js"]
               );

?>
<!DOCTYPE html>
<html>

<head>

    <?php include $page_rel.'includes/head.php'; ?>

</head>

<body>


    <?php include $page_rel.'includes/header.php'; ?>


    <main>

        <section class="hero">
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



    <?php include $page_rel.'includes/footer.php'; ?>

</body>

</html>