<!--************************************************
Author: Cassidy Bullock
Date: April 22, 2018
Description: View all enquiries
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>View Enquiries</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('nav_staff.inc.php');

  echo '<h1>Enquiries</h1>';

  //connect to database
  require ('connectDB.php');

	//how many records to display on a page
	$display=19;

	//get number of pages
	if (isset($_GET['p']) && is_numeric($_GET['p'])) {  // p sent in url
		$pages = $_GET['p'];
	} else {
		//count number of records for pagination
		$q = "SELECT COUNT(enquiryID) FROM enquiry";
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
	$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'res';

	// Determine the sorting order:
	switch ($sort) {
		case 'ID':
			$order_by = 'enquiry.enquiryID';
			break;
		case 'res':
			$order_by = 'enquiry.resolved';
			break;
		default:
			$order_by = 'enquiry.resolved';
			$sort = 'res';
			break;
	}

  //query to bring up all records
  $q = "SELECT enquiry.enquiryID, enquiry.subject, enquiry.enquiryComment, enquiry.resolved, nonmember.fname, nonmember.lname, nonmember.email, nonmember.phone
  FROM enquiry INNER JOIN nonmember ON enquiry.nonmemberID = nonmember.nonmemberID
  ORDER BY $order_by LIMIT $start, $display";

  $r = @mysqli_query($dbc, $q); //run $query

  //check if ran correctly
  if($r){
    //count returned records
    $num = mysqli_num_rows($r);
    //make sure table isnt empty
    if($num > 0){
			// sort by links
			echo "<p>Sort By:
			<a href='enquiry_viewall.php?sort=ID'>ID </a>
			<a href='enquiry_viewall.php?sort=res'>Resolved</a></p>";

      //create table
      echo '<table>
            <tr><td align="left"><b>ID</b></td><td align="left"><b>| Subject</b></td>
            <td align="left"><b>| Message</b></td><td align="left"><b>| Resolved?</b></td>
            <td align="left"><b>| Name </b></td><td align="left"><b>| Email</b></td>
            <td align="left"><b>| Phone</b></td></tr>';

            // Fetch and print all the records:
            while ($row = mysqli_fetch_array($r)) {
              echo '<tr><td align="left">' . $row[0] . '</td>
              <td align="left">| ' . $row[1] . '</td>
              <td align="left">| ' . $row[2] . '</td><td align="left">| '. $row[3] . '</td>
              <td align="left">| ' . $row[4] . ' ' . $row[5] . '</td>
              <td align="left">| ' . $row[6] . '</td>
							<td align="left">| ' . $row[7] . ' |</td></tr>';
            }

            echo '</table>'; // Close the table.

						// Make the links to other pages, if necessary.
						if ($pages > 1) {
							echo '<br /><p><nav aria-label="Page Navigation"><ul class="pagination">';
							$current_page = ($start/$display) + 1;

							// If it's not the first page, make a Previous link:
							if ($current_page != 1) {
								echo '<li class="page-item"><a class="page-link" href="enquiry_viewall.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a></li> ';
							}

							// Make all the numbered pages:
							for ($i = 1; $i <= $pages; $i++) {
								if ($i != $current_page) {
									echo '<li class="page-item"><a class="page-link" href="enquiry_viewall.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a></li> ';
								} else {
									echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '<span class="sr-only">(current)</span></a></li> ';
								}
							}
							// If it's not the last page, make a Next link:
							if ($current_page != $pages) {
								echo '<li class="page-item"><a class="page-link" href="enquiry_viewall.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a></li>';
							}
							echo '</ul></nav></p>';
						}

            //Show how many records exist
            echo "<br/>There are $num records in the database.";
          }
          else{
            echo "There are no enquiries in the database<br/>";
          }

          mysqli_free_result ($r); // Free up the resources.

        }
        else{ // If it did not run OK.

          // Public message:
          echo '<p class="error">The current enquiries could not be retrieved. We apologize for any inconvenience.</p>';

          // Debugging message:
        	//echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

        }

      mysqli_close($dbc); // Close the database connection.

      ?>


</body>

</html>
