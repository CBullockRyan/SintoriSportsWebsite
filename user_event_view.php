<!--************************************************
Author: Cassidy Bullock
Date: April 16, 2018
Description: View all events as regular user
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>All Events</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav.inc.php');

	echo '<h1>All Events</h1>';

	//connect to database
	require ('connectDB.php');

	//current date variable
	$currentDate=date('Y-m-d H:i:s');

	//query to bring up all events happening today or later
	$q = "SELECT eventID, title, description, eventTime, eventDate, maxAttendee, currentAttendee, imgPath FROM event WHERE eventDate > '$currentDate' ORDER BY eventDate";
	$r = @mysqli_query($dbc, $q); //run $query

	//check if ran correctly
	if($r){
		//count returned records
		$num = mysqli_num_rows($r);

  	//make sure there are events
		if($num > 0){

			// Fetch and print all the records:
			while ($row = mysqli_fetch_array($r)) {
				echo '<h2>' . $row['title'] . '</h2>
				<p>Date: ' . $row['eventDate'] . '</p>
				<p>Time: ' . $row['eventTime'] . '</p>
				<p><img src="' . $row['imgPath'] . '" alt="News image"></p>
        <p>' . $row['description'] . '</p>';

				//check that max capacity is not reached
				if($row['maxAttendee'] > $row['currentAttendee']){
					echo "<p>Register for the event <a href=http://localhost/SintoriSportsWebsite/user_event_memberRegister.php?id=" . $row['eventID'] . ">here</a></p>";
				}
				else{//display message that no more can register
					echo "<p>Sorry, this event has reached maximum capacity. Please contact us if you have any questions. </p>";
				}
			}
		}
		else{
			echo "There are no events in the database<br/>";
		}

		mysqli_free_result ($r); // Free up the resources.

	}
	else{ // If it did not run OK.
		// Public message:
		echo '<p class="error">The current events could not be retrieved. We apologize for any inconvenience.</p>';

		// Debugging message:
		//echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

	}

	mysqli_close($dbc); // Close the database connection.

?>

</body>

</html>
