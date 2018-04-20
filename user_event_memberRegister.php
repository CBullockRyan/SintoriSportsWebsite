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
	$q = "SELECT title, eventDate, maxAttendee, currentAttendee FROM event WHERE eventID=$id";
	$r = @mysqli_query($dbc, $q);

	//get results
	$row = mysqli_fetch_array($r);

	//variable for form
	$mID="";
	$numAttendees=1;
	$maxAttendee= $row['maxAttendee'] - $row['currentAttendee']; //maximum guests that can be registered

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$errors = array();

		//check that form is filled out
		if(empty($_POST['mID'])){
			array_push($errors, "Please enter your membership number to register. </br>");
		}
		else{
			//check if member number is already registered
			$q1 = "SELECT * FROM eventbooking WHERE eventID = '$id' AND membershipID = '" . $_POST['mID'] . "'";
			$r1 = @mysqli_query($dbc, $q1);
			if(mysqli_num_rows($r1) == 0){
				//check that membership ID exists
				$q4 = "SELECT * FROM membership WHERE membershipID='" . $_POST['mID'] . "'";
				$r4 = @mysqli_query($dbc, $q4);
				if(mysqli_num_rows($r4)>0){
					//if mID is not empty and does not match previous records save form
					$mID=trim($_POST['mID']);
					$numAttendees=trim($_POST['numAttendees']);
					if($numAttendees>$maxAttendee){
						array_push($errors, "Number of guests entered is above maximum occupancy. </br>");
					}
				} else{
					array_push($errors, "That membership ID does not exist. </br>");
				}
			}
			else{
				array_push($errors, "Membership ID is already registered for event. </br>");
			}
		}

		//check for Errors
		if(empty($errors)){
			//save $mID
			$mID = mysqli_real_escape_string($dbc, trim($mID));
			$numAttendees = mysqli_real_escape_string($dbc, trim($numAttendees));

			//record in database
			$q2 = "INSERT INTO eventbooking (eventID, membershipID) values ('$id', '$mID')";
			$r2 = @mysqli_query($dbc, $q2);

			//check it ran and then increment currentAttendee in event
			if($r2){
				echo "<h2>Thank you. You have successfully registered for " . $row[0] . "</h2>";
				$q3 = "UPDATE event SET currentAttendee = currentAttendee + $numAttendees WHERE eventID=$id LIMIT 1";
				$r3 = @mysqli_query($dbc, $q3);

				//check that it ran
				if($r3){}
				else{
					//echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q3 . '</p>'; // Debugging message.
				}
			} else{
				echo '<p class="error">Member could not be registered due to a system error. Please try again. If this problem persists please contact us.</p>'; // Public message.
				//echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q2 . '</p>'; // Debugging message.
			}
		} else {//display error messages
			echo "<h1>Errors</h1>";
			echo "<p>The following errors occurred:<br/>";
			foreach($errors as $error){
				echo " - $error <br/>";
			}
			echo "Please try again</br>";
		}
	}
	else{//print form
		echo "<h1>Register for " . $row[0] . " on " . $row[1] . "</h1>";
		echo "<p><b>Spaces left in the event: $maxAttendee </b></p>";
		echo "<form action='user_event_memberRegister.php' method='post'>
			<p>Membership ID: <input type='text' name='mID' value=\"$mID\" /></p>
			<p>Number of people attending (including yourself): <input type='number' name='numAttendees' value='$numAttendees' /></p>
			<input type='hidden' name='id' value='" . $id . "' />
			<p><input type='submit' name='submit' value='Register' /></p>";
			//link to non-member registered
		echo "<p>Not a member? Click <a href=http://localhost/SintoriSportsWebsite/user_event_nonmemberRegister.php?id=" . $id . ">here</a>
		to register for the event.</p>";
	}
