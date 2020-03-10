<?php
	session_start();
	include("db/connect.php");
	$username= $_POST['username'];
	$password= $_POST['password'];
	$rememberme = isset($_POST["rememberme"])?$_POST["rememberme"]:"";
		
	$sql = "select * from admin1 where username='$username' and password='$password'";
	$result = $db->query($sql);
	if($result->num_rows > 0){
		
		$row = $result->fetch_assoc();
		$username = $row['username'];
		$category = $row['category'];
		$first_name = $row['first_name'];
		
		$_SESSION["username"] = $username;
		$_SESSION["first_name"] = $first_name;
		$_SESSION["category"] = $category;
				
		//Cookie Code goes here
		$_COOKIE['lastdate']=$currentdate;
		
		header("location:admin.php");
	}else{
		header("location:login.php");
	}
	
?>