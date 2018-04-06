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
		<p>First Name: <input type="text" name="fname" value="<?php echo $fname ?>" /></p>
		<p>Last Name: <input type="text" name="lname" value="<?php echo $lname ?>" /></p>
		<p>Mobile Phone: <input type="text" name="phone" value="<?php echo $phone ?>" /></p>
		<p>Email: <input type="email" name="email" value="<?php echo $email ?>" /></p>
		<p>Date of Birth: <input type="date" name="dob" value="<?php echo $DoB ?>" /></p>
		<p>Gender: </p>
		<p><input type="radio" name="gender" value="male" <?php if($gender=="male"){echo " checked=\"checked\" ";} ?> /> Male</p>
		<p><input type="radio" name="gender" value="female" <?php if($gender=="female"){echo " checked=\"checked\" ";} ?> /> Female</p>
		<p>Payment: <input type="number" min="0.00" max="10000.00" step="0.01" name="payment" value="<?php echo $payment ?>" /></p>
		<p><input type="submit" name="Submit" value="submit" /></p>
</body>

</html>
