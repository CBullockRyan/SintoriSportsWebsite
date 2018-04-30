<!--************************************************
Author: Cassidy Bullock
Date: April 15, 2018
Description: update a membership type
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Update Membership Type</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav_staff.inc.php');

  // Check for a valid user ID, through GET or POST:
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From type_viewall.php
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has not been accessed correctly, please go back to the <a href=http://localhost/SintoriSportsWebsite/type_viewall.php>View All Types page</a> and select a membership type to update.</p>';
		exit();
	}

	//connect to database
	require ('connectDB.php');

	//get details from selected type number
	$q = "SELECT * FROM membershipinfo WHERE infoID=$id";
	$r = @mysqli_query($dbc, $q);

	//get results
	$row = mysqli_fetch_array($r);

	//fill all variables from Query
	$infoID = $id;
	$type = $row['membershipType'];
	$maxMember = $row['maxMembers'];
	$fee = $row['membershipFee'];

	//check if form has been submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors[]="";

		//check for filled form
    if(empty($_POST['type'])){
      $errors[]= "Please enter the membership type name.";
    }
    else{
      $type = mysqli_real_escape_string($dbc, htmlspecialchars(trim($_POST['type'])));
    }
    if(empty($_POST['maxMember'])){
      $errors[]= "Please enter the maximum number of members.";
    }
    else{
      $maxMember = mysqli_real_escape_string($dbc, htmlspecialchars(trim($_POST['maxMember'])));
    }
    if (empty($_POST['fee'])){
      $errors[]= "Please enter the annual fee.";
    }
    else{
      $fee = mysqli_real_escape_string($dbc, htmlspecialchars(trim($_POST['fee'])));
    }

		//Check that there are 0 errors:
		//Uses count var instead of empty() because array is returning length of 1, which is the empty string
		//fix implements an array filter to make sure it's not an empty string
		$count=count(array_filter($errors, 'strlen'));
		if ($count==0) {
				// Make the query:
				$q = "UPDATE membershipinfo SET membershipType='$type', maxMembers='$maxMember', membershipFee='$fee' WHERE infoID=$id LIMIT 1";
				$r = @mysqli_query ($dbc, $q);

				//Check that user has been updated
				if (mysqli_affected_rows($dbc) == 1) {
					echo '<p>The membership type has been edited.</p>';
				}
				else {
					echo '<p class="error">The membership type could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
					//echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
				}
		}
		else { // Report the errors.
			foreach($errors as $error){
				echo "<font color=\"red\">ERROR: $error </font><br/>";
			}
		}
	}
	//if form not submitted, display form
	else{
		echo "<h1>Update a Staff Member</h1>";
		echo "<p>Type ID: $id</p>";
		echo "<form action='type_update.php' method='post'>
			<p>Membership Type Name: <input class='col-3 form-control' type='text' name='type' value=\"$type\" /></p>
			<p>Maximum Number of Members: <input class='col-3 form-control' type='number' name='maxMember' value=\"$maxMember\" /></p>
			<p>Annual Fee: <input class='col-3 form-control' type='number' min='0.00' max='10000.00' step='0.01' name='fee' value='$fee' /></p>
			<input type='hidden' name='id' value='" . $id . "' />
			<p><input class='btn btn-outline-info' type='submit' name='submit' value='Update' /></p>";
	}
	//disconnect from database
	mysqli_close($dbc);
?>

</body>

</html>
