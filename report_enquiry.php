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

  //query to get information
  $q = "SELECT resolved, count(*) FROM enquiry GROUP BY resolved";
  $r = @mysqli_query($dbc, $q);
?>

<!doctype html>

<html>

<head>
	<title>Enquiry Status Report</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Resolved', 'Unresolved'],
        <?php
          if(mysqli_num_rows($r) > 0){
            while($row = mysqli_fetch_array($r)){
              echo "['".$row['resolved']."', ".$row['numGroup']."],";
            }
          }
        ?>
      ]);

      var options = {
        title: 'Percentage of Resolved Enquiries',
        width: 900,
        height: 500,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
}
</script>
</head>

<body>
	<?php include ('nav_staff.inc.php'); ?>


	<div id="piechart"></div>
</body>

</html>
