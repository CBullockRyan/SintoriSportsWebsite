<!--************************************************
Author: Cassidy Bullock
Date: April 9, 2018
Description: Create new staff member
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>New Staff Member</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php'); ?>

	<?php
		//Create vars for form data
		$position="";
		$staffPass="";
    $fname="";
    $lname="";
		$gender="";
		$phone="";
		$address="";
		$Dob="";
    $hiredate="";
		$email="";

		//check form submission
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
				$Dob = $_POST['dob'];
			}
      if (empty($_POST['hiredate'])){
        array_push($errors, "Please enter date of hire. <br/>");
      }
      else{
        $hiredate = $_POST['hiredate'];
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
			if (empty($_POST['position'])){
				array_push($errors, "Please select position <br/>");
			}
			else{
				$position = $_POST['position'];
			}
      if(empty($_POST['staffPass'])){
				array_push($errors, "Please enter password. <br/>");
			}
			else{
				$staffPass = $_POST['staffPass'];
			}

			if(empty($errors)){
				//connect to database
				require ('connectDB.php');

				//fill variables
				$position = mysqli_real_escape_string($dbc, trim($position));
        $staffPass = mysqli_real_escape_string($dbc, trim($staffPass));
      	$fname = mysqli_real_escape_string($dbc, trim($fname));
				$lname = mysqli_real_escape_string($dbc, trim($lname));
				$gender = mysqli_real_escape_string($dbc, trim($gender));
				$phone = mysqli_real_escape_string($dbc, trim($phone));
				$address = mysqli_real_escape_string($dbc, trim($address));
				$Dob = mysqli_real_escape_string($dbc, trim($Dob));
        $hiredate = mysqli_real_escape_string($dbc, trim($hiredate));
				$email = mysqli_real_escape_string($dbc, trim($email));

        //encode Password
        $staffPass = sha1($staffPass);

				//insert data into membership table
				$q1 = "Insert into staff (position, staffPass, fname, lname, email, address, phone, gender, DoB, hireDate) values ('$position', '$staffPass', '$fname', '$lname', '$email', '$address', '$phone', '$gender', '$Dob', '$hiredate')";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//get the ID to use as to display
				$staffID= mysqli_insert_id($dbc);

				//check membership table query ran
				if($r1){
					echo "<h2>New staff member successfully registered</h2>";
					echo "<p>The new staff member's ID number is: $staffID </p>";
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
	?>


	<h1>Add New Staff Member</h1>
	<!-- form to create membership -->
	<form action="staff_create.php" method="post">
		<p>Staff Position: <select name="position">
			<option value="manager">Manager</option>
			<option value="other">Other</option>
		</select></p>
		<p>Create Password: <input type="password" name="staffPass" /></p>
		<p>First Name: <input type="text" name="fname" value="<?php echo $fname ?>" /></p>
		<p>Last Name: <input type="text" name="lname" value="<?php echo $lname ?>" /></p>
		<p>Mailing Address: <input type="text" name="address" value="<?php echo $address ?>" /></p>
		<p>Mobile Phone: <input type="text" name="phone" value="<?php echo $phone ?>" /></p>
		<p>Email: <input type="email" name="email" value="<?php echo $email ?>" /></p>
		<p>Date of Birth: <input type="date" name="dob" value="<?php echo $Dob ?>" /></p>
		<p>Hire Date: <input type="date" name="hiredate" value="<?php echo $hiredate ?>" /></p>
		<p>Gender: </p>
		<p><input type="radio" name="gender" value="M" <?php if($gender=="M"){echo " checked=\"checked\" ";} ?> /> Male</p>
		<p><input type="radio" name="gender" value="F" <?php if($gender=="F"){echo " checked=\"checked\" ";} ?> /> Female</p>
		<p><input type="submit" name="Submit" value="submit" /></p>
</body>

</html>
