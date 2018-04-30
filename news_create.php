<!--************************************************
Author: Cassidy Bullock
Date: April 20, 2018
Description: Create a news post
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
	<script src="https://cdn.ckeditor.com/ckeditor5/10.0.0/classic/ckeditor.js"></script>
</head>

<body>
	<?php include ('nav_staff.inc.php'); ?>

	<?php
		//Create vars for news table
		$title="";
		$desc="";
    $date=date('Y-m-d H:i:s');

		//check form submission
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			//array to hold all errors
			$errors = array();

			//check all fields are filled out
			if(empty($_POST['title'])){
				array_push($errors, "Please enter the event title.");
			}
			else{
				$title=htmlspecialchars(trim($_POST['title']));
			}
			if(empty($_POST['desc'])){
				array_push($errors, "Please enter a description of the event.");
			}
			else{
				$desc=trim($_POST['desc']);
			}

			//if there are no errors from the form
			if(empty($errors)){
				//connect to database
				require ('connectDB.php');

				//fill variables
				$title = mysqli_real_escape_string($dbc, trim($title));
        $desc = mysqli_real_escape_string($dbc, trim($desc));

				//insert data into membership table
				$q1 = "Insert into news (title, description, newsDate) values ('$title', '$desc', '$date')";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//check query ran
				if($r1){
					echo "<h2>News post successfully created</h2>";
				}
				else{
					echo '<h1>System Error</h1>
					<p class="error">You could not be registered due to system error. We apologize for any inconvenience.</p>';

				//	echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q1 . '</p>';//debugging message
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


	<h1>Add News Post</h1>
	<!-- form to create news post -->
	<form action="news_create.php" method="post" id="news">
		<p>Title of Post: <input class='col-3 form-control' type="text" name="title" value="<?php echo $title ?>" /></p>
		<p>Description: </p>
    <p><textarea class='col-8 form-control' name="desc" id="editor" form="news" rows="4" cols="40" ><?php echo $desc ?></textarea></p>
		<p><input class='btn btn-outline-info' type="submit" name="Submit" value="submit" /></p>
		<!-- script to make wysiwyg text box-->
		<script>
			ClassicEditor
				.create( document.querySelector( '#editor' ) )
				.catch( error => {
						console.error( error );
				} );
    </script>
</body>

</html>
