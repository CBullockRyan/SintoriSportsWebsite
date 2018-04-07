<!--************************************************
Author: Cassidy Bullock
Date: April 4, 2018
Description: Create membership page, works with
             sql tables membership and membershipinfo
             and payment (initial payment is required)
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>New Membership</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php'); ?>

	<?php
		//Create vars for form data
		$mType="";
		$fname="";
		$lname="";
		$gender="";
		$phone="";
		$address="";
		$payment="";
		$Dob="";
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
			if (empty($_POST['payment'])){
				array_push($errors, "Please add a payment <br/>");
			}
			else{
				$payment = $_POST['payment'];
			}
			//mtype should have a value no matter what
			$mType = $_POST['mType'];

			if(empty($errors)){
				//connect to database
				require ('connectDB.php');

				//fill variables
				$mType = mysqli_real_escape_string($dbc, trim($mType));
				$fname = mysqli_real_escape_string($dbc, trim($fname));
				$lname = mysqli_real_escape_string($dbc, trim($lname));
				$gender = mysqli_real_escape_string($dbc, trim($gender));
				$phone = mysqli_real_escape_string($dbc, trim($phone));
				$address = mysqli_real_escape_string($dbc, trim($address));
				$payment = mysqli_real_escape_string($dbc, trim($payment));
				$Dob = mysqli_real_escape_string($dbc, trim($Dob));
				$email = mysqli_real_escape_string($dbc, trim($email));

				//insert data into membership table
				$q1 = "Insert into membership (infoID) values ('$mType');
							Select LAST_INSERT_ID";
				$r1 = @mysqli_query($dbc, $q1); //run query
				$row1 = mysqli_fetch_array($r1); //for getting membershipID
				$membershipID = $row1['membershipID'];

				//check membership table query ran
				if($r1){
					//insert data into member table
					$q2 = "Insert into member (fname, lname, phone, email, address, gender, DoB, membershipID) values ('$fname', '$lname', '$phone', '$email', '$address', '$gender', '$Dob', '$membershipID')";
					$r2 = @mysqli_query($dbc, $q2);
					//check member table query array ran
					if($r2){
						//insert data into payment tables
						$paymentDate=date();
						$q3 = "Insert into payment (datePaid, amount) values ('$paymentDate', '$payment')";
						//check payment query array_rand
						if($r3){
							echo "<h2>Membership successfully registered</h2>";
						}
						else{
							echo '<h1>System Error</h1>
							<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';

							echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q3 . '</p>';
						}
					}
					else{
						echo '<h1>System Error</h1>
						<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';

						echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q2 . '</p>';
					}
				}
				else{
					echo '<h1>System Error</h1>
					<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';

					echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q1 . '</p>';
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


	<h1>Add Membership</h1>
	<!-- form to create membership -->
	<form action="membership_create.php" method="post">
		<p>Membership Type: <select name="mType">
			<option value="1">Single Membership</option>
			<option value="2">Family Membership</option>
			<option value="3">Couple Membership</option>
		</select></p>
		<p>First Name: <input type="text" name="fname" value="<?php echo $fname ?>" /></p>
		<p>Last Name: <input type="text" name="lname" value="<?php echo $lname ?>" /></p>
		<p>Mailing Address: <input type="text" name="address" value="<?php echo $address ?>" /></p>
		<p>Mobile Phone: <input type="text" name="phone" value="<?php echo $phone ?>" /></p>
		<p>Email: <input type="email" name="email" value="<?php echo $email ?>" /></p>
		<p>Date of Birth: <input type="date" name="dob" value="<?php echo $DoB ?>" /></p>
		<p>Gender: </p>
		<p><input type="radio" name="gender" value="M" <?php if($gender=="M"){echo " checked=\"checked\" ";} ?> /> Male</p>
		<p><input type="radio" name="gender" value="F" <?php if($gender=="F"){echo " checked=\"checked\" ";} ?> /> Female</p>
		<p>Payment: <input type="number" min="0.00" max="10000.00" step="0.01" name="payment" value="<?php echo $payment ?>" /></p>
		<p><input type="submit" name="Submit" value="submit" /></p>
</body>

</html>
