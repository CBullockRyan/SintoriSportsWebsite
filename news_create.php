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
		//Create vars for form data
		$title="";
		$desc="";
    $date=date('d-m-Y');
    $time=date('H:i:sa');
		$img="";

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
      if (empty($_POST['img'])){
        array_push($errors, "Please add an image. <br/>");
      }
      else{
        $img = $_POST['img'];
      }


			if(empty($errors)){
				//connect to database
				require ('connectDB.php');

				//fill variables
				$title = mysqli_real_escape_string($dbc, trim($title));
        $desc = mysqli_real_escape_string($dbc, trim($desc));
				$img = mysqli_real_escape_string($dbc, trim($img));

				//insert data into membership table
				$q1 = "Insert into news (title, description, newsTime, newsDate, image) values ('$title', '$desc', '$time', '$date', '$img')";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//check query ran
				if($r1){
					echo "<h2>News post successfully created</h2>";
				}
				else{
					echo '<h1>System Error</h1>
					<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';

					//echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q1 . '</p>';
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
		<p>Image: <input type="number" name="max" value="<?php echo $max ?>" /></p>
		<p><input type="submit" name="Submit" value="submit" /></p>
</body>

</html>
