<?php
	//error_reporting(0);
	require 'db/connect.php';
	$id = (isset($_GET['id']))?$_GET['id']:0;
	
	if($id!=0){
		$sqlp = "select mail from complaint where id=$id";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register</title>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<?php include("nav1.php"); ?>
		<div class="container">
		<br>
			<form action="com_save.php" method="post" id="clientform" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
				<div class="form-group">
					<label for="title">Name :</label>
					<input type="text" class="form-control" " id="name" placeholder="Enter your Name" name="name" required>
				</div>
				<div class="form-group">
					<label for="author">E-Mial :</label>
					<input type="Mail" class="form-control"  id="mail" value="<?php echo $row['mail'];?>" placeholder="Enter your Phone no" name="phoneno" require>
				</div>
		
				
				<div class="form-group">
					<label for="stock">Upload photo</label>
					<input type="file" class="form-control" id="uploadphoto" name="uploadphoto" required>
				</div>
				
				<div class="form-group">
					<label for="stock">Address :</label>
					<br>
					<select name="cars">
						<option value="location1">Near RMC Ward office, Amar nagar Main Road</option>
						<option value="location2">Vaniyawadi Main Road</option>
						<option value="location3">Royal Complex, Dhebar Road</option>
						<option value="location4">Malaviya Nagar Main Road</option>
					</select>
					</div>
				
				<button type="submit" class="btn btn-primary" name="submit">Submit</button>
				<button type="button" class="btn btn-default" onClick="history.back()">Cancel</button>
			</form>
		</div>
	</body>
</html>
<?php 
	
	if(isset($_POST['submit'])){
			
	session_start();
	require "db/connect.php";

	$name = $_POST['name'];
	$phoneno = $_POST['phoneno'];
	$address = $_POST['address'];
	$mail = $_POST['mail'];
	$note = $_POST['note'];
	$id = $_POST['id'];
	
	//File Upload Code
	$upload_dir = "upload/";
	$upload_filename = basename($_FILES["uploadphoto"]["name"]);
	$upload_filesize = $_FILES["uploadphoto"]["size"];
	
	$temp_arr = explode(".",$upload_filename);
	$upload_fileextension = strtolower(end($temp_arr));
	$target_file = strtolower($upload_dir.$upload_filename);
	
	if($upload_filesize>(90000000)){
		echo "File size is more then 100KB";
	}elseif($upload_fileextension!="jpg" && $upload_fileextension!="png" && $upload_fileextension!="jpeg" && $upload_fileextension!="JPG"){
		echo "File is not JPEG";
	}else{
		if(move_uploaded_file($_FILES["uploadphoto"]["tmp_name"],$target_file)){
				echo "The File ",$upload_filename." has been Uploads.";
			}
			else{
					echo "Sorry,These was on error uploading your file.";
			}
	}
	
	//Data Insert Query
	
	header("location:admin.php");
		}
		
?>