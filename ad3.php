<?php
    require("db/connect.php");
	$search_value="";
	if(isset($_POST['search'])){
		$search_value=$_POST['search_value'];
		$sql="select * from complaint where title LiKE '%$search_value%' OR name LIKE '%$search_value%' OR phoneno LIKE '%$search_value%' OR author LIKE '%$search_value%' OR id LIKE '%$search_value%' OR titleurl LIKE '%$search_value%' OR  pendingstock LIKE '%$search_value%' OR datetime LIKE '%$search_value%'";
	}
	else{	
		$sql="select * from complaint";	
	}
	$result = $db->query($sql);
?> 
<html>
	<head>
        <title>Book Management</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery1.min.js" rel="stylesheet" text="text/javascript"></script>
		
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="index.php">Library Management</a>
			<div class="collapse navbar-collapse" id="navbarColor01">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="books.php">Books</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" >Issue</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" >Users</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" >Logout</a>
					</li>
				</ul>
			</div>
			<span style="float:right;color:white"><b> : TESTING CONTINUOUS</b></span>
		</nav>	
		<div class="container">
			<br>
			<h2>Book Management</h2>
			<form method="post" action="ad3.php">
				<div class="form-group"  align="right" >
					<input type="text"  width="200"  placeholder="Enter value to search" name="search_value"></input>
					<button type="submit"  name="search">Click to Search</button>
				</div>
			</form>
			<table  class="table">
				<tr>
					<th>Image</th>
				<th>Address</th>
				<th>Name</th>
				<th>phoneno</th>
			    <th>Mail</th> 
			<!--	<th>Time</th> -->
			     <th>note</th>
				<th>Action</th>
			
				</tr>
                <?php
			if($result = $db->query("select * from complaint")){
				if($result->num_rows){
					while($row = $result->fetch_assoc()){
						?>
						