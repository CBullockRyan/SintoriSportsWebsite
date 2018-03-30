<?php
/************************************************
Author: Cassidy Bullock
Date: March 30, 2018
Description: php script to redirect
************************************************/

	function redirect($page = 'home.php') {

		//create url
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

		// Remove any trailing slashes:
		$url = rtrim($url, '/\\');

		// Add the page:
		$url .= '/' . $page;

		// Redirect the user:
		header("Location: $url");

		exit(); // Quit the script.
	}
?>
