<!--************************************************
Author: Cassidy Bullock
Date: April 22, 2018
Description: update a membership type
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Update Contact Info</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav_staff.inc.php');

	//connect to database
	require ('connectDB.php');

	//get location Details
	$q = "SELECT * FROM location";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);

	//create vars for changing contact Details
	$id=$row[0];
	$phone=$row[1];
	$address=$row[2];
	$email=$row[3];
	$mt_open=$row[4];
	$mt_close=$row[5];
	$fs_open=$row[6];
	$fs_close=$row[7];

	//if form submitted
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$errors=array();

		//check that form is filled out
		if(empty($_POST['phone'])){
			array_push($errors, "Please enter a phone number.");
		} else{
			$phone=trim($_POST['phone']);
		}
		if(empty($_POST['address'])){
			array_push($errors, "Please enter an address.");
		} else{
			$address=trim($_POST['address']);
		}
		if(empty($_POST['email'])){
			array_push($errors, "Please enter an email address.");
		} else{
			$email=trim($_POST['email']);
		}
		if(empty($_POST['mt_open'])){
			array_push($errors, "Please enter an opening time for Mon-Thurs.");
		} else{
			$mt_open=trim($_POST['mt_open']);
		}
		if(empty($_POST['mt_close'])){
			array_push($errors, "Please enter a closing time for Mon-Thurs.");
		} else{
			$mt_close=trim($_POST['mt_close']);
		}
		if(empty($_POST['fs_open'])){
			array_push($errors, "Please enter an opening time for Fri-Sat.");
		} else{
			$fs_open=trim($_POST['fs_open']);
		}
		if(empty($_POST['fs_close'])){
			array_push($errors, "Please enter a closing time for Fri-Sat.");
		} else{
			$fs_close=trim($_POST['fs_close']);
		}

		//make variables readable for sql
		$phone = mysqli_real_escape_string($dbc, trim($phone));
		$address = mysqli_real_escape_string($dbc, trim($address));
		$email = mysqli_real_escape_string($dbc, trim($email));
		$mt_open = mysqli_real_escape_string($dbc, trim($mt_open));
		$mt_close = mysqli_real_escape_string($dbc, trim($mt_close));
		$fs_open = mysqli_real_escape_string($dbc, trim($fs_open));
		$fs_close = mysqli_real_escape_string($dbc, trim($fs_close));

		//check there are no errors
		if(empty($errors)){
			//update information
			$q = "UPDATE location SET phone='$phone', address='$address', email='$email', mon_thurs_open='$mt_open', mon_thurs_close='$mt_close', fri_sat_open='$fs_open', fri_sat_close='$fs_close'
			WHERE locationID=$id LIMIT 1";
			$r = @mysqli_query($dbc, $q);

			//check that it ran
			if($r){
				echo "<h2>Details Successfully Updated </h2>";
			} else{ //system error
				echo '<p class="error">The contact details could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				//echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
		} else{ // display errors
			foreach($errors as $error){
				echo "<font color=\"red\">ERROR: $error </font><br/>";
			}
		}

	} else{ //create form
			echo "<h1>Contact Details and Opening Hours</h1>";
			echo "<form action='location_update.php' method='post' >
			<p>Phone: <input class='col-3 form-control' type='text' name='phone' value='$phone' /></p>
			<p>Address: <input class='col-3 form-control' type='text' name='address' value='$address' /></p>
			<p>Email: <input class='col-3 form-control' type='email' name='email' value='$email' /></p>
			<p>Monday-Thursday Opening Time: <input class='col-3 form-control' type='time' name='mt_open' value='$mt_open' /></p>
			<p>Monday-Thursday Closing Time: <input class='col-3 form-control' type='time' name='mt_close' value='$mt_close' /></p>
			<p>Friday-Saturday Opening Time: <input class='col-3 form-control' type='time' name='fs_open' value='$fs_open' /></p>
			<p>Friday-Saturday Closing Time: <input class='col-3 form-control' type='time' name='fs_close' value='$fs_close' /></p>
			<p><input class='btn btn-outline-info' type='submit' name='Submit' value='submit' /></p>";
	}
  ?>
</body>

</html>
