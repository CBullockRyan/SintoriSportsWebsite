<!--************************************************
Author: Cassidy Bullock
Date: April 9, 2018
Description: Delete a staff member
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Delete a Staff Member</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav_staff.inc.php');
  // Check for a valid user ID, through GET or POST:
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From staff_viewall.php
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has not been accessed correctly, please go back to the <a href=http://localhost/SintoriSportsWebsite/staff_viewall.php>View All Staff page</a> and select employee to delete.</p>';

		exit();
	}

	//connect to database
	require ('connectDB.php');

	//if form is submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//check that user has confirmed delete, then remove record
		if ($_POST['sure'] == 'Yes') {
			$q = "DELETE FROM staff WHERE staffID=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);

			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
				echo '<p>The staff member has been removed from the system.</p>';
			}
			else { // If the query did not run OK.
				echo '<p class="error">The staff member could not be deleted due to a system error.</p>';
				//echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
		}
		else {
			echo "Staff member has not been removed.";
		}
	}
	else{
		// Retrieve the staff member's information:
		$q = "SELECT fname, lname FROM staff WHERE staffID=$id";
		$r = @mysqli_query ($dbc, $q);

		if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

			// Get the user's information:
			$row = mysqli_fetch_array ($r);

			echo "<h1>Delete an Employee</h1>";
			// Display the record being deleted:
			echo "<h3>Name: $row[0] $row[1] </h3> Are you sure you want to delete this staff member?";

			// Create the form:
			echo '<form action="staff_delete.php" method="post">
			<input type="radio" name="sure" value="Yes" /> Yes
			<input type="radio" name="sure" value="No" checked="checked" /> No
			<input type="submit" name="submit" value="Submit" />
			<input type="hidden" name="id" value="' . $id . '" />
			</form>';

		} else { // Not a valid user ID.
			echo '<p class="error">This page has been accessed in error.</p>';
		}
	}

	//disconnect database
	mysqli_close($dbc);
?>
</body>

</html>
