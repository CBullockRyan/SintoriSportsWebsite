<!--************************************************
Author: Cassidy Bullock
Date: April 9, 2018
Description: update a membership to change status.
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Update Membership</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php');

	//error array
	$errors=array();

	//create variables for update
	$mID="";
	$status="";

	//if form submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//check form info has been entered
		if (empty($_POST['mID'])) {
			array_push($errors, "Please enter a membership ID </br>");
		} else {
			$mID = $_POST['mID'];
		}

		//if no Errors
		if(empty($errors)){
			//require database connection
			require ('connectDB.php');

			//fill variables
			$mID = mysqli_real_escape_string($dbc, trim($_POST['mID']));
			$status = mysqli_real_escape_string($dbc, trim($_POST['status']));

			//check that membership ID exists
			$q1 = "SELECT * FROM membership WHERE membershipID = $mID";
			$r1 = @mysqli_query($dbc, $q1);
			$num = mysqli_num_rows($r1);

			if($num==1){
				//update membership status
				$q2 = "UPDATE membership SET status = '$status' WHERE membershipID = $mID LIMIT 1";
				$r2 = @mysqli_query($dbc, $q2);

				//check if it ran
				if ($r2) {
					echo '<p>The membership has been updated.</p>';
				}
				else {
					echo '<p class="error">The membership could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				//	echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
				}
			}
			else{
				echo '<p class="error">The membership was not found. Please try again.</p>';
			}
		}
		else{
			//display errors
			echo "<h1>Errors</h1>";
			echo "<p>The following errors occurred:<br/>";
			foreach($errors as $error){
				echo " - $error <br/>";
			}
			echo "Please try again</br>";
		}
	}
	else{ // create Form if unsubmitted
		echo "<h1>Update a Membership</h2>";
		echo "<p>You can change the membership status here. If you want to change
		the type of membership, please set current membership to inactive and then
		create a new membership with the correct type.</p>";
		//create form
		echo "<form action='membership_update.php' method='post'>
			<p>Membership Status: <select name='status'>
				<option value='ACTIVE' selected='selected'>ACTIVE</option>
				<option value='INACTIVE'>INACTIVE</option>
			</select></p>
			<p>Membership ID: <input type='text' name='mID' /></p>
			<p><input type='submit' name='submit' value='Update' /></p>";
	}
  ?>
</body>

</html>
