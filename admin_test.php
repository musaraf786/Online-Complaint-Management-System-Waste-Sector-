<?php 
	require 'db/connect.php';
	$id = (isset($_GET['id']))?$_GET['id']:0;

	if($id!=0){
		$sqlp = "select phoneno from complaint where id=$id";
	    $sql = "delete from complaint where id=$id";
		
		$result = $db->query($sqlp);
//		$sql = "select * from complaint where id=$id";
	//$result = $db->query($sql);
	    $row = $result->fetch_assoc();
         

//          print $row['phoneno']; 	 
	
$number=$row['phoneno'];
$text="Your complaint has been serviced";
	
$url="https://www.sms4india.com/api/v1/sendCampaign";
$message = urlencode("$text");// urlencode your message
$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=Q3M1MXIZW6FBEILD3YSJYPN1ZMY2Z971&secret=TA7ZPO9I1ZJPZLN4&usetype=stage&phone=$number&senderid=musarafmulla999@gmail.com&message=$message");// post data
// query parameter values must be given without squarebrackets.
 // Optional Authentication:
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
//echo $result;

  $db->query($sql);
	
	}
	header("location:admin.php");

?>


  
