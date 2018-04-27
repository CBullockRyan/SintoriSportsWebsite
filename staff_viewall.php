<!--************************************************
Author: Cassidy Bullock
Date: April 9, 2018
Description: View all staff member
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>View Staff Members</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav_staff.inc.php');

	echo '<h1>All Staff Members</h1>';

	//connect to database
	require ('connectDB.php');

	//how many records to display on a page
	$display=19;

	//get number of pages
	if (isset($_GET['p']) && is_numeric($_GET['p'])) {  // p sent in url
		$pages = $_GET['p'];
	} else {
		//count number of records for pagination
		$q = "SELECT COUNT(staffID) FROM staff";
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
		case 'pos':
			$order_by = 'position';
			break;
		case 'hd':
			$order_by = 'hireDate';
			break;
		case 'ID':
			$order_by = 'staffID';
			break;
		default:
			$order_by = 'staffID';
			$sort = 'ID';
			break;
	}

	//query to bring up all records
	$q = "SELECT staffID, position, fname, lname, email, address, phone, gender, DoB, hireDate FROM staff ORDER BY $order_by LIMIT $start, $display";
	$r = @mysqli_query($dbc, $q); //run $query

	//check if ran correctly
	if($r){
		//count returned records
		$num = mysqli_num_rows($r);
		//make sure table isnt empty
		if($num > 0){
			// sort by links
			echo "<h4 class='text-right'>Sort By:
			<a type='button' class='btn btn-outline-info' href='staff_viewall.php?sort=ID'>ID </a>
			<a type='button' class='btn btn-outline-info' href='staff_viewall.php?sort=pos'>Position</a>
			<a type='button' class='btn btn-outline-info' href='staff_viewall.php?sort=hd'>Hire Date</a></h4>";

			//create table
			echo '<table class="table">
						<tr><td align="left"><b>Staff ID</b></td><td align="left"><b>Position</b></td>
						<td align="left"><b>First Name</b></td><td align="left"><b>Last Name</b></td>
						<td align="left"><b>Email</b></td><td align="left"><b>Address</b></td>
						<td align="left"><b>Phone</b></td><td align="left"><b>Gender</b></td>
						<td align="left"><b>Date of Birth</b></td><td align="left"><b>Hire Date</b></td></tr>';

						// Fetch and print all the records:
						while ($row = mysqli_fetch_array($r)) {
							echo '<tr><td align="left">' . $row['staffID'] . '</td>
							<td align="left">' . $row['position'] . '</td>
							<td align="left">' . $row['fname'] . '</td><td align="left">'. $row['lname'] . '</td>
							<td align="left">' . $row['email'] . '</td><td align="left">' . $row['address'] . '</td>
							<td align="left">' . $row['phone'] . '</td><td align="left">' . $row['gender'] . '</td>
							<td align="left">' . $row['DoB'] . '</td><td align="left">' . $row['hireDate'] . '</td>' .
							"<td align='left'><a type='button' class='btn btn-outline-secondary btn-sm' href=http://localhost/SintoriSportsWebsite/staff_update.php?id=" . $row['staffID'] . ">Update</a></td>
							<td align='left'><a type='button' class='btn btn-outline-danger btn-sm' href=http://localhost/SintoriSportsWebsite/staff_delete.php?id=" . $row['staffID'] . ">Delete</a></td></tr>";
						}

						echo '</table>'; // Close the table.

						// Make the links to other pages, if necessary.
						if ($pages > 1) {
							echo '<br /><p><ul class="pagination">';
							$current_page = ($start/$display) + 1;

							// If it's not the first page, make a Previous link:
							if ($current_page != 1) {
								echo '<li class="page-item"><a class="page-link" href="staff_viewall.php?s=' . ($start - $display) . '&p=' . $pages . '">Previous</a></li> ';
							}

							// Make all the numbered pages:
							for ($i = 1; $i <= $pages; $i++) {
								if ($i != $current_page) {
									echo '<li class="page-item"><a class="page-link" href="staff_viewall.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a></li> ';
								} else {
									echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '<span class="sr-only">(current)</span></a></li> ';
								}
							}
							// If it's not the last page, make a Next link:
							if ($current_page != $pages) {
								echo '<li class="page-item"><a class="page-link" href="staff_viewall.php?s=' . ($start + $display) . '&p=' . $pages . '">Next</a></li>';
							}
							echo '</ul></p>';
						}

						//Show how many records exist
						echo "<br/>There are $num records in the database.";
					}
					else{
						echo "There are no staff in the database<br/>";
					}

					mysqli_free_result ($r); // Free up the resources.

				}
				else{ // If it did not run OK.

					// Public message:
					echo '<p class="error">The current staff could not be retrieved. We apologize for any inconvenience.</p>';

					// Debugging message:
				//	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

				}

			mysqli_close($dbc); // Close the database connection.

			?>

</body>

</html>
