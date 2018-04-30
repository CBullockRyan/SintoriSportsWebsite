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
	echo "<div class='jumbotron'><h1>Contact Us</h1>";
	echo "<h2>Opening Hours</h2>";
	echo "<p>Monday-Thursday $mt_open - $mt_close</p>";
	echo "<p>Friday-Saturday $fs_open - $fs_close</p>";
	echo "<h2>Contact Details</h2>";
	echo "<p><b>Phone: </b>$Lphone</p>
				<p><b>Address: </b>$Laddress</p>
				<p><b>Email: </b>$Lemail</p>";

	//if enquiry posted
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$errors=array();

		//make sure form is filled out
		if(empty($_POST['fname'])){
			array_push($errors, "Please enter the your first name.");
		}
		else{
			$fname=htmlspecialchars(trim($_POST['fname']));
		}
		if(empty($_POST['lname'])){
			array_push($errors, "Please enter the your last name.");
		}
		else{
			$lname=htmlspecialchars(trim($_POST['lname']));
		}
		if(empty($_POST['phone'])){
			array_push($errors, "Please enter the your contact number.");
		}
		else{
			$phone=htmlspecialchars(trim($_POST['phone']));
		}
		if(empty($_POST['email'])){
			array_push($errors, "Please enter the your contact email.");
		}
		else{
			$email=htmlspecialchars(trim($_POST['email']));
		}
		if(empty($_POST['subject'])){
			array_push($errors, "Please enter the subject of your enquiry.");
		}
		else{
			$subject=htmlspecialchars(trim($_POST['subject']));
		}
		if(empty($_POST['message'])){
			array_push($errors, "Please record your enquiry.");
		}
		else{
			$message=htmlspecialchars(trim($_POST['message']));
		}

		//make all variables readable by sql
		$fname = mysqli_real_escape_string($dbc, trim($fname));
		$lname = mysqli_real_escape_string($dbc, trim($lname));
		$phone = mysqli_real_escape_string($dbc, trim($phone));
		$email = mysqli_real_escape_string($dbc, trim($email));
		$subject = mysqli_real_escape_string($dbc, trim($subject));
		$message = mysqli_real_escape_string($dbc, trim($message));

		//check errors are empty before sending Email
		if(empty($errors)){
			//code to email form... won't work because there is no email server
			$msg=wordwrap($message,70);
			$header="From: $email";
			mail($Lemail, $subject, $msg, $header);

			//record non-member Details
			$q = "INSERT INTO nonmember (fname, lname, email, phone) VALUES ('$fname', '$lname', '$email', '$phone')";
			$r = @mysqli_query($dbc, $q);

			//get nonmember ID
			$nmID = mysqli_insert_id($dbc);

			//check that query ran
			if($r){
				//add enquiry to database since email would not work.
				$q = "INSERT INTO enquiry (subject, enquiryComment, nonmemberID) VALUES ('$subject', '$message', '$nmID')";
				$r = @mysqli_query($dbc, $q);

				//check that it ran Successfully
				if($r){
					echo "<h2>Enquiry Sent</h2>
					<p>Thank you for sending in your enquiry. We will get back to you soon.</p>";
				} else{ //system error
					echo '<h2>System Error</h2>
					<p class="error">Your enquiry could not be submitted due to system error. We apologize for any inconvenience.</p>';
					//debugging message
					//echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q . '</p>';
				}
			} else{ //system error
				echo '<h2>System Error</h2>
				<p class="error">Your enquiry could not be submitted due to system error. We apologize for any inconvenience.</p>';
				//debugging message
				//echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q . '</p>';
			}
		} else{ //display the errors
			foreach($errors as $error){
				echo "<font color=\"red\">ERROR: $error </font><br/>";
			}
		}
	} else{//print the form
		echo "<h2>Get in Touch</h2>";
		echo "<form action='user_contact.php' method='post' id='enquiry'>
		<p>First Name: <input class='col-3 form-control' type='text' name='fname' value='$fname' /></p>
		<p>Last Name: <input class='col-3 form-control' type='text' name='lname' value='$lname' /></p>
		<p>Phone: <input class='col-3 form-control' type='text' name='phone' value='$phone' /></p>
		<p>Email: <input class='col-3 form-control' type='email' name='email' value='$email' /></p>
		<p>Subject: <input class='col-3 form-control' type='text' name='subject' value='$subject' /></p>
		<p>Message: </p>
    <p><textarea class='col-8 form-control' name='message' form='enquiry' rows='4' cols='40'>$message</textarea></p>
		<p><input class='btn btn-outline-info' type='submit' name='Submit' value='submit' /></p></div>";
	}
	//disconnect from database
	mysqli_close($dbc);

	exit();
?>
</body>

</html>
