<!--******************************************************
Author: Cassidy Bullock
Date: March 30, 2018
Description: destroys session and verifies logout to user
*******************************************************-->
<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

//check if session is logged in then destroy
if (isset($_SESSION['user'])) {
	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.
}
?>

<!DOCTYPE html>

<html>

<head>
   <title>Log Out Successful</title>
</head>

<body>
	<?php include ('nav.inc.php'); ?>
  	<h1>Logged Out!</h1>
	<p>You are now logged out!</p>
</body>

</html>
