<?php
	//error_reporting(0);
	require 'db\connect.php';
	$id = (isset($_GET['id']))?$_GET['id']:0;
	
	$sql = "select * from complaint where id=$id";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload-Photo</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>

<body>
<!-- ============================ COMPONENT REGISTER   ================================= -->
<div class="limiter">
<div class="container-login100" style="background-image: url('images/RKU.jpg');">
	<div class="wrap-login100">
		<article class="card-body">
			<header class="mb-4"><h4 class="card-title">Report it</h4></header>
			<form>
					<div class="form-row">
						<div class="col form-group">
							<label>First name</label>
							<input type="text" class="form-control" value="<?php echo $row['fname'];?>" id='fname' placeholder="" required>
						</div> <!--form-group end.-->
						
						<div class="col form-group">
							<label>Last name</label>
							<input type="text" class="form-control" placeholder="" required>
						</div> <!--form-group end. -->
					</div> <!--form-row end.-->
					
					<div class="form-row">
						<div class="form-group col-md-9">
							<label>phone No:</label>
							<input type="number_format" class="form-control" placeholder="" required>
						</div> <!--form-group end.--> 
					</div> <!--form-group end.-->
					
					<div class="form-row">
						<div class="form-group col-md-6 col-xs-6 col-sm-6">
							<label>Upload photo : </label>
								<input class="form-group" placeholder="Select pic" name="profile" type="file" required>
						</div>
						
					</div>
					
					<div class="form-row" required>
							<div class="form-group">
								<label>Address :</label>
								<textarea class="form-control" rows="3" placeholder=" Enter Address"></textarea>
							</div>
					</div>
					
					<div class="form-group">
						<label>Note :</label>
						<textarea class="form-control" rows="3" placeholder=" Enter Note"></textarea>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block"> Submit  </button>
					</div> <!--form-group.-->
			</form>
		</article> <!--card-body.-->
	</div> <!--card.-->
</div>
</div>
</body>
</html>

<?php 
		if(isset($_POST['submit'])){
			
	session_start();
	require "db/connect.php";

	$title = $_POST['title'];
	$author = $_POST['author'];
	$price = $_POST['price'];
	$stock = $_POST['stock'];
	$id = $_POST['id'];
	
	//File Upload Code
	$upload_dir = "upload/";
	$upload_filename = basename($_FILES["booktitle"]["name"]);
	$upload_filesize = $_FILES["booktitle"]["size"];
	
	$temp_arr = explode(".",$upload_filename);
	$upload_fileextension = strtolower(end($temp_arr));
	$target_file = strtolower($upload_dir.$upload_filename);
	
	if($upload_filesize>(90000000)){
		echo "File size is more then 100KB";
	}elseif($upload_fileextension!="jpg" && $upload_fileextension!="png" && $upload_fileextension!="jpeg" && $upload_fileextension!="JPG"){
		echo "File is not JPEG";
	}else{
		if(move_uploaded_file($_FILES["booktitle"]["tmp_name"],$target_file)){
				echo "The File ",$upload_filename." has been Uploads.";
			}
			else{
					echo "Sorry,These was on error uploading your file.";
			}
	}
	
	//Data Insert Query
	$sql="";
	if(isset($id) && $id!=""){
		$sql = "update books set title = '$title',author='$author',price=$price,stock=$stock,titleurl='$target_file' where id=$id";
	}else{
		$sql = "insert into books (title,author,price,stock,titleurl) values('$title','$author',$price,$stock,'$target_file')";
	}
	

	$insert = $db->query($sql);
	header("location:books.php");
		}
?>