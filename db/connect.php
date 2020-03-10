<?php
	$db = new mysqli('localhost','root','','rmc');
	date_default_timezone_set("Asia/Kolkata");
	if($db->connect_errno){
		echo $db->connect_error;
		die('Sorry, Database connection error. ');
	}
 ?>

 
