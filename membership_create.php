<!--************************************************
Author: Cassidy Bullock
Date: April 4, 2018
Description: Create membership page, works with
             sql tables membership and membershipinfo
             and payment (initial payment is required).
             if single membership is selected it should
             not present option to add more members,
             if membership is family should have
             maximum of 5 members.
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>New Membership</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php'); ?>

	<h1>Add Membership</h1>
	<!-- form to create membership -->
	<form action="membership_create.php" method="post">
		<p>Membership Type: <select name="type">
			<option value="1">Single Membership</option>
			<option value="2">Family Membership</option>
			<option value="3">Couple Membership</option>
		</select></p>
		<p><input type="submit" name="Submit" value="submit" /></p>
</body>

</html>
