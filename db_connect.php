<?php
	$db_hostname='localhost';
	$db_username='root';
	$db_password='';
	$db_name='majid_db';
	// Create connection
	//using @ in the beginning of mysqli_connect will show only my die msg not the error
	$db_connect = @mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
	// Check connection
	if (!$db_connect) {
  	die("Connection failed");// . mysqli_connect_error());
	}
	mysqli_set_charset($db_connect, "utf8");
	date_default_timezone_set('Asia/Muscat'); //set time zone
?>
