<?php
session_start();
require "db/connect.php";

/*if(!isset($_SESSION["username"]) && $_SESSION["username"]==null){
	header("location:login.php");
}
$username= $_SESSION["username"];
$currentdate = date('d/m/Y H:i:s');
setcookie("lastdate",$currentdate,time()+60);*/

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
							<?php echo "Welcome, ".$_SESSION['first_name'];?>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<br>
			</div>
		</div>
	</div>
</body>

</html>