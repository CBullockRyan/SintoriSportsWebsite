<!--************************************************
Author: Cassidy Bullock
Date: April 16, 2018
Description: View all events as manager
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>View All Events</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php');

	echo '<h1>All Events</h1>';

	//connect to database
	require ('connectDB.php');

	//query to bring up all records
	$q = "SELECT eventID, title, eventTime, eventDate, maxAtendee FROM event ORDER BY eventID";
	$r = @mysqli_query($dbc, $q); //run $query

	//check if ran correctly
	if($r){
		//count returned records
		$num = mysqli_num_rows($r);
		//make sure table isnt empty
		if($num > 0){
			//create table
			echo '<table>
						<tr><td align="left"><b>Event ID</b></td><td align="left"><b>| Title</b></td>
						<td align="left"><b>| Time</b></td><td align="left"><b>| Date</b></td>
						<td align="left"><b>| Max. No. of Attendees</b></td><</tr>';

						// Fetch and print all the records:
						while ($row = mysqli_fetch_array($r)) {
							echo '<tr><td align="left">' . $row['eventID'] . '</td>
							<td align="left">| ' . $row['title'] . '</td>
							<td align="left">| ' . $row['eventTime'] . '</td>
              <td align="left">| ' . $row['eventDate'] . '</td>
							<td align="left">| ' . $row['maxAttendee'] . '</td>' .
							"<td align='left'><a href=http://localhost/SintoriSportsWebsite/event_update.php?id=" . $row['eventID'] . ">Update</a></td></tr>";
						}

						echo '</table>'; // Close the table.

						//Show how many records exist
						echo "<br/><br/>There are $num records in the database.";
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
					echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

				}

			mysqli_close($dbc); // Close the database connection.

			?>

</body>

</html>
