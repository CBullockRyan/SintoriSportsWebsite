<!--************************************************
Author: Cassidy Bullock
Date: April 23, 2018
Description: payment report for user generated date
        range
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Payment Report</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="js/Chart.min.js"></script>
	<script type="text/javascript" src="js/paymentChart.js"></script>
</head>

<body>
	<?php include ('nav_staff.inc.php');

  //create variables to hold date range
  $start="";
  $end="";

  //check form submission
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
		//connect to database
		require ('connectDB.php');

		$errors=array();

    //check that all fields were filled out
    if(empty($_POST['start'])){
      array_push($errors, "Please enter start of date range.");
    } else {
      $start = mysqli_real_escape_string($dbc, trim($_POST['start']));
    }
    if(empty($_POST['end'])){
      array_push($errors, "Please enter end of date range.");
    } else {
      $end = mysqli_real_escape_string($dbc, trim($_POST['end']));
    }

		//if start and end date are in the wrong order, switch them
		if($start>$end){
			$temp = $start;
			$start = $end;
			$end = $temp;
			unset($temp);
		}

		//check that there are no errors
		if(empty($errors)){

			//query to bring up all records within date range
			$q = "SELECT datePaid, amount FROM payment
						WHERE datePaid BETWEEN '$start' AND '$end'";
			$r = @mysqli_query($dbc, $q);

			//create file with graph values
			$file = fopen("data.php", "w");

			//write in file
			fwrite($file, "[\n");

			while($row = mysqli_fetch_array($r)){
				fwrite($file, "{\n");
				fwrite($file, "\"datePaid\" : \"$row[datePaid]\",\n");
				fwrite($file, "\"amount\" : \"$row[amount]\"\n},\n");
			}

			//put graph values in the file
			fwrite($file, "]");

			//close file
			fclose($file);

		} else { // display errors
			foreach($errors as $error){
				echo " -$error </br>";
			}
			echo "Please try again </br>";
		}
  }
  ?>
  <h1>Membership Payment Report</h1>
  <p>Please pick a date range to see the report on payments made from members</p>
  <form action='report_payment.php' method='post'>
    <p>Start Date: <input type='date' name='start' value=<?php echo $start ?> /></p>
    <p>End Date: <input type='date' name='end' value=<?php echo $end ?> /></p>
    <p><input type='submit' name='Submit' value='submit' /></p>
  </form>
	<div id="chart-container">
		<canvas id="paymentChart"></canvas>
	</div>
</body>

</html>
