<!--************************************************
Author: Cassidy Bullock
Date: April 20, 2018
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
	<title>Create News Post</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php include ('staffnav.inc.php'); ?>

	<?php
		//Create vars for news table
		$title="";
		$desc="";
    $date=date('d-m-Y');
    $time=date('H:i:sa');
		$imgPath="";

		//check form submission
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			//array to hold all errors
			$errors = array();

			//vars to upload image
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

			//check all fields are filled out
			if(empty($_POST['title'])){
				array_push($errors, "Please enter the event title.");
			}
			else{
				$title=trim($_POST['title']);
			}
			if(empty($_POST['desc'])){
				array_push($errors, "Please enter a description of the event.");
			}
			else{
				$desc=trim($_POST['desc']);
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

			//if there are no errors from the form or from uploading the image
			if(empty($errors)){
				//connect to database
				require ('connectDB.php');

				//fill variables
				$title = mysqli_real_escape_string($dbc, trim($title));
        $desc = mysqli_real_escape_string($dbc, trim($desc));
				$imgPath = mysqli_real_escape_string($dbc, trim($imgPath));

				//insert data into membership table
				$q1 = "Insert into news (title, description, newsTime, newsDate, image) values ('$title', '$desc', '$time', '$date', '$imgPath')";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//check query ran
				if($r1){
					echo "<h2>News post successfully created</h2>";
				}
				else{
					echo '<h1>System Error</h1>
					<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';

					echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q1 . '</p>';//debugging message
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


	<h1>Add News Post</h1>
	<!-- form to create news post -->
	<form action="news_create.php" method="post" id="news">
		<p>Title of Post: <input type="text" name="title" value="<?php echo $title ?>" /></p>
		<p>Description: </p>
    <p><textarea name="desc" form="news" rows="4" cols="40" value="<?php echo $desc ?>"></textarea></p>
		<p>Image: <input type="file" name="fileToUpload" id="fileToUpload" /></p>
		<p><input type="submit" name="Submit" value="submit" /></p>
</body>

</html>
