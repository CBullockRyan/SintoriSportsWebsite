<!--************************************************
Author: Cassidy Bullock
Date: April 21, 2018
Description: View all news as a user
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>News</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav.inc.php');

	echo '<h1>News</h1>';

	//connect to database
	require ('connectDB.php');

	//query to bring up all events happening today or later
	$q = "SELECT newsID, title, description, newsDate FROM news ORDER BY newsDate DESC";
	$r = @mysqli_query($dbc, $q); //run $query

	//check if ran correctly
	if($r){
		//count returned records
		$num = mysqli_num_rows($r);

  	//make sure there are news posts
		if($num > 0){

			// Fetch and print all the records:
			while ($row = mysqli_fetch_array($r)) {
				echo '<div class="card">
				<h2 class="card-title">' . $row['title'] . '</h2>
				<p class="card-subtitle mb-2 text-muted">Date: ' . $row['newsDate'] . '</p>
        <p class="card-text">' . $row['description'] . '</p></div>';
			}
		}
		else{
			echo "There is no news in the database<br/>";
		}

		mysqli_free_result ($r); // Free up the resources.

	}
	else{ // If it did not run OK.
		// Public message:
		echo '<p class="error">The current news could not be retrieved. We apologize for any inconvenience.</p>';

		// Debugging message:
		//echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

	}

	mysqli_close($dbc); // Close the database connection.

?>

</body>

</html>
