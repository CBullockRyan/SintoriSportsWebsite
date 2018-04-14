<!--************************************************
Author: Cassidy Bullock
Date: April 14, 2018
Description: View all memberships
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>View Memberships</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php');

	echo '<h1>All Memberships</h1>';
  echo '<p>Membership types: </p><p>1 --> Single Membership</p>
        <p>2 --> Family Membership</p><p>3 --> Couple Membership</p>';

	//connect to database
	require ('connectDB.php');

	//query to bring up all records
	$q = "SELECT * FROM membership ORDER BY membershipID";
	$r = @mysqli_query($dbc, $q); //run $query

	//check if ran correctly
	if($r){
		//count returned records
		$num = mysqli_num_rows($r);
		//make sure table isnt empty
		if($num > 0){
			//create table
			echo '<table>
						<tr><td align="left"><b>Membership ID</b></td>
            <td align="left"><b>| infoID</b></td>
						<td align="left"><b>| Status</b></td></tr>';

						// Fetch and print all the records:
						while ($row = mysqli_fetch_array($r)) {
							echo '<tr><td align="left">' . $row['membershipID'] . '</td>
							<td align="left">| ' . $row['infoID'] . '</td>
							<td align="left">| ' . $row['status'] . '</td>' .
							"<td align='left'><a href=http://localhost/SintoriSportsWebsite/membership_delete.php?id=" . $row['membershipID'] . ">Delete</a></td></tr>";
						}

						echo '</table>'; // Close the table.

						//Show how many records exist
						echo "<br/><br/>There are $num records in the database.";
					}
					else{
						echo "There are no memberships in the database<br/>";
					}

					mysqli_free_result ($r); // Free up the resources.

				}
				else{ // If it did not run OK.

					// Public message:
					echo '<p class="error">The current memberships could not be retrieved. We apologize for any inconvenience.</p>';

					// Debugging message:
				//	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

				}

			mysqli_close($dbc); // Close the database connection.

			?>

</body>

</html>
