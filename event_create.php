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
	<?php include ('nav_staff.inc.php'); ?>

	<?php
		//Create vars for form data
		$title="";
		$desc="";
    $date="";
    $time="";
		$max="";
		$imgPath="";

		//check form submission
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$errors = array();

			//vars to upload image
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

			//check all fields are filled out
			if(empty($_POST['title'])){
				array_push($errors, "Please enter the event title. <br/>");
			}
			else{
				$title=htmlspecialchars(trim($_POST['title']));
			}
			if(empty($_POST['desc'])){
				array_push($errors, "Please enter a description of the event. <br/>");
			}
			else{
				$desc=htmlspecialchars(trim($_POST['desc']));
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

			//check image type
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	   	if($check !== false) {
	       $uploadOk = 1;
	   	} else {
	       array_push($errors, "File is not an image.");
	       $uploadOk = 0;
	   	}

	  	// Check if file already exists
			if (file_exists($target_file)) {
		 		array_push($errors, "File already exists.");
		 		$uploadOk = 0;
			}

		  // Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
		 		array_push($errors, "Image must be smaller than 500000.");
		 		$uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
		 		array_push($errors, "Please make sure your file is an image. Only JPG, JPEG, PNG & GIF files are allowed.");
		 		$uploadOk = 0;
			}

			// Upload image if there are no errors
			if ($uploadOk !== 0) {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			      	//set image path so that it can be displayed on other pages
							$imgPath = $target_file;
			 		} else {
			       	array_push($errors, "File could not be uploaded due to system error.");
			 		}
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
				$imgPath = mysqli_real_escape_string($dbc, trim($imgPath));

				//insert data into event table
				$q1 = "Insert into event (title, description, eventTime, eventDate, maxAttendee, imgPath) values ('$title', '$desc', '$time', '$date', '$max', '$imgPath')";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//check event table query ran
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
			else{ //display errors
				foreach($errors as $error){
					echo "<font color=\"red\">ERROR: $error </font><br/>";
				}
			}
		}
	?>


	<h1>Add New Event</h1>
	<!-- form to create event -->
	<form action="event_create.php" method="post" id="event" enctype="multipart/form-data">
		<p>Title of Event: <input class='col-3 form-control' type="text" name="title" value="<?php echo $title ?>" /></p>
		<p>Description of Event: </p>
    <p><textarea class=' form-control' name="desc" form="event" rows="4" cols="40" value="<?php echo $desc ?>"></textarea></p>
		<p>Event Start Date: <input class='col-3 form-control' type="date" name="date" value="<?php echo $date ?>" /></p>
		<p>Event Start Time: <input class='col-3 form-control' type="time" name="time" value="<?php echo $time ?>" /></p>
		<p>Maximum Number of Attendees: <input class='col-3 form-control' type="number" name="max" value="<?php echo $max ?>" /></p>
		<p>Image: <input class='col-3 form-control' type="file" name="fileToUpload" id="fileToUpload" /></p>
		<p><input class='btn btn-outline-info' type="submit" name="Submit" value="submit" /></p>
</body>

</html>
