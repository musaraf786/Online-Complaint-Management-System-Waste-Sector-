<?php 
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
	$upload_flleextension = strtolower(end($temp_arr));
	$target_file = strtolower($upload_dir.$upload_filename);
	
	if($upload_filesize>(90000000)){
		echo "File size is more then 10000KB";
	}elseif($upload_flleextension!="jpg" && $upload_flleextension!="png" && $upload_flleextension!="jpeg" && $upload_flleextension!="JPG"){
		echo "File is not JPEG";
	}else{
			if(move_uploaded_file($_FILES["uploadphoto"]["tmp_name"],$target_file))
			{
				echo "The File ",$upload_filename." has been Uploads.";
			}
			else{
					echo "Sorry,These was on error uploading your file.";
			}
	}
	
	//Data Insert Query
	$sql="";
	if(isset($id) && $id!=""){
		$sql = "update complaint set name = '$name',phoneno='$phoneno',title='$target_file',address='$address',note='$note' where id=$id";
	}else{
		$sql = "insert into complaint (name,phoneno,title,address,note,mail) values('$name',$phoneno,'$target_file','$address','$note','$mail')";
	}
	

	$insert = $db->query($sql);
	header("location:thanks.php");
?>