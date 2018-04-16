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
		echo '<p class="error">This page has not been accessed correctly, please go back to the <a href=http://localhost/SintoriSportsWebsite/membership_create.php>membership creation page</a> to create a new membership.</p>';
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

	//create variables for more members
	if($max>1){
		$fname2 = "";
		$lname2 = "";
		$phone2 = "";
		$email2 = "";
		$address2 = "";
		$gender2 = "";
		$dob2 = "";
		if($max>3){
			$fname3 = "";
			$lname3 = "";
			$phone3 = "";
			$email3 = "";
			$address3 = "";
			$gender3 = "";
			$dob3 = "";
			$fname4 = "";
			$lname4 = "";
			$phone4 = "";
			$email4 = "";
			$address4 = "";
			$gender4 = "";
			$dob4 = "";
		}
	}
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
			//if additional member info is missing
			if($max>1){
				if(empty($_POST['fname2'])){
					array_push($errors, "Please enter your first name <br/>");
				}
				else{
					$fname2=trim($_POST['fname2']);
				}
				if(empty($_POST['lname2'])){
					array_push($errors, "Please enter your last name <br/>");
				}
				else{
					$lname2=trim($_POST['lname2']);
				}
				if (empty($_POST['gender2'])){
					array_push($errors, "Please select your gender <br/>");
				}
				else{
					$gender2 = $_POST['gender2'];
				}
				if (empty($_POST['dob2'])){
					array_push($errors, "Please enter your date of birth. <br/>");
				}
				else{
					$dob2 = $_POST['dob2'];
				}
				if(empty($_POST['email2'])){
					array_push($errors, "Please enter valid email address <br/>");
				}
				else{
					$email2=trim($_POST['email2']);
				}
				if (empty($_POST['phone2'])){
					array_push($errors, "Please enter a phone number <br/>");
				}
				else{
					$phone2 = $_POST['phone2'];
				}
				if (empty($_POST['address2'])){
					array_push($errors, "Please enter your address. <br/>");
				}
				else{
					$address2 = $_POST['address2'];
				}
				// handling of child members, they should not require a fourth members
				// and children should not be required to have a phone or email associated
				if($max>3){
					if(empty($_POST['fname3'])){
						array_push($errors, "Please enter your first name <br/>");
					}
					else{
						$fname3=trim($_POST['fname3']);
					}
					if(empty($_POST['lname3'])){
						array_push($errors, "Please enter your last name <br/>");
					}
					else{
						$lname3=trim($_POST['lname3']);
					}
					if (empty($_POST['gender3'])){
						array_push($errors, "Please select your gender <br/>");
					}
					else{
						$gender3 = $_POST['gender3'];
					}
					if (empty($_POST['dob3'])){
						array_push($errors, "Please enter your date of birth. <br/>");
					}
					else{
						$dob3 = $_POST['dob3'];
					}
					if(empty($_POST['email3'])){}
					else{
						$email3=trim($_POST['email3']);
					}
					if (empty($_POST['phone3'])){}
					else{
						$phone3 = $_POST['phone3'];
					}
					if (empty($_POST['address3'])){}
					else{
						$address3 = $_POST['address3'];
					}
					if(empty($_POST['fname4'])){}
					else{
						$fname4=trim($_POST['fname4']);
					}
					if(empty($_POST['lname4'])){}
					else{
						$lname4=trim($_POST['lname4']);
					}
					if (empty($_POST['gender4'])){}
					else{
						$gender = $_POST['gender4'];
					}
					if (empty($_POST['dob4'])){}
					else{
						$dob4 = $_POST['dob4'];
					}
					if(empty($_POST['email4'])){}
					else{
						$email4=trim($_POST['email4']);
					}
					if (empty($_POST['phone4'])){}
					else{
						$phone = $_POST['phone4'];
					}
					if (empty($_POST['address4'])){}
					else{
						$address4 = $_POST['address4'];
					}
				}
			}

			//if errors are empty
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
				if($max>1){
					$fname2 = mysqli_real_escape_string($dbc, trim($fname2));
					$lname2 = mysqli_real_escape_string($dbc, trim($lname2));
					$gender2 = mysqli_real_escape_string($dbc, trim($gender2));
					$phone2 = mysqli_real_escape_string($dbc, trim($phone2));
					$address2 = mysqli_real_escape_string($dbc, trim($address2));
					$dob2 = mysqli_real_escape_string($dbc, trim($dob2));
					$email2 = mysqli_real_escape_string($dbc, trim($email2));
					if($max>3){
						$fname3 = mysqli_real_escape_string($dbc, trim($fname3));
						$lname3 = mysqli_real_escape_string($dbc, trim($lname3));
						$gender3 = mysqli_real_escape_string($dbc, trim($gender3));
						$phone3 = mysqli_real_escape_string($dbc, trim($phone3));
						$address3 = mysqli_real_escape_string($dbc, trim($address3));
						$dob3 = mysqli_real_escape_string($dbc, trim($dob3));
						$email3 = mysqli_real_escape_string($dbc, trim($email3));
						$fname4 = mysqli_real_escape_string($dbc, trim($fname4));
						$lname4 = mysqli_real_escape_string($dbc, trim($lname4));
						$gender4 = mysqli_real_escape_string($dbc, trim($gender4));
						$phone4 = mysqli_real_escape_string($dbc, trim($phone4));
						$address4 = mysqli_real_escape_string($dbc, trim($address4));
						$dob4 = mysqli_real_escape_string($dbc, trim($dob4));
						$email4 = mysqli_real_escape_string($dbc, trim($email4));
					}
				}

				//insert data into membership table
				$q1 = "Insert into member (fname, lname, email, address, phone, gender, DoB, membershipID) values ('$fname', '$lname', '$email', '$address', '$phone', '$gender', '$dob', '$mID')";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//check membership table query ran
				if($r1 && ($max>1)){
					//run second query
					$q2 = "Insert into member (fname, lname, email, address, phone, gender, DoB, membershipID) values ('$fname2', '$lname2', '$email2', '$address2', '$phone2', '$gender2', '$dob2', '$mID')";
					$r2 = @mysqli_query($dbc, $q2); //run query

					//check if it ran
					if($r2 && ($max>3)){
						//run first child Query
						$q3 = "Insert into member (fname, lname, email, address, phone, gender, DoB, membershipID) values ('$fname3', '$lname3', '$email3', '$address3', '$phone3', '$gender3', '$dob3', '$mID')";
						$r3 = @mysqli_query($dbc, $q3); //run query

						//check if ran and if there is another child
						if($r3 && $fname4){
							$q4 = "Insert into member (fname, lname, email, address, phone, gender, DoB, membershipID) values ('$fname4', '$lname4', '$email4', '$address4', '$phone4', '$gender4', '$dob4', '$mID')";
							$r4 = @mysqli_query($dbc, $q4); //run query

							//check if it ran
							if($r4){
								echo "<h2>New members successfully registered</h2>";
							}
							else{
								echo '<h1>System Error</h1>
								<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';
							}
						}
						elseif($r3){
							echo "<h2>New members successfully registered</h2>";
						}
						else{
							echo '<h1>System Error</h1>
							<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';
						}
					}
					elseif($r2){
						echo "<h2>New members successfully registered</h2>";
					}
					else{
						echo '<h1>System Error</h1>
						<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';
					}
				}
				elseif($r1){
					echo "<h2>New member successfully registered</h2>";
				}
				else{
					echo '<h1>System Error</h1>
					<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';
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
		?>

		<h1>Member Creation</h1>
		<form action='member_create.php' method='post'>
			<h2>Primary Member</h2>
			<p>First Name: <input type='text' name='fname' value='<?php echo $fname ?>' /></p>
			<p>Last Name: <input type='text' name='lname' value='<?php echo $lname?>' /></p>
			<p>Mailing Address: <input type='text' name='address' value='<?php echo $address ?>' /></p>
			<p>Phone: <input type='text' name='phone' value='<?php echo $phone ?>' /></p>
			<p>Email: <input type='email' name='email' value='$email' /></p>
			<p>Date of Birth: <input type='date' name='dob' value='$dob' /></p>
			<p>Gender: </p>
			<p><input type='radio' name='gender' value='M' /> Male</p>
			<p><input type='radio' name='gender' value='F' /> Female</p>
			<?php if($max>1) : ?>
				<h2>Other Member(s)</h2>
				<p>First Name: <input type='text' name='fname2' value='$fname2' /></p>
				<p>Last Name: <input type='text' name='lname2' value='$lname2' /></p>
				<p>Mailing Address: <input type='text' name='address2' value='$address2' /></p>
				<p>Phone: <input type='text' name='phone2' value='$phone2' /></p>
				<p>Email: <input type='email' name='email2' value='$email2' /></p>
				<p>Date of Birth: <input type='date' name='dob2' value='$dob2' /></p>
				<p>Gender: </p>
				<p><input type='radio' name='gender2' value='M' /> Male</p>
				<p><input type='radio' name='gender2' value='F' /> Female</p>
				<?php if($max>3) : ?>
					<p>First Name: <input type='text' name='fname3' value='$fname3' /></p>
					<p>Last Name: <input type='text' name='lname3' value='$lname3' /></p>
					<p>Mailing Address: <input type='text' name='address3' value='$address3' /></p>
					<p>Phone: <input type='text' name='phone3' value='$phone3' /></p>
					<p>Email: <input type='email' name='email3' value='$email3' /></p>
					<p>Date of Birth: <input type='date' name='dob3' value='$dob3' /></p>
					<p>Gender: </p>
					<p><input type='radio' name='gender3' value='M' /> Male</p>
					<p><input type='radio' name='gender3' value='F' /> Female</p>
					<p>First Name: <input type='text' name='fname4' value='$fname4' /></p>
					<p>Last Name: <input type='text' name='lname4' value='$lname4' /></p>
					<p>Mailing Address: <input type='text' name='address4' value='$address4' /></p>
					<p>Phone: <input type='text' name='phone4' value='$phone4' /></p>
					<p>Email: <input type='email' name='email4' value='$email4' /></p>
					<p>Date of Birth: <input type='date' name='dob4' value='$dob4' /></p>
					<p>Gender: </p>
					<p><input type='radio' name='gender4' value='M' /> Male</p>
					<p><input type='radio' name='gender4' value='F' /> Female</p>
				<?php endif; ?>
			<?php endif; ?>
			<p><input type='submit' name='submit' value='submit' /></p></form>
</body>

</html>
