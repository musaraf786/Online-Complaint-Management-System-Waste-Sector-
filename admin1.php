<?php
session_start();
require "db/connect.php";
$search_value="";
	if(isset($_POST['search'])){
		$search_value=$_POST['search_value'];
		$sql="select * from complaint where name LiKE '%$search_value%' OR address LIKE '%$search_value%' OR phoneno LIKE '%$search_value%' OR mail LIKE '%$search_value%'";
	}
	  else{	
		    $sql="select * from complaint";	
	}
	$result = $db->query($sql);

?>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery.min.js"></script>
	
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
		<form method="post" action="admin1.php">	
				<div class="form-group"  align="right" >
					<input type="text"  width="200"  placeholder="Enter value to search" name="search_value"></input>
					<button type="submit"  name="search">Click to Search</button>
				</div>
			</form>

		<br/>
		<h2>Complain Dashboard</h2>
	<!--	<a href="books_form.php" align="right" class="success button">Insert New Record</a> -->
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
			if($result = $db->query("select * from complaint")){
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

			}
			?>
		</table>
	</div>
</body>
<!--.$_SESSION['first_name'];-->
</html>