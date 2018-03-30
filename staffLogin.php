<!--************************************************
Author: Cassidy Bullock
Date: March 30, 2018
Description: staff login page
************************************************-->
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
?>

<!doctype html>

<html>

<head>
	<title>Login</title>
</head>

<body>
	<?php
		//variables for login
		$staffID="";
		$staffPass="";
		$DBstaffID="";
		$DBstaffPass="";

		//variables for any errors
		$errID="";
		$errPass="";
		$errLogin="";

		//function for security of entered data
		function validateInput($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		//check that login has been entered
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			//validate that information has been entered correctly
			if(empty($_POST['staffID'])){
				$errID="Please enter staff id. <br/>";
			}
			else{
				$staffID = validateInput($_POST['staffID']);
			}
			if(empty($_POST['staffPass'])){
				$errPass="Please enter password. <br/>";
			}
			else{
				$staffPass = validateInput($_POST['staffPass']);
			}

			//check the login if there are no errors
			if(empty($errID && $errPass)){
				// connect to database
				require ('connectDB.php');

				//check that ID and password match DB
				//escape special characters
				$staffID = mysqli_real_escape_string($dbc, validateInput($staffID));
				$staffPass = mysqli_real_escape_string($dbc, validateInput($staffPass));

				//encode password using sha1
				$staffPass = sha1($staffPass);

				//get database staff login info
				$q = "SELECT staffID, staffPass FROM staff";
				$r = @mysqli_query($dbc, $q);

				$row = mysqli_fetch_array($r);

				$DBstaffID = $row[0];
				$DBstaffPass = $row[1];

				//check if information matches
				if($DBstaffID == $staffID){
					if($DBstaffPass == $staffPass){
						//set user
						$_SESSION['user']="admin";

						//extra security
						$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

						//redirect to logged in
						require ('redirect.inc.php');
						redirect('loggedin.php');
					}
					else{
						$errLogin="ID and password do not match. <br/>";
					}
				}
				else{
					$errLogin="That admin ID does not exist. <br/>";
				}

				//diconnect from database
				mysqli_close($dbc);

				exit();
			}
		}
	?>

	<?php include ('nav.inc.php'); ?>

	<h1>Staff Login</h1>
	<form action="staffLogin.php" method="post">
		<p>Staff ID: <input type="text" name="staffID" maxlength="20" />
		<span class="error"><?php echo $errID ?></span></p>
		<p>Password: <input type="password" name="staffPass" maxlength="40" />
		<span class="error"><?php echo $errPass ?></span></p>
		<p><input type="submit" name="submit" value="submit" /></p>
		<span class="error"><?php echo $errLogin ?></span>
</body>

</html>
