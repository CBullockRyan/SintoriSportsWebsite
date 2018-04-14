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
		$payment="";

		//check form submission
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$errors = array();

			//check all fields are filled out
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
				$payment = mysqli_real_escape_string($dbc, trim($payment));

				//insert data into membership table
				$q1 = "Insert into membership (infoID) values ('$mType')";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//get the ID to use as foreign key
				$membershipID= mysqli_insert_id($dbc);

				//check membership table query ran
				if($r1){
						//insert data into payment tables
						$paymentDate=date('Y-m-d H:i:s');
						$q3 = "Insert into payment (datePaid, amount, membershipID) values ('$paymentDate', '$payment', '$membershipID')";
						$r3 = @mysqli_query($dbc, $q3);

						//check payment query ran.
						if($r3){
							//send membershipID, and membership type to create members
							$page="member_create.php?mID=" . $membershipID . "&mType=" . $mType;
							echo "<h3>Membership Created Successfully</h3>";
							echo "<p>Please enter member information ";
							echo "<a href=http://localhost/SintoriSportsWebsite/$page>here</a></p>";
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
		<p>Payment: <input type="number" min="0.00" max="10000.00" step="0.01" name="payment" value="<?php echo $payment ?>" /></p>
		<p><input type="submit" name="Submit" value="submit" /></p>
</body>

</html>
