<!--************************************************
Author: Cassidy Bullock
Date: April 24, 2018
Description: enquiry status report
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}

  //connect to database
  require ('connectDB.php');

  //get numbers for resolved and unresolved enquiries
  $q = "SELECT count(*) FROM enquiry where resolved = 'N'";
  $r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$unresolved = $row[0];
	$q = "SELECT count(*) FROM enquiry where resolved = 'Y'";
  $r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$resolved = $row[0];

?>

<!doctype html>

<html>

<head>
	<title>Enquiry Status Report</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Status', 'Amount'],
        ['Resolved', <?php echo $resolved ?>],
				['Unresolved', <?php echo $unresolved ?>]
      ]);

      var options = {
        title: 'Percentage of Resolved Enquiries',
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
}
</script>
</head>

<body>
	<?php include ('nav_staff.inc.php'); ?>


	<div id="piechart" style="width: 900px; height: 500px;"></div>
</body>

</html>
