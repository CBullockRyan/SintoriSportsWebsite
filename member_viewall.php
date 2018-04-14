<!--************************************************
Author: Cassidy Bullock
Date: April 13, 2018
Description: View all members
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>View Members</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php');

	echo '<h1>All Members</h1>';

	//connect to database
	require ('connectDB.php');

	//query to bring up all records
	$q = "SELECT * FROM member ORDER BY membershipID";
	$r = @mysqli_query($dbc, $q); //run $query

	//check if ran correctly
	if($r){
		//count returned records
		$num = mysqli_num_rows($r);
		//make sure table isnt empty
		if($num > 0){
			//create table
			echo '<table>
						<tr><td align="left"><b>Member ID</b></td>
						<td align="left"><b>| First Name</b></td><td align="left"><b>| Last Name</b></td>
						<td align="left"><b>| Phone</b></td><td align="left"><b>| Email</b></td>
            <td align="left"><b>| Address</b></td><td align="left"><b>| Gender</b></td>
						<td align="left"><b>| Date of Birth</b></td><td align="left"><b>| Membership ID</b></td></tr>';

						// Fetch and print all the records:
						while ($row = mysqli_fetch_array($r)) {
							echo '<tr><td align="left">' . $row['memberID'] . '</td>
							<td align="left">| ' . $row['fname'] . '</td><td align="left">| '. $row['lname'] . '</td>
							<td align="left">| ' . $row['phone'] . '</td><td align="left">| ' . $row['email'] . '</td>
              <td align="left">| ' . $row['address'] . '</td><td align="left">| ' . $row['gender'] . '</td>
							<td align="left">| ' . $row['DoB'] . '</td><td align="left">| ' . $row['membershipID'] . ' </td>' .
							"<td align='left'><a href=http://localhost/SintoriSportsWebsite/member_update.php?id=" . $row['memberID'] . ">Update</a></td>
							<td align='left'><a href=http://localhost/SintoriSportsWebsite/member_delete.php?id=" . $row['memberID'] . ">Delete</a></td></tr>";
						}

						echo '</table>'; // Close the table.

						//Show how many records exist
						echo "<br/><br/>There are $num records in the database.";
					}
					else{
						echo "There are no members in the database<br/>";
					}

					mysqli_free_result ($r); // Free up the resources.

				}
				else{ // If it did not run OK.

					// Public message:
					echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';

					// Debugging message:
					//echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

				}

			mysqli_close($dbc); // Close the database connection.

			?>

</body>

</html>