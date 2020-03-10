<?php
	//error_reporting(0);
	require 'db/connect.php';
	$id = (isset($_GET['id']))?$_GET['id']:0;
	
	$sql = "select * from complaint where id=$id";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<?php include("nav1.php"); ?>
		<div class="container">
		<br>
		<h2>Report it</h2>
			<form action="com_save.php" method="post" id="clientform" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
				<div class="form-group">
					<label for="title">Your Name</label>
					<input type="text" class="form-control" value="<?php echo $row['name'];?>" id="name" placeholder="Enter your Name" name="name" required>
				</div>
				<div class="form-group">
					<label for="author">Phone No</label>
					<input type="text" class="form-control" value="<?php echo $row['phoneno'];?>" id="phoneno" placeholder="Enter your Phone no" name="phoneno">
				</div>
				
				<div class="form-group">
					<label for="author">Email</label>
					<input type="text" class="form-control" value="<?php echo $row['mail'];?>" id="mail" placeholder="Enter your mail" name="mail">
				</div>
		
				
				<div class="form-group">
					<label for="stock">Upload photo</label>
					<input type="file" class="form-control" id="uploadphoto" name="uploadphoto" required>
				</div>
				
				<div class="form-group">
					<label for="stock">Address</label>
					<input type="text" class="form-control" value="<?php echo $row['address'];?>" id="address" placeholder="Enter Location name" name="address" required>
				</div>
				
				<div class="form-group">
					<label for="stock">Note</label>
					<input type="text" class="form-control" value="<?php echo $row['note'];?>" id="note" placeholder="Enter Comment if any" name="note">
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
	$mail = $_POST['mail'];
	$address = $_POST['address'];
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
	$sql="";
	if(isset($id) && $id!=""){
		$sql = "update complaint set title = '$title',author='$author',price=$price,stock=$stock,titleurl='$target_file' where id=$id";
	}else{
		$sql = "insert into complaint (title,author,price,stock,titleurl,mail) values('$title','$author',$price,$stock,'$target_file','$mail')";
	}
	

	$insert = $db->query($sql);
	header("location:admin.php");
		}
		
?>