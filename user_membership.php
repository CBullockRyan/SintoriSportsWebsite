<!--************************************************
Author: Cassidy Bullock
Date: March 30, 2018
Description: Membership page
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
	<?php include ('nav.inc.php');
  require ('connectDB.php');

  //get membership page information
	$q = "SELECT title, content FROM content WHERE contentID=5";
	$r = @mysqli_query($dbc, $q);
	$row = mysqli_fetch_array($r);

	//variables
	$title = $row[0];
	$content = $row[1];
  ?>

  <img src="..." alt="membership">
  <h1><?php echo $title ?></h1>
  <div>
    <?php echo $content ?>
  </div>

	<?php //get membership type information
		$q = "SELECT membershipType, maxMembers, membershipFee FROM membershipinfo";
		$r = @mysqli_query($dbc, $q);
    echo "<ul>";
    while($row = mysqli_fetch_array($r)){
      echo "<li><strong>$row[0] Membership</strong> includes $row[1] members for $ $row[2] a year.</li>";
    }
    echo "</ul>";
		mysqli_close($dbc);
	?>
</body>

</html>
