<!--************************************************
Author: Cassidy Bullock
Date: April 18, 2018
Description: register a member to an event
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Register for Event</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav.inc.php');

  // Check for a valid user ID, through GET or POST:
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From user_event_view.php
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has not been accessed correctly, please go back to the <a href=http://localhost/SintoriSportsWebsite/user_event_view.php>Events page</a> and select event to register for.</p>';
		exit();
	}
