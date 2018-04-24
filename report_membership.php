<!--************************************************
Author: Cassidy Bullock
Date: April 24, 2018
Description: Membership Status report
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}

  //connect to database
  require ('connectDB.php');

  //get numbers for active and inactive memberships
  $q = "SELECT count(*) FROM membership where status = 'ACTIVE'";
  $r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$active = $row[0];
	$q = "SELECT count(*) FROM membership where status = 'INACTIVE'";
  $r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);
	$inactive = $row[0];

?>

<!doctype html>

<html>

<head>
	<title>Membership Status Report</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Status', 'Amount'],
        ['Active', <?php echo $active ?>],
				['Inactive', <?php echo $inactive ?>]
      ]);

      var options = {
        title: 'Percentage of Active Memberships',
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
