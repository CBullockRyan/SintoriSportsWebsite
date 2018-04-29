<!--************************************************
Author: Cassidy Bullock
Date: March 30, 2018
Description: Home page
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav.inc.php'); ?>

	<div id="carouselSlides" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="uploads/dance.jpg" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="uploads/rock.jpg" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="uploads/skydiving.jpg" alt="Third slide">
			</div>
		</div>
	</div>

	<?php //get opening time information
		require ('connectDB.php');
		$q = "SELECT mon_thurs_open, mon_thurs_close, fri_sat_open, fri_sat_close FROM location WHERE locationID=1";
		$r = @mysqli_query($dbc, $q);
		$row = mysqli_fetch_array($r);
		$mt_open = $row[0];
		$mt_close = $row[1];
		$fs_open = $row[2];
		$fs_close = $row[3];
		mysqli_close($dbc);
	?>

	<div>
		<h1>Opening Times</h1>
		<p>Monday-Thursday <?php echo $mt_open . "-" . $mt_close; ?></p>
		<p>Friday-Saturday <?php echo $fs_open . "-" . $fs_close; ?></p>
	</div>
</body>

</html>
