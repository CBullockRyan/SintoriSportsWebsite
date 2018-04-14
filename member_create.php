<!--************************************************
Author: Cassidy Bullock
Date: April 14, 2018
Description: Update a staff member
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Add New Member</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php'); ?>

  <h1>Add a New Member: NOT WRITTEN YET</h1>
  <p>This page hasn't been written yet. This should offer as many slots to enter
  members as each membership type allows. This page can only be accessed by creating
  a new membership. Use redirect.inc.php from membership_create.php to redirect
	to this page</p>

</body>

</html>
