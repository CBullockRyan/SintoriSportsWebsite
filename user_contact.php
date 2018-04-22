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
	<?php include ('nav.inc.php');

	//vars for enquiry form
	$fname="";
	$lname="";
	$phone="";
	$email="";
	$subject="";
	$message="";

	// connect to database
	require ('connectDB.php');

	//query to get all information for location
	$q = "SELECT * FROM location";
	$r = @mysqli_query($dbc, $q);
	$row=mysqli_fetch_array($r);

	//make contact vars
	$mt_open=$row['mon_thurs_open'];
	$mt_close=$row['mon_thurs_close'];
	$fs_open=$row['fri_sat_open'];
	$fs_close=$row['fri_sat_close'];
	$Lphone=$row['phone'];
	$Lemail=$row['email'];
	$Laddress=$row['address'];

	//display top part of page with contact Details
	echo "<h1>Contact Us</h1>";
	echo "<h2>Opening Hours</h2>";
	echo "<p>Monday-Thursday $mt_open - $mt_close</p>";
	echo "<p>Friday-Saturday $fs_open - $fs_close</p>";
	echo "<h2>Contact Details</h2>";
	echo "<p><b>Phone: </b>$Lphone</p>
				<p><b>Address: </b>$Laddress</p>
				<p><b>Email: </b>$Lemail</p";

	//if enquiry posted
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	} else{//print the form
		echo "<h2>Get in Touch</h2>";
		echo "<"
	}
?>
</body>

</html>
