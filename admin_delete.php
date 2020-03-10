<?php 
	require 'db/connect.php';
	$id = (isset($_GET['id']))?$_GET['id']:0;

	if($id!=0){
		$sql = "delete from complaint where id=$id";
		$db->query($sql);
				
	}
	header("location:admin.php");

?>