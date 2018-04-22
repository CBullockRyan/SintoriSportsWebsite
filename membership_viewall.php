<!--************************************************
Author: Cassidy Bullock
Date: April 14, 2018
Description: View all memberships
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>View Memberships</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php');

	//connect to database
	require ('connectDB.php');

	//how many records to display on a page
	$display=19;

	//get number of pages
	if (isset($_GET['p']) && is_numeric($_GET['p'])) {  // p sent in url
		$pages = $_GET['p'];
	} else {
		//count number of records for pagination
		$q = "SELECT COUNT(membershipID) FROM membership";
		$r = @mysqli_query($dbc, $q);
		$row = mysqli_fetch_array($r);
		$records = $row[0];

		//calculate how many pages
		if($records > $display){
			$pages= ceil($records/$display);
		} else {
			$pages=1;
		}
	}

	//where in database to start retrieving records
	if (isset($_GET['s']) && is_numeric($_GET['s'])) { // get s (start) from the url
		$start = $_GET['s'];
	} else {
		$start = 0;
	}

	// Determine the sort
	$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'ID';

	// Determine the sorting order:
	switch ($sort) {
		case 'stat':
			$order_by = 'status';
			break;
		case 'ID':
			$order_by = 'membershipID';
			break;
		default:
			$order_by = 'membershipID';
			$sort = 'ID';
			break;
	}

	echo '<h1>All Memberships</h1>';
  echo '<p>Membership types: </p><p>1 --> Single Membership</p>
        <p>2 --> Family Membership</p><p>3 --> Couple Membership</p>';

	//query to bring up all records
	$q = "SELECT * FROM membership ORDER BY $order_by LIMIT $start, $display";
	$r = @mysqli_query($dbc, $q); //run $query

	//check if ran correctly
	if($r){
		//count returned records
		$num = mysqli_num_rows($r);
		//make sure table isnt empty
		if($num > 0){
			// sort by links
			echo "<p>Sort By:
			<a href='membership_viewall.php?sort=ID'>ID </a>
			<a href='membership_viewall.php?sort=stat'>Status</a></p>";

			//create table
			echo '<table>
						<tr><td align="left"><b>Membership ID</b></td>
            <td align="left"><b>| infoID</b></td>
						<td align="left"><b>| Status</b></td></tr>';

						// Fetch and print all the records:
						while ($row = mysqli_fetch_array($r)) {
							echo '<tr><td align="left">' . $row['membershipID'] . '</td>
							<td align="left">| ' . $row['infoID'] . '</td>
							<td align="left">| ' . $row['status'] . '</td>' .
							"<td align='left'><a href=http://localhost/SintoriSportsWebsite/membership_delete.php?id=" . $row['membershipID'] . ">Delete</a></td></tr>";
						}

						echo '</table>'; // Close the table.

						// Make the links to other pages, if necessary.
						if ($pages > 1) {
							echo '<br /><p>';
							$current_page = ($start/$display) + 1;

							// If it's not the first page, make a Previous link:
							if ($current_page != 1) {
								echo '<a href="membership_viewall.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
							}

							// Make all the numbered pages:
							for ($i = 1; $i <= $pages; $i++) {
								if ($i != $current_page) {
									echo '<a href="membership_viewall.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
								} else {
									echo $i . ' ';
								}
							}
							// If it's not the last page, make a Next link:
							if ($current_page != $pages) {
								echo '<a href="membership_viewall.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
							}
							echo '</p>';
						}

						//Show how many records exist
						echo "<br/>There are $num records in the database.";
					}
					else{
						echo "There are no memberships in the database<br/>";
					}

					mysqli_free_result ($r); // Free up the resources.

				}
				else{ // If it did not run OK.

					// Public message:
					echo '<p class="error">The current memberships could not be retrieved. We apologize for any inconvenience.</p>';

					// Debugging message:
				//	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

				}

			mysqli_close($dbc); // Close the database connection.

			?>

</body>

</html>
