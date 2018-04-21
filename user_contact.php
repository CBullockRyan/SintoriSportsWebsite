<!--************************************************
Author: Cassidy Bullock
Date: April 21, 2018
Description: View contact information and make enquiry
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Contact Us</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav.inc.php'); ?>

  <h1>Contact Us</h1>
  <div>
    <h2>Opening Hours</h2>
    <p>Monday-Thursday 7:00am - 10:00pm</p>
		<p>Friday-Saturday 9:00am - 8:00pm</p>
  </div>
	<div>
		<h2>Contact Details</h2>
		<p><b>Phone: </b>+1(503)555-7965</p>
		<p><b>Address: </b>22 Flowerly Ln, Salem, OR 97302</p>
		<p><b>Email: </b>enquiry@sintori.com</p>
	</div>
</body>

</html>
