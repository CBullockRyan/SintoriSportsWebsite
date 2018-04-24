<!--************************************************
Author: Cassidy Bullock
Date: April 15, 2018
Description: View all membership types
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>View Membership Type</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav_staff.inc.php');

	echo '<h1>All Membership Types</h1>';

	//connect to database
	require ('connectDB.php');

	//how many records to display on a page
	$display=19;

	//get number of pages
	if (isset($_GET['p']) && is_numeric($_GET['p'])) {  // p sent in url
		$pages = $_GET['p'];
	} else {
		//count number of records for pagination
		$q = "SELECT COUNT(infoID) FROM membershipinfo";
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
		case 'max':
			$order_by = 'maxMembers';
			break;
		case 'fee':
			$order_by = 'membershipFee';
			break;
		case 'ID':
			$order_by = 'infoID';
			break;
		default:
			$order_by = 'infoID';
			$sort = 'ID';
			break;
	}

	//query to bring up all records
	$q = "SELECT * FROM membershipinfo ORDER BY $order_by LIMIT $start, $display";
	$r = @mysqli_query($dbc, $q); //run $query

	//check if ran correctly
	if($r){
		//count returned records
		$num = mysqli_num_rows($r);

		//make sure table isnt empty
		if($num > 0){
			// sort by links
			echo "<p>Sort By:
			<a type='button' class='btn btn-outline-info' href='type_viewall.php?sort=ID'>ID </a>
			<a type='button' class='btn btn-outline-info' href='type_viewall.php?sort=max'>Maximum Members</a>
			<a type='button' class='btn btn-outline-info' href='type_viewall.php?sort=fee'>Annual Fee</a></p>";

			//create table
			echo '<table>
						<tr><td align="left"><b>Type ID</b></td><td align="left"><b>| Type</b></td>
						<td align="left"><b>| Maximum No. of Members</b></td>
            <td align="left"><b>| Yearly Fee</b></td></tr>';

						// Fetch and print all the records:
						while ($row = mysqli_fetch_array($r)) {
							echo '<tr><td align="left">' . $row['infoID'] . '</td>
							<td align="left">| ' . $row['membershipType'] . '</td>
							<td align="left">| ' . $row['maxMembers'] . '</td>
              <td align="left">| '. $row['membershipFee'] . '</td>' .
							"<td align='left'><a type='button' class='btn btn-outline-secondary btn-sm' href=http://localhost/SintoriSportsWebsite/type_update.php?id=" . $row['infoID'] . ">Update</a></td>
							<td align='left'><a type='button' class='btn btn-outline-danger btn-sm' href=http://localhost/SintoriSportsWebsite/type_delete.php?id=" . $row['infoID'] . ">Delete</a></td></tr>";
						}

						echo '</table>'; // Close the table.

						// Make the links to other pages, if necessary.
						if ($pages > 1) {
							echo '<br /><p><ul class="pagination">';
							$current_page = ($start/$display) + 1;

							// If it's not the first page, make a Previous link:
							if ($current_page != 1) {
								echo '<li class="page-item"><a class="page-link" href="type_viewall.php?s=' . ($start - $display) . '&p=' . $pages . '">Previous</a></li> ';
							}

							// Make all the numbered pages:
							for ($i = 1; $i <= $pages; $i++) {
								if ($i != $current_page) {
									echo '<li class="page-item"><a class="page-link" href="type_viewall.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a></li> ';
								} else {
									echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '<span class="sr-only">(current)</span></a></li> ';
								}
							}
							// If it's not the last page, make a Next link:
							if ($current_page != $pages) {
								echo '<li class="page-item"><a class="page-link" href="type_viewall.php?s=' . ($start + $display) . '&p=' . $pages . '">Next</a></li>';
							}
							echo '</ul></p>';
						}

						//Show how many records exist
						echo "<br/>There are $num records in the database.";
					}
					else{
						echo "There are no types of memberships in the database.<br/>";
					}

					mysqli_free_result ($r); // Free up the resources.

				}
				else{ // If it did not run OK.

					// Public message:
					echo '<p class="error">The current types could not be retrieved. We apologize for any inconvenience.</p>';

					// Debugging message:
				//	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

				}

			mysqli_close($dbc); // Close the database connection.
			?>

</body>

</html>
