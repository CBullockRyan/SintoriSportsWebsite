<!--************************************************
Author: Cassidy Bullock
Date: April 16, 2018
Description: Update an event
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Update an Event</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav_staff.inc.php');

  // Check for a valid user ID, through GET or POST:
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From event_viewall.php
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has not been accessed correctly, please go back to the <a href=http://localhost/SintoriSportsWebsite/event_viewall.php>View All Events page</a> and select event to update.</p>';
		exit();
	}

	//connect to database
	require ('connectDB.php');

	//get editable staff details from selected staff number
	$q = "SELECT * FROM event WHERE eventID=$id";
	$r = @mysqli_query($dbc, $q);

	//get results
	$row = mysqli_fetch_array($r);

	//fill all variables from Query
	$eventID = $id;
	$title = $row[1];
	$desc = $row[2];
	$time = $row[3];
	$date = $row[4];
	$max = $row[5];

	//check if form has been submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors[]="";

		//check for filled form
		if (empty($_POST['title'])) {
			$errors[] = "You forgot to enter the title of the event";
		} else {
			$title = mysqli_real_escape_string($dbc, htmlspecialchars(trim($_POST['title'])));
		}
		if (empty($_POST['desc'])) {
			$errors[] = "You forgot to enter the event description.";
		} else {
			$desc = mysqli_real_escape_string($dbc, htmlspecialchars(trim($_POST['desc'])));
		}
		if (empty($_POST['time'])) {
			$errors[] = 'You forgot to enter the start time.';
		} else {
			$time = mysqli_real_escape_string($dbc, htmlspecialchars(trim($_POST['time'])));
		}
		if (empty($_POST['date'])){
			$errors[] = 'You forgot to enter a start date.';
		} else {
			$date = mysqli_real_escape_string($dbc, htmlspecialchars(trim($_POST['date'])));
		}
		if (empty($_POST['max'])) {
			$errors[] = "You forgot to enter a maximum number of attendees.";
		} else {
			$max = mysqli_real_escape_string($dbc, htmlspecialchars(trim($_POST['max'])));
		}

		//Check that there are 0 errors:
		//Uses count var instead of empty() because array is returning length of 1, which is the empty string
		//fix implements an array filter to make sure it's not an empty string
		$count=count(array_filter($errors, 'strlen'));
		if ($count==0) {

			// Make the query:
			$q = "UPDATE event SET title='$title', description='$desc', eventTime='$time', eventDate='$date', maxAttendee='$max' WHERE eventID=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);

			//Check that user has been updated
			if (mysqli_affected_rows($dbc) == 1) {
				echo '<p>The event has been edited.</p>';
			}
			else {
				echo '<p class="error">The event could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				//echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
		} else { // Report the errors.
			foreach($errors as $error){
				echo "<font color=\"red\">ERROR: $error </font><br/>";
			}
		}
	}
	//if form not submitted, display form
	else{
		echo "<h1>Update an Event</h1>";
		echo "<p>Event ID: $eventID</p>";
		echo "<form action='event_update.php' method='post' id='event'>
			<p>Event Title: <input class='col-3 form-control' type='text' name='title' value='$title' /></p>
			<p>Event Description:</p>
      <p><textarea class='form-control' name='desc' form='event' rows='4' cols=40 > $desc </textarea></p>
			<p>Event Start Time: <input class='col-3 form-control' type='time' name='time' value='$time' /></p>
			<p>Event Start Date: <input class='col-3 form-control' type='date' name='date' value='$date' /></p>
      <p>Maximum Number of Attendees: <input class='col-3 form-control' type='number' name='max' value='$max' /></p>
			<input type='hidden' name='id' value='" . $id . "' />
			<p><input class='btn btn-outline-info' type='submit' name='submit' value='Update' /></p>";
	}
	//disconnect from database
	mysqli_close($dbc);
?>

</body>

</html>
