<!--******************************************************
Author: Cassidy Bullock
Date: March 30, 2018
Description: redirected from login page, confirms login
*******************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Login Successful</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php
	//validate the user
	if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {
		require ('./redirect.inc.php');
		redirect();
	}
	?>
	<?php include ('nav_staff.inc.php'); ?>
	<h1>Login Success</h1>
	<p>Welcome you are successfully logged in.</p>
	<p><a href="logout.php">Logout</a></p>
</body>

</html>
