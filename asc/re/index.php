<?php
//index.php

$message = '';

function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

if(isset($_POST["submit"]))
{
	$programming_languages = '';
	foreach($_POST["programming_languages"] as $row)
	{
		$programming_languages .= $row . ', ';
	}
	$programming_languages = substr($programming_languages, 0, -2);
	$path = 'upload/' . $_FILES["resume"]["name"];
	move_uploaded_file($_FILES["resume"]["tmp_name"], $path);
	$message = '
		<h3 align="center">RMC Details</h3>
		<table border="1" width="100%" cellpadding="5" cellspacing="5">
			<tr>
				<td width="30%">Name</td>
				<td width="70%">'.$_POST["name"].'</td>
			</tr>
			<tr>
				<td width="30%">Email Address</td>
				<td width="70%">'.$_POST["email"].'</td>
			</tr>
			<tr>
				<td width="30%">location</td>
				<td width="70%">'.$programming_languages.'</td>
			</tr>
			
			<tr>
				<td width="30%">Additional Information</td>
				<td width="70%">'.$_POST["additional_information"].'</td>
			</tr>
		</table>
	';
	require 'phpmailer/PHPMailerAutoload.php';
	require 'class/class.phpmailer.php';
	require 'class/class.smtp.php';
	
	$mail = new PHPMailer();
	$mail->isSMTP();								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = 465;								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'hackathon456@gmail.com';	    //Sets SMTP username
	$mail->Password = 'team0050';					//Sets SMTP password
	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	//$mail->From = $_POST["email"];					//Sets the From email address for the message
	//$mail->FromName = $_POST["name"];				//Sets the From name of the message
	$mail->setFrom('hackathon456@gmail.com', 'Admin RMC');
	$mail->AddAddress($_POST["email"]);		        //Adds a "To" address
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML
	$mail->AddAttachment($path);					//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Application for RMC';				//Sets the Subject of the message
	$mail->Body = $message;							//An HTML or plain text message body
	if($mail->Send())								//Send an Email. Return true on success or false on error
	{
		$message = '<div class="alert alert-success">Application Successfully Submitted</div>';
		unlink($path);
	}
	else
	{
		$message = '<div class="alert alert-danger">There is an Error</div>';
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<!--<title>Send Email with Attachment in PHP using PHPMailer</title>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<div class="row">
				<div class="col-md-8" style="margin:0 auto; float:none;">
					<h3 align="center">Send Email with Attachment in PHP using PHPMailer</h3>
					<br />
					<h4 align="center">Admin work Here</h4><br />
					<?php print_r($message); ?>
					<form method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Enter Name</label>
									<input type="text" name="name" placeholder="Enter Name" class="form-control" required />
								</div>
			
								<div class="form-group">
									<label>Enter Email Address</label>
									<input type="email" name="email" class="form-control" placeholder="Enter Email Address" required />
								</div>
								<div class="form-group">
									<label>Select Location</label>
									<select name="programming_languages[]" class="form-control" multiple required style="height:150px;">
										<option value=".Location1">Location-1</option><option value="Location-2">Location-2</option><option value="Location-3">Location-3</option>
										
										
									</select>
								</div>
								
								<div class="form-group">
									<label>cleanest image</label>
									<input type="file" name="resume" accept=".png,.PNG,.JPEG,.jpg,.jpeg" required />
								</div>
								<div class="form-group">
									<label>Enter Additional Information</label>
									<textarea name="additional_information" placeholder="Enter Additional Information" class="form-control" required rows="8"></textarea>
								</div>
							</div>
						</div>
						<div class="form-group" align="center">
							<input type="submit" name="submit" value="Submit" class="btn btn-info" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>





