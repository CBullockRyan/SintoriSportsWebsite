<!--************************************************
Author: Cassidy Bullock
Date: April 18, 2018
Description: register a member to an event
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Register for Event</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav.inc.php');

  // Check for a valid user ID, through GET or POST:
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From user_event_view.php
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has not been accessed correctly, please go back to the <a href=http://localhost/SintoriSportsWebsite/user_event_view.php>Events page</a> and select event to register for.</p>';
		exit();
	}

	//connect to database
	require ('connectDB.php');

	//get event
	$q = "SELECT title, eventDate FROM event WHERE eventID=$id";
	$r = @mysqli_query($dbc, $q);

	//get results
	$row = mysqli_fetch_array($r);

	//variable for form
	$mID="";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$errors = array();

		//check that form is filled out
		if(empty($_POST['mID'])){
			array_push($errors, "Please enter your member number to register. </br>");
		}
		else{
			//check if member number is already registered
			$q1 = "SELECT * FROM eventbooking WHERE eventID = '$id' AND memberID = '$mID'";
			$r1 = @mysqli_query($dbc, $q1);
			if(mysqli_num_rows($r1)==0){
				//if mID is not empty and does not match previous records save
				$mID=trim($_POST['mID']);
			}
			else{
				array_push($errors, "Member ID is already registered for event. </br>");
			}
		}

		//check for Errors
		if(empty($errors)){
			//save $mID
			$mID = mysqli_real_escape_string($dbc, trim($mID));

			//record in database
			$q2 = "INSERT INTO eventbooking (eventID, memberID) values ('$id', '$mID')";
			$r2 = @mysqli_query($dbc, $q2);

			//check it ran and then increment currentAttendee in event
			if($r2){
				echo "<h2>Thank you. You have successfully registered for " . $row[0] . "</h2>";
				$q3 = "UPDATE event SET currentAttendee = currentAttendee + 1 WHERE eventID=$id LIMIT 1";
				$r3 = @mysqli_query($dbc, $q3);

				//check that it ran
				if($r3){}
				else{
					echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q3 . '</p>'; // Debugging message.
				}
			} else{
				echo '<p class="error">Member could not be registered due to a system error. Please try again. If this problem persists please contact us.</p>'; // Public message.
				//echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q2 . '</p>'; // Debugging message.
			}
		}
	}
	else{//print form
		echo "<h1>Register for " . $row[0] . " on " . $row[1] . "</h1>";
		echo "<form action='user_event_memberRegister.php' method='post'>
			<p>Member ID: <input type='text' name='mID' value=\"$mID\" /></p>
			<input type='hidden' name='id' value='" . $id . "' />
			<p><input type='submit' name='submit' value='Register' /></p>";
			//link to non-member registered
		echo "<p>Not a member? Click <a href=<a href=http://localhost/SintoriSportsWebsite/user_event_nonmemberRegister.php?id=" . $id . ">here</a>
		to register for the event.</p>";
	}
