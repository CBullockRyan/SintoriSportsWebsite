<!--************************************************
Author: Cassidy Bullock
Date: April 14, 2018
Description: create a member
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Add New Member</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php');

  // Check for a valid mID and mType, through GET or POST:
	if ( (isset($_GET['mID'])) && (is_numeric($_GET['mID'])) ) { // From membership_create.php
		$mID = $_GET['mID'];
		$mType = $_GET['mType'];
	} elseif ( (isset($_POST['mID'])) && (is_numeric($_POST['mID'])) ) { // Form submission.
		$mID = $_POST['mID'];
		$mType = $_POST['mType'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has not been accessed correctly, please go back to the <a href=http://localhost/SintoriSportsWebsite/staff_viewall.php>View All Staff page</a> and select employee to delete.</p>';
		exit();
	}

	//create variables
	$fname = "";
	$lname = "";
	$phone = "";
	$email = "";
	$address = "";
	$gender = "";
	$dob = "";

	//assign max of how many people are allowed to be in the membership
	if($mType==3){
		$max = 2;
	}
	elseif($mType==2){
		$max = 4;
	}
	else{
		//default of 1 if other types are added they will default to one member
		$max = 1;
	}

	//loop through form as many times as needed to fill out all the members
	for($ctr = 0; ctr<$max; $ctr++){
		//if form is submitted
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$errors = array();

			//check all fields are filled out
			if(empty($_POST['fname'])){
				array_push($errors, "Please enter your first name <br/>");
			}
			else{
				$fname=trim($_POST['fname']);
			}
			if(empty($_POST['lname'])){
				array_push($errors, "Please enter your last name <br/>");
			}
			else{
				$lname=trim($_POST['lname']);
			}
			if (empty($_POST['gender'])){
				array_push($errors, "Please select your gender <br/>");
			}
			else{
				$gender = $_POST['gender'];
			}
			if (empty($_POST['dob'])){
				array_push($errors, "Please enter your date of birth. <br/>");
			}
			else{
				$dob = $_POST['dob'];
			}
			if(empty($_POST['email'])){
				array_push($errors, "Please enter valid email address <br/>");
			}
			else{
				$email=trim($_POST['email']);
			}
			if (empty($_POST['phone'])){
				array_push($errors, "Please enter a phone number <br/>");
			}
			else{
				$phone = $_POST['phone'];
			}
			if (empty($_POST['address'])){
				array_push($errors, "Please enter your address. <br/>");
			}
			else{
				$address = $_POST['address'];
			}

			if(empty($errors)){
				//connect to database
				require ('connectDB.php');

				//fill variables
				$fname = mysqli_real_escape_string($dbc, trim($fname));
				$lname = mysqli_real_escape_string($dbc, trim($lname));
				$gender = mysqli_real_escape_string($dbc, trim($gender));
				$phone = mysqli_real_escape_string($dbc, trim($phone));
				$address = mysqli_real_escape_string($dbc, trim($address));
				$dob = mysqli_real_escape_string($dbc, trim($dob));
				$email = mysqli_real_escape_string($dbc, trim($email));

				//insert data into membership table
				$q1 = "Insert into member (fname, lname, email, address, phone, gender, DoB, membershipID) values ('$fname', '$lname', '$email', '$address', '$phone', '$gender', '$dob', '$mID')";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//get the ID to use as to display
				$staffID= mysqli_insert_id($dbc);

				//check membership table query ran
				if($r1){
					echo "<h2>New member successfully registered</h2>";
					if($_POST['again']=="no"){
						break;
					}
				}
				else{
					echo '<h1>System Error</h1>
					<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';

					echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q3 . '</p>';
				}

				//disconnect from database
				mysqli_close($dbc);

				exit();
			}
			else{
				echo "<h1>Errors</h1>";
				echo "<p>The following errors occurred:<br/>";
				foreach($errors as $error){
					echo " - $error <br/>";
				}
				echo "Please try again</br>";
			}
		}
		else{ //if form unsubmitted, display
			echo "<h1>Create Member</h1>";
			echo "<p>Membership has been successfully created.</p>";
			echo "<form action='member_create.php' method='post'>
			<p>First Name: <input type='text' name='fname' value='$fname' /></p>
			<p>Last Name: <input type='text' name='lname' value='$lname' /></p>
			<p>Mailing Address: <input type='text' name='address' value='$address' /></p>
			<p>Phone: <input type='text' name='phone' value='$phone' /></p>
			<p>Email: <input type='email' name='email' value='$email' /></p>
			<p>Date of Birth: <input type='date' name='dob' value='$dob' /></p>
			<p>Gender: </p>
			<p><input type='radio' name='gender' value='M' /> Male</p>
			<p><input type='radio' name='gender' value='F' /> Female</p>
			<p>Add another member? </p>
			<p><input type='radio' name='again' value='yes' /> Yes</p>
			<p><input type='radio' name='again' value='no' checked='checked' /> No</p>
			<p><input type='submit' name='submit' value='submit' /></p>";
		}
	?>

</body>

</html>
