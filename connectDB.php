<?php

/************************************************
Author: Cassidy Bullock
Date: March 30, 2018
Description: establishes connection to database
************************************************/

// Set the database access information as constants:
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'SQLroot');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'sintori');

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');

?>
