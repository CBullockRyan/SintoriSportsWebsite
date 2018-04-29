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
	<title>Edit Content for Dance Classes</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://cdn.ckeditor.com/ckeditor5/10.0.0/classic/ckeditor.js"></script>
</head>

<body>
	<?php include ('nav_staff.inc.php');

    //connect to database
    require ('connectDB.php');

    //query to get data for Dance
    $q = "SELECT title, content FROM content WHERE contentID = 1";
    $r = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r);

		//Create vars
		$title = $row[0];
		$content = $row[1];

		//check form submission
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			//array to hold all errors
			$errors = array();

			//check all fields are filled out
			if(empty($_POST['title'])){
				array_push($errors, "Please enter the page title.");
			}
			else{
				$title=trim($_POST['title']);
			}
			if(empty($_POST['content'])){
				array_push($errors, "Please enter some content for the page.");
			}
			else{
				$content=trim($_POST['content']);
			}

			//if there are no errors from the form or from uploading the image
			if(empty($errors)){

				//fill variables
				$title = mysqli_real_escape_string($dbc, trim($title));
        $content = mysqli_real_escape_string($dbc, trim($content));

				//insert data
				$q1 = "UPDATE content SET title = '$title', content='$content' WHERE contentID=1 LIMIT 1";
				$r1 = @mysqli_query($dbc, $q1); //run query

				//check query ran
				if($r1){
					echo "<h2>Content Successfully Saved</h2>";
				}
				else{
					echo '<h1>System Error</h1>
					<p class="error">Content could not be registered due to system error. We apologize for any inconvenience.</p>';

				//	echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: ' . $q1 . '</p>';//debugging message
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

	<h1>Edit Content for Dance Classes</h1>
	<!-- form to edit content -->
	<form action="content_dance.php" method="post" id="dance">
		<p>Title of Page: <input class='col-3 form-control' type="text" name="title"  value="<?php echo $title ?>" /></p>
		<p>Description: </p>
    <p><textarea class='col-8 form-control' name="content" id = "editor" form="dance" rows="4" cols="40" ><?php echo $content ?></textarea></p>
		<p><input class='btn btn-outline-info' type="submit" name="Save" value="submit" /></p>
    <script>
			ClassicEditor
				.create( document.querySelector( '#editor' ) )
				.catch( error => {
						console.error( error );
				} );
    </script>
  </form>
</body>

</html>
