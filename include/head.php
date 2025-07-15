<?php

	date_default_timezone_set('Africa/Lagos');

	$company_name = "Ogeri Health Foundation"; // Your company name
    $bare_domain = "ogerihealthfoundation.com";

    $domain = "https://$bare_domain/";
	$banner_image = $domain . "assets/images/logo.png";

	$page_url = $domain . $page_name;

	if (isset($deeper_page_rel)) {
		$real_page_rel = $page_rel;
		$page_rel = $deeper_page_rel;
	}


	function isHeadValidUrl($url) {
		return filter_var($url, FILTER_VALIDATE_URL);
	}

?>


    <meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="<?php echo $page_author; ?>" name="author">
    <meta name="description" content="Ogeri Health Foundation - A non-government organization that is committed to improving the health and well-being of the people in the rural communities of Nigeria.">
    <meta name="keywords" content="Ogeri Health Foundation, Ogeri, Health, Foundation, NGO, Non-governmental organization, Nigeria, Rural, Communities, Health and well-being">
    
    <meta name="robots" content="INDEX,FOLLOW">
    <title><?php echo $page_title; ?></title>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory --> 
    <!-- <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicons/apple-icon-60x60.png"> 
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicons/apple-icon-72x72.png">
   <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicons/apple-icon-76x76.png"> 
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png"> -->
    <link rel="manifest" href="assets/img/favicons/manifest.json"> 
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/img/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta content="<?php echo $page_title; ?>" property="og:title">
	<meta content="<?php echo $page_description; ?>" property="og:description">
	<meta content="<?php echo $banner_image; ?>" property="og:image">
	<meta content="<?php echo $page_url; ?>" property="og:url">
	<meta content="website" property="og:type">

    <!-- Twitter Card meta tags for Twitter sharing -->
	<meta content="<?php echo $banner_image; ?>" name="twitter:card">
	<meta content="<?php echo $page_title; ?>" name="twitter:title">
	<meta content="<?php echo $page_description; ?>" name="twitter:description">
	<meta content="<?php echo $banner_image; ?>" name="twitter:image">
    
    <link href="assets/img/favicon.svg" rel="icon" />

    <!--==============================
	  Google Fonts
	============================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/magnific-popup.min.css">
    <!-- datetimepicker -->
    <link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/jquery.datetimepicker.min.css">
    <!-- Swiper Js -->
    <link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/swiper-bundle.min.css">
    <!-- Theme Custom CSS -->
   
    <link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/footer.css"> 
    <link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/header.css">
    <!-- <link rel="stylesheet" href="./assets/css/footer2.css"> -->
   <!-- <link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/index2.css">  -->
    <!-- <link rel="stylesheet" href="./assets/css/contactUs.css"> -->
    <!-- <link rel="stylesheet" href="./assets/css/events.css" /> -->
    <!-- <link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/donations.css" /> -->
    <!-- <link rel="stylesheet" href="./assets/css/volunteer-details.css"> -->
    <!-- <link rel="stylesheet" href="./assets/css/partnership.css"> -->
     <link rel="stylesheet" href="<?php echo $page_rel; ?>assets/css/style.css">
     <!-- Font Awesome 6 (CDN link) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

     <!-- <script
        src="https://kit.fontawesome.com/47c9f80a38.js"
        crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <?php
		if(isset($addons)) {
			foreach ($addons["stylesheets"] as $x) 	{ echo '<link href="'.(isHeadValidUrl($x) ? $x : $page_rel.$x).'" rel="stylesheet">'; }
			foreach ($addons["scripts"] as $x) 		{ echo '<script src="'.(isHeadValidUrl($x) ? $x : $page_rel.$x).'"></script>'; }
		}
	?>





	<!-- Other Custom Files -->
	<?php
		if(isset($customs)) {
			foreach ($customs["stylesheets"] as $x) { echo '<link href="'.(isHeadValidUrl($x) ? $x : $page_rel.$x).'" rel="stylesheet">'; }
			foreach ($customs["scripts"] as $x) 	{ echo '<script src="'.(isHeadValidUrl($x) ? $x : $page_rel.$x).'"></script>'; }
		}
	?>


	<?php
		if (isset($deeper_page_rel)) {
			$page_rel = $real_page_rel;
		}
	?>
    