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
</head>

<body>
	<?php include ('nav.inc.php'); ?>

	<div id="carouselSlides" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="..." alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="..." alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="..." alt="Third slide">
			</div>
		</div>
	</div>

	<div>
		<h1>Opening Times</h1>
		<p>Monday-Thursday 7:00am - 10:00pm</p>
		<p>Friday-Saturday 9:00am - 8:00pm</p>
	</div>
</body>

</html>
