<?php
	session_start();
	require "db/connect.php";
	$search = "";
	if(isset($_POST['search'])){
		$search_value = $_POST['search_value'];
		$sql = "select * from complaint where name LIKE '%$search_value%' or phoneno LIKE '%$search_value%' or mail LIKE '%$search_value%' or address LIKE '%$search_value%' or note LIKE '%$search_value%' or id LIKE '%$search_value%' or title LIKE '%$search_value%'";
	}else{
		$sql = "select * from complaint";
	}
	$result = $db->query($sql);
?>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery.min.js"></script>
	<style>
</style>
</head>
<body>
	<?php include("nav.php"); ?>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-sm-12">
				<div class="text-white bg-primary">
					<div class="card-header">
						<h3>
							<?php echo "Welcome, Admin" ?>
						</h3>
					</div>
				</div>
			</div>
		</div>

		<br/>
		<h2>Complain Dashboard</h2>
	<!--	<a href="books_form.php" align="right" class="success button">Insert New Record</a> -->
		<form align="right" method="POST" action="admin.php">
			<input type="text" placeholder="type to search" name="search_value"/>
			<button name="search">Search</button>
		</form>
		<table  class="table">
			<tr>
			<!--	<th>ID</th> -->
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
			//if($result = $db->query("select * from complaint")){
				if($result->num_rows){
					while($row = $result->fetch_assoc()){
						?>
						<tr>
							
							<td><img src="<?=$row['title']?>" height="50px" width="75px"/></td>
							<td><?=$row['address']?></td>
							<td><?=$row['name']?></td>
							<td><?=$row['phoneno']?></td>
							<td><?=$row['mail']?></td>
							
							<td><?=$row['note']?></td>
						<td>
						    <a href="asc/re/index.php">Mail</a> /
							<a href="admin_test.php?id=<?php echo $row['id'];?>" onClick="return confirm('Are you Done with this?');">Done</a>
						</td>
						<?php

						echo '</tr>';
					}
				}

			//}
			?>
		</table>
	</div>
</body>
<!--.$_SESSION['first_name'];-->
</html>