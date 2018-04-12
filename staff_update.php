<!--************************************************
Author: Cassidy Bullock
Date: April 12, 2018
Description: Update a staff member
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Update a Staff Member</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php');

  // Check for a valid user ID, through GET or POST:
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has not been accessed correctly, please go back to the <a href=http://localhost/2961692/assign2/employees_viewall.php>View All Employees page</a> and select employee to update.</p>';
		exit();
	}

	//connect to database
	require ('connectDB.php');

	//get editable staff details from selected staff number
	$q = "SELECT staffID, position, fname, lname, email, address, phone FROM staff WHERE staffID=$id";
	$r = @mysqli_query($dbc, $q);

	//get results
	$row = mysqli_fetch_array($r);

	//fill all variables from Query
	$staffID = $id;
	$position = $row[1];
	$fname = $row[2];
	$lname = $row[3];
	$email = $row[4];
	$address = $row[5];
	$phone = $row[6];

	//check if form has been submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors[]="";

		//check for filled form
		if (empty($_POST['fname'])) {
			$errors[] = "You forgot to enter the first name";
		} else {
			$fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
		}
		if (empty($_POST['lname'])) {
			$errors[] = "You forgot to enter the last name";
		} else {
			$lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
		}
		if (empty($_POST['email'])) {
			$errors[] = 'You forgot to enter email address.';
		} else {
			$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
		}
		if (empty($_POST['address'])){
			$errors[] = 'You forgot to enter an address.';
		} else {
			$address = mysqli_real_escape_string($dbc, trim($_POST['address']));
		}
		if (empty($_POST['phone'])) {
			$errors[] = "You forgot to enter a phone number";
		} else {
			$phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
		}

		//Check that there are 0 errors:
		//Uses count var instead of empty() because array is returning length of 1, which is the empty string
		//fix implements an array filter to make sure it's not an empty string
		$count=count(array_filter($errors, 'strlen'));
		if ($count==0) {

			//  Test for unique email address:
			$q = "SELECT staffID FROM staff WHERE email='$email' AND staffID != '$id'";
			$r = @mysqli_query($dbc, $q);
			if (mysqli_num_rows($r) == 0) {

				// Make the query:
				$q = "UPDATE staff SET position='$position', fname='$fname', lname='$lname', email='$email', address='$address', phone='$phone' WHERE staffID=$id LIMIT 1";
				$r = @mysqli_query ($dbc, $q);

				//Check that user has been updated
				if (mysqli_affected_rows($dbc) == 1) {
					echo '<p>The user has been edited.</p>';
				}
				else {
					echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
					echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
				}
			}
			else { // Email already registered.
				echo '<p class="error">The email address has already been registered.</p>';
			}
		} else { // Report the errors.

			echo '<p class="error">The following error(s) occurred:<br />';
			foreach ($errors as $msg) { // Print each error.
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p>';
		}
	}
	//if form not submitted, display form
	else{
		echo "<h1>Update a Staff Member</h1>";
		echo "<p>Staff ID: $staffID</p>";
		echo "<form action='employee_update.php' method='post'>
			<p>Staff Position: <select name='position'>
				<option value='manager' <?php if($position=='manager'){echo ' selected='selected';} ?> >Manager</option>
				<option value='other' <?php if($position=='other'){echo ' selected='selected';} ?>>Other</option>
			</select></p>
			<p>First Name: <input type='text' name='fname' value=\"$fname\" /></p>
			<p>Last Name: <input type='text' name='lname' value=\"$lname\" /></p>
			<p>Email: <input type='email' name='email' value='$email' /></p>
			<p>Address: <input type='text' name='address' value='$address' /></p>
			<p>Phone: <input type='text' name='phone' value='$phone' /></p>
			<input type='hidden' name='id' value='" . $id . "' />
			<p><input type='submit' name='submit' value='Update' /></p>";
	}
	//disconnect from database
	mysqli_close($dbc);
?>

</body>

</html>
