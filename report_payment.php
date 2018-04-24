<!--************************************************
Author: Cassidy Bullock
Date: April 23, 2018
Description: payment report
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}

	//connect to database
	require ('connectDB.php');

	//get numbers for each month of incoming money
	//january
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-01-01' AND '2018-01-31'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$jan = 3;
	//february
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-02-01' AND '2018-02-28'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$feb = $row[0];
	//march
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-03-01' AND '2018-03-31'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$mar = $row[0];
	//april
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-04-01' AND '2018-04-30'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$apr = $row[0];
	//may
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-05-01' AND '2018-05-31'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$may = $row[0];
	//june
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-06-01' AND '2018-06-30'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$jun = $row[0];
	//july
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-07-01' AND '2018-07-31'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$jul = $row[0];
	//august
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-08-01' AND '2018-08-31'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$aug = $row[0];
	//september
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-09-01' AND '2018-09-30'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$sep = $row[0];
	//october
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-10-01' AND '2018-10-31'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$oct = $row[0];
	//november
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-11-01' AND '2018-11-30'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$nov = $row[0];
	//december
	$q = "SELECT sum(amount) FROM payment
	WHERE datePaid BETWEEN '2018-12-01' AND '2018-12-31'";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$dec = $row[0];
?>

<!doctype html>

<html>

<head>
	<title>Payment Report</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Month', 'Total Payment'],
          ["January", <?php echo $jan ?>],
          ["February", 31],
					["March", 31],
          ["April", 12],
					["May", 12],
					["June", 12],
					["July", 12],
					["August", 12],
					["September", 12],
					["October", 12],
          ["November", 10],
          ['December', 3]
        ]);

        var options = {
          title: 'Membership Payments',
          width: 900,
          legend: { position: 'none' },
          chart: { title: 'Membership Payments',
                   subtitle: 'Total Dollars per Month' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Dollars'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('barchart'));
        chart.draw(data, options);
      };
    </script>
</head>

<body>
	<?php include ('nav_staff.inc.php'); ?>

	<div id="barchart" style="width: 900px; height: 500px;"></div>
</body>

</html>
