<!--************************************************
Author: Cassidy Bullock
Date: April 15, 2018
Description: View all membership types
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>View Membership Type</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php');

	echo '<h1>All Membership Types</h1>';

	//connect to database
	require ('connectDB.php');

	//query to bring up all records
	$q = "SELECT * FROM membershipinfo ORDER BY infoID";
	$r = @mysqli_query($dbc, $q); //run $query

	//check if ran correctly
	if($r){
		//count returned records
		$num = mysqli_num_rows($r);
		//make sure table isnt empty
		if($num > 0){
			//create table
			echo '<table>
						<tr><td align="left"><b>Type ID</b></td><td align="left"><b>| Type</b></td>
						<td align="left"><b>| Maximum No. of Members</b></td>
            <td align="left"><b>| Yearly Fee</b></td></tr>';

						// Fetch and print all the records:
						while ($row = mysqli_fetch_array($r)) {
							echo '<tr><td align="left">' . $row['infoID'] . '</td>
							<td align="left">| ' . $row['membershipType'] . '</td>
							<td align="left">| ' . $row['maxMembers'] . '</td>
              <td align="left">| '. $row['membershipFee'] . '</td>' .
							"<td align='left'><a href=http://localhost/SintoriSportsWebsite/type_update.php?id=" . $row['infoID'] . ">Update</a></td>
							<td align='left'><a href=http://localhost/SintoriSportsWebsite/type_delete.php?id=" . $row['infoID'] . ">Delete</a></td></tr>";
						}

						echo '</table>'; // Close the table.

						//Show how many records exist
						echo "<br/><br/>There are $num records in the database.";
					}
					else{
						echo "There are no types of memberships in the database.<br/>";
					}

					mysqli_free_result ($r); // Free up the resources.

				}
				else{ // If it did not run OK.

					// Public message:
					echo '<p class="error">The current types could not be retrieved. We apologize for any inconvenience.</p>';

					// Debugging message:
				//	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

				}

			mysqli_close($dbc); // Close the database connection.

			?>

</body>

</html>
