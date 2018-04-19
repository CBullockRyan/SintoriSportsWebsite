<!--************************************************
Author: Cassidy Bullock
Date: April 18, 2018
Description: register a non member to an event
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
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From user_event_memberRegister.php
		$id = $_GET['id'];
	} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
		$id = $_POST['id'];
	} else { // No valid ID, kill the script.
		echo '<p class="error">This page has not been accessed correctly, please go back to the <a href=http://localhost/SintoriSportsWebsite/user_event_view.php>Events page</a> and select event to register for.</p>';
		exit();
	}

	//connect to database
	require ('connectDB.php');

	//get event
	$q = "SELECT title, eventDate FROM event WHERE eventID=$id";
	$r = @mysqli_query($dbc, $q);

	//get results
	$row = mysqli_fetch_array($r);

	//variable for form
	$fname="";
  $lname="";
  $email="";
  $phone="";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$errors = array();

		//check that form is filled out
		if(empty($_POST['fname'])){
			array_push($errors, "Please enter your first name. </br>");
		}
		else{
			$fname=trim($_POST['fname']);
		}
    if(empty($_POST['lname'])){
			array_push($errors, "Please enter your last name. </br>");
		}
		else{
			$lname=trim($_POST['lname']);
		}
    if(empty($_POST['phone'])){
			array_push($errors, "Please enter a contact number. </br>");
		}
		else{
			$phone=trim($_POST['phone']);
		}
    if(empty($_POST['email'])){
			array_push($errors, "Please enter an email. </br>");
		}
		else{
			$email=trim($_POST['email']);
		}

		//check for Errors
		if(empty($errors)){
			//save variables
			$fname = mysqli_real_escape_string($dbc, trim($fname));
      $lname = mysqli_real_escape_string($dbc, trim($lname));
      $phone = mysqli_real_escape_string($dbc, trim($phone));
      $email = mysqli_real_escape_string($dbc, trim($email));

			//add record of non member
			$q2 = "INSERT INTO nonmember (fname, lname, phone, email) values ('$fname', '$lname', '$phone', '$email')";
			$r2 = @mysqli_query($dbc, $q2);

      //get created non-member id
      $nonmID= mysqli_insert_id($dbc);

			//check it ran and insert new event booking
			if($r2){
        //enter record into event
        $q3 = "INSERT INTO eventbooking (eventID, nonmemberID) VALUES ('$id', '$nonmID')";
        $r3 = @mysqli_query($dbc, $q3);

        //check it ran and then increment currentAttendee in event
        if($r3){
          echo "<h2>Thank you. You have successfully registered for " . $row[0] . "</h2>";
				  $q4 = "UPDATE event SET currentAttendee = currentAttendee + 1 WHERE eventID=$id LIMIT 1";
				  $r4 = @mysqli_query($dbc, $q3);

				  //check that it ran
				  if($r4){}
				  else{
					     echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q3 . '</p>'; // Debugging message.
				  }
			  } else{
				    echo '<p class="error">You could not be registered due to a system error. Please try again. If this problem persists please contact us.</p>'; // Public message.
				    //echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q2 . '</p>'; // Debugging message.
			  }
      } else{
          echo '<p class="error">You could not be registered due to a system error. Please try again. If this problem persists please contact us.</p>'; // Public message.
          //echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q2 . '</p>'; // Debugging message.
      }
		} else {//display error messages
			echo "<h1>Errors</h1>";
			echo "<p>The following errors occurred:<br/>";
			foreach($errors as $error){
				echo " - $error <br/>";
			}
			echo "Please try again</br>";
		}
	}
	else{//print form
		echo "<h1>Register for " . $row[0] . " on " . $row[1] . "</h1>";
		echo "<form action='user_event_nonmemberRegister.php' method='post'>
			<<p>First Name: <input type='text' name='fname' value=\"$fname\" /></p>
			<p>Last Name: <input type='text' name='lname' value=\"$lname\" /></p>
			<p>Email: <input type='email' name='email' value='$email' /></p>
			<p>Phone: <input type='text' name='phone' value='$phone' /></p>
			<input type='hidden' name='id' value='" . $id . "' />
			<p><input type='submit' name='submit' value='Register' /></p>";
	}
