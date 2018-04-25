<!--************************************************
Author: Cassidy Bullock
Date: April 14, 2018
Description: Update a member
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
	<?php include ('nav_staff.inc.php');

  // Check for a valid user ID, through GET or POST:
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From member_viewall.php
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has not been accessed correctly, please go back to the <a href=http://localhost/2961692/assign2/employees_viewall.php>View All Employees page</a> and select employee to update.</p>';
		exit();
	}

	//connect to database
	require ('connectDB.php');

	//get editable details from selected member
	$q = "SELECT memberID, fname, lname, email, address, phone FROM member WHERE memberID=$id";
	$r = @mysqli_query($dbc, $q);

	//get results
	$row = mysqli_fetch_array($r);

	//fill all variables from Query
	$memberID = $id;
	$fname = $row['fname'];
	$lname = $row['lname'];
	$email = $row['email'];
	$address = $row['address'];
	$phone = $row['phone'];

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
			$q = "SELECT memberID FROM member WHERE email='$email' AND memberID != '$id'";
			$r = @mysqli_query($dbc, $q);
			if (mysqli_num_rows($r) == 0) {

				// Make the query:
				$q = "UPDATE member SET fname='$fname', lname='$lname', email='$email', address='$address', phone='$phone' WHERE memberID=$id LIMIT 1";
				$r = @mysqli_query ($dbc, $q);

				//Check that user has been updated
				if (mysqli_affected_rows($dbc) == 1) {
					echo '<p>The member has been edited.</p>';
				}
				else {
					echo '<p class="error">The member could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				 //	echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
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
		echo "<h1>Update a Member</h1>";
		echo "<p>Member ID: $memberID</p>";
		echo "<form action='member_update.php' method='post'>
			<p>First Name: <input class='col-3 form-control' type='text' name='fname' value=\"$fname\" /></p>
			<p>Last Name: <input class='col-3 form-control' type='text' name='lname' value=\"$lname\" /></p>
			<p>Email: <input class='col-3 form-control' type='email' name='email' value='$email' /></p>
			<p>Address: <input class='col-5 form-control' type='text' name='address' value='$address' /></p>
			<p>Phone: <input class='col-3 form-control' type='text' name='phone' value='$phone' /></p>
			<input type='hidden' name='id' value='" . $id . "' />
			<p><input class='btn btn-outline-info' type='submit' name='submit' value='Update' /></p>";
	}
	//disconnect from database
	mysqli_close($dbc);
?>

</body>

</html>
