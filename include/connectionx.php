<?php
	
	if (isset($connectX) && !isset($dbh)) {
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname='ohfwebsite';
		$dbh = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		// if (!$dbh) {
		// 	die("Connection failed:" . mysqli_connect_error());
		// }
		if ($dbh->connect_error) {
			die("Connection failed: " . $dbh->connect_error);
		}
       
	}

?>