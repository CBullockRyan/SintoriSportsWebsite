<!--************************************************
Author: Cassidy Bullock
Date: April 29, 2018
Description: rock climbing page
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Rock Climbing</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://cdn.ckeditor.com/ckeditor5/10.0.0/classic/ckeditor.js"></script>
</head>

<body>
	<?php include ('nav.inc.php');

	//connect to database
	require ('connectDB.php');

	//get dance page information
	$q = "SELECT title, content FROM content WHERE contentID=2";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);

	//variables
	$title = $row[0];
	$content = $row[1];

	//close database
	mysqli_close($dbc);
	?>


		<img src="uploads/rock.jpg" class="d-block w-100" alt="rock climbing img">
	<div class="jumbotron">
		<!--View the page content-->
		<h1><?php echo $title ?></h1>
		<div>
			<?php echo $content ?>
		</div>
	</div>

</body>

</html>
