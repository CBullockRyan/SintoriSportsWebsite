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

			//check hire date
			if (empty($_POST['hire_date'])){
				array_push($errors, "Please enter your hire date <br/>");
			}
			else{
				$hired = $_POST['hire_date'];
			}

			//check for email
			if(empty($_POST['emp_email'])){
				array_push($errors, "Please enter valid email address <br/>");
			}
			else{
				$email=trim($_POST['emp_email']);
			}

			if(empty($errors)){
				//connect to database
				require ('connect.php');

				//fill variables
				$empName = mysqli_real_escape_string($dbc, trim($empName));
				$gender = mysqli_real_escape_string($dbc, trim($gender));
				$hired = mysqli_real_escape_string($dbc, trim($hired));
				$email = mysqli_real_escape_string($dbc, trim($email));

				//insert data into database
				$query = "Insert into employees (emp_name, gender, hire_date, emp_email) values ('$empName', '$gender', '$hired', '$email')";
				$r = @mysqli_query($dbc, $query); //run query
				//responses if it ran or didn't run correctly
				if($r){
					echo '<h1>Thank you for registering!</h1>';
				}
				else{
					echo '<h1>System Error</h1>
					<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';

					echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $query . '</p>';
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
		<p>Mobile Phone: <input type="text" name="phone" value="<?php echo $phone ?>" /></p>
		<p>Email: <input type="email" name="email" value="<?php echo $email ?>" /></p>
		<p>Date of Birth: <input type="date" name="dob" value="<?php echo $DoB ?>" /></p>
		<p>Gender: </p>
		<p><input type="radio" name="gender" value="male" <?php if($gender=="male"){echo " checked=\"checked\" ";} ?> /> Male</p>
		<p><input type="radio" name="gender" value="female" <?php if($gender=="female"){echo " checked=\"checked\" ";} ?> /> Female</p>
		<p>Payment: <input type="number" min="0.00" max="10000.00" step="0.01" name="payment" value="<?php echo $payment ?>" /></p>
		<p><input type="submit" name="Submit" value="submit" /></p>
</body>

</html>
