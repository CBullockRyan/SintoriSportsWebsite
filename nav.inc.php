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
	<!-- Minty Theme from bootswatch.com -->
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<!-- BootstrapCDN js links-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>


<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Sintori Sports Club</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="user_home.php">Home</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Services
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="user_dance.php">Dance Classes</a>
						<a class="dropdown-item" href="user_rock.php">Rock Climbing</a>
          				<a class="dropdown-item" href="user_hurling.php">Hurling/Camogie</a>
          				<a class="dropdown-item" href="user_skydiving.php">Indoor Skydiving</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="user_membership.php">Membership</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="user_event_view.php">Events</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="user_news.php">News</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="user_contact.php">Contact Us</a>
				</li>
				<li class="nav-item"><?php // Create a login/logout link:
					if(isset($_SESSION['user'])) {
						echo '<a class="nav-link" href="logout.php">Logout</a>';
					} else {
						echo '<a class="nav-link" href="login_form.php">Staff Login</a>';
					} ?>
				</li>
			</ul>
		</div>
	</nav>
</body>

</html>
