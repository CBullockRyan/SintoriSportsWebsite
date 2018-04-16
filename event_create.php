<!--************************************************
Author: Cassidy Bullock
Date: April 16, 2018
Description: Create a new event
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>New Event</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php'); ?>

	<?php
		//Create vars for form data
		$title="";
		$desc="";
    $date="";
    $time="";
		$max="";

		//check form submission
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$errors = array();

			//check all fields are filled out
			if(empty($_POST['title'])){
				array_push($errors, "Please enter the event title. <br/>");
			}
			else{
				$title=trim($_POST['title']);
			}
			if(empty($_POST['desc'])){
				array_push($errors, "Please enter a description of the event. <br/>");
			}
			else{
				$desc=trim($_POST['desc']);
			}
			if (empty($_POST['date'])){
				array_push($errors, "Please select the date of the event. <br/>");
			}
			else{
				$date = $_POST['date'];
			}
			if (empty($_POST['time'])){
				array_push($errors, "Please enter the start time of the event. <br/>");
			}
			else{
				$time = $_POST['time'];
			}
      if (empty($_POST['max'])){
        array_push($errors, "Please specify the maximum number of attendees. <br/>");
      }
      else{
        $max = $_POST['max'];
      }


			if(empty($errors)){
				//connect to database
				require ('connectDB.php');

				//fill variables
				$title = mysqli_real_escape_string($dbc, trim($title));
        $desc = mysqli_real_escape_string($dbc, trim($desc));
      	$date = mysqli_real_escape_string($dbc, trim($date));
				$time = mysqli_real_escape_string($dbc, trim($time));
				$max = mysqli_real_escape_string($dbc, trim($max));

				//insert data into membership table
				$q1 = "Insert into event (title, description, eventTime, eventDate, maxAttendee) values ('$title', '$desc', '$time', '$date', '$max')";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//check membership table query ran
				if($r1){
					echo "<h2>New event successfully created</h2>";
				}
				else{
					echo '<h1>System Error</h1>
					<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';

					//echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q3 . '</p>';
				}

				//disconnect from database
				mysqli_close($dbc);

				exit();
			}
			else{
				echo "<h1>Errors</h1>";
				echo "<p>The following errors occurred:<br/>";
				foreach($errors as $error){
					echo " - $error <br/>";
				}
				echo "Please try again</br>";
			}
		}
	?>


	<h1>Add New Event</h1>
	<!-- form to create event -->
	<form action="event_create.php" method="post" id="event">
		<p>Title of Event: <input type="text" name="title" value="<?php echo $title ?>" /></p>
		<p>Description of Event: </p>
    <p><textarea name="desc" form="event" value="<?php echo $desc ?>"></textarea></p>
		<p>Event Start Date: <input type="date" name="date" value="<?php echo $date ?>" /></p>
		<p>Event Start Time: <input type="time" name="time" value="<?php echo $time ?>" /></p>
		<p>Maximum Number of Attendees: <input type="number" name="max" value="<?php echo $max ?>" /></p>
		<p><input type="submit" name="Submit" value="submit" /></p>
</body>

</html>
