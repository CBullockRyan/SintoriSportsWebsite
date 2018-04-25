<!--************************************************
Author: Cassidy Bullock
Date: April 9, 2018
Description: Make a new membership type
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>New Membership Type</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav_staff.inc.php'); ?>

	<?php
		//Create vars for form data
		$type="";
    $maxMember="";
    $fee="";

		//check form submission
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$errors = array();

			//check all fields are filled out
			if(empty($_POST['type'])){
				array_push($errors, "Please enter the membership type name. <br/>");
			}
			else{
				$type = trim($_POST['type']);
			}
			if(empty($_POST['maxMember'])){
				array_push($errors, "Please enter maximum number of members. <br/>");
			}
			else{
				$maxMember = trim($_POST['maxMember']);
			}
			if (empty($_POST['fee'])){
				array_push($errors, "Please enter the associated annual fee. <br/>");
			}
			else{
				$fee = $_POST['fee'];
			}

			//connect to database
			require ('connectDB.php');

			//make sure there were no errors
			if(empty($errors)){

				//fill variables
				$type = mysqli_real_escape_string($dbc, trim($type));
				$maxMember = mysqli_real_escape_string($dbc, trim($maxMember));
				$fee = mysqli_real_escape_string($dbc, trim($fee));

				//insert data into payment table
				$q2 = "Insert into membershipinfo (membershipType, maxMembers, membershipFee) values ('$type', '$maxMember', '$fee')";
				$r2 = @mysqli_query($dbc, $q2); //run query

				//check query ran
				if($r2){
					echo "<h2>New type added</h2>";
				}
				else{
					echo '<h1>System Error</h1>
					<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';

					//echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q2 . '</p>';
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


	<h1>Create New Membership Type</h1>
	<!-- form to create new membership type -->
	<form action="type_create.php" method="post">
		<p>Name of Membership Type: <input class='col-3 form-control' type="text" name="type" value="<?php echo $type ?>" /></p>
		<p>Maximum number of Members: <input class='col-3 form-control' type="number" name="maxMember" value="<?php echo $maxMember ?>" /></p>
    <p>Annual Fee: <input class='col-3 form-control' type="number" min="0.00" max="10000.00" step="0.01" name="fee" value="<?php echo $fee ?>" /></p>
  	<p><input class='btn btn-outline-info' type="submit" name="Submit" value="submit" /></p>
</body>

</html>
