<!--************************************************
Author: Cassidy Bullock
Date: March 30, 2018
Description: navigation bar to be included on
						 every page
************************************************-->

<!doctype html>

<html>

<head>
	<!-- css style sheet -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- BootstrapCDN links-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>


<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
		<span class="navbar-brand">
			<!--<img src="img/navLogo.jpg" width="30" height="30" alt="">-->
			Sintori Sports Club
		</span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="home.php">Home</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Services
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Dance Classes</a>
						<a class="dropdown-item" href="#">Rock Climbing</a>
          				<a class="dropdown-item" href="#">Zorbing</a>
          				<a class="dropdown-item" href="#">Indoor Skydiving</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Membership</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="user_event_view.php">Events</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">News</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Contact Us</a>
				</li>
				<li class="nav-item"><?php // Create a login/logout link:
					if(isset($_SESSION['user'])) {
						echo '<a class="nav-link" href="logout.php">Logout</a>';
					} else {
						echo '<a class="nav-link" href="staffLogin.php">Staff Login</a>';
					} ?>
				</li>
			</ul>
		</div>
	</nav>
</body>

</html>
