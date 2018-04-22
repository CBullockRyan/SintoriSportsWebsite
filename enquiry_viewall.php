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
	<?php include ('staffnav.inc.php');

  echo '<h1>Enquiries</h1>';

  //connect to database
  require ('connectDB.php');

  //query to bring up all records
  $q = "SELECT enquiry.enquiryID, enquiry.subject, enquiry.enquiryComment, enquiry.resolved, nonmember.fname, nonmember.lname, nonmember.email, nonmember.phone
  FROM enquiry INNER JOIN nonmember ON enquiry.nonmemberID = nonmember.nonmemberID
  ORDER BY enquiry.resolved";

  $r = @mysqli_query($dbc, $q); //run $query

  //check if ran correctly
  if($r){
    //count returned records
    $num = mysqli_num_rows($r);
    //make sure table isnt empty
    if($num > 0){
      //create table
      echo '<table>
            <tr><td align="left"><b>Enquiry ID</b></td><td align="left"><b>| Subject</b></td>
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

            //Show how many records exist
            echo "<br/><br/>There are $num records in the database.";
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
        	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

        }

      mysqli_close($dbc); // Close the database connection.

      ?>

</body>

</html>
