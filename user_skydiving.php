<!--************************************************
Author: Cassidy Bullock
Date: April 29, 2018
Description: indoor skydiving page
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Indoor Skydiving</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://cdn.ckeditor.com/ckeditor5/10.0.0/classic/ckeditor.js"></script>
</head>

<body>
	<?php include ('nav.inc.php');

	//connect to database
	require ('connectDB.php');

	//get skydiving page information
	$q = "SELECT title, content FROM content WHERE contentID=4";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);

	//variables
	$title = $row[0];
	$content = $row[1];

	//close database
	mysqli_close($dbc);
	?>

	<img src="uploads/skydiving.jpg" class="img-fluid" alt="skydiving img">
	<!--View the page content-->
	<h1><?php echo $title ?></h1>
	<div>
		<?php echo $content ?>
	</div>

</body>

</html>
