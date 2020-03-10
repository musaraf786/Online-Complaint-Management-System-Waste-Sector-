<?php
	session_start();
	include("db/connect.php");
	$username= $_POST['username'];
	$password= $_POST['password'];
	$rememberme = isset($_POST["rememberme"])?$_POST["rememberme"]:"";
	//$rememberme = $_POST["rememberme"];
	
	$sql = "select * from admin1 where username='$username' and password='$password'";
	$result = $db->query($sql);
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$username = $row['username'];
	
		$_SESSION["username"] = $username;
		
		
		if($rememberme == "on"){
			setcookie("username",$username,time()+ 60 ); // 86400 = 1 day
			setcookie("password",$password,time()+ 60 ); // 86400 = 1 day
		}else{
			setcookie("username",$username,time()- 60 ); // 86400 = 1 day
			setcookie("password",$password,time()- 60 );
		}
		
		header("location:dashboard.php");
	}else{
		header("location:login.php?errno=202");
	}
	
?>