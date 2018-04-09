<!--************************************************
Author: Cassidy Bullock
Date: April 9, 2018
Description: Make a payment
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Payment</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php'); ?>

	<?php
		//Create vars for form data
		$amount="";
    $paymentDate=date('Y-m-d H:i:s');
    $membershipID="";

		//check form submission
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$errors = array();

			//check all fields are filled out
			if(empty($_POST['membershipID'])){
				array_push($errors, "Please enter your membership number <br/>");
			}
			else{
				$membershipID = trim($_POST['membershipID']);
			}
			if(empty($_POST['amount'])){
				array_push($errors, "Please enter payment amount <br/>");
			}
			else{
				$amount = trim($_POST['amount']);
			}
			if (empty($_POST['paymentDate'])){
				array_push($errors, "Please enter the date of payment. <br/>");
			}
			else{
				$paymentDate = $_POST['paymentDate'];
			}

			if(empty($errors)){
				//connect to database
				require ('connectDB.php');

				//fill variables
				$amount = mysqli_real_escape_string($dbc, trim($amount));
				$paymentDate = mysqli_real_escape_string($dbc, trim($paymentDate));
				$membershipID = mysqli_real_escape_string($dbc, trim($amount));

				//insert data into payment table
				$q1 = "Insert into payment (datePaid, amount, membershipID) values ('$paymentDate', '$amount', '$membershipID')";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//check query ran
				if($r1){
					echo "<h2>Payment successful</h2>";
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


	<h1>Make a Payment</h1>
	<!-- form to create membership -->
	<form action="payment_create.php" method="post">
		<p>Membership Number: <input type="number" name="membershipID" value="<?php echo $membershipID ?>" /></p>
		<p>Payment Amount: <input type="number" min="0.00" max="10000.00" step="0.01" name="amount" value="<?php echo $amount ?>" /></p>
    <p>Date of Payment: <input type="date" name="paymentDate" value="<?php echo $paymentDate ?>" /></p>
  	<p><input type="submit" name="Submit" value="submit" /></p>
</body>

</html>
