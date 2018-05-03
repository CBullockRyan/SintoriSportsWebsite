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
	<!-- Sketchy Theme from bootswatch.com -->
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<!-- BootstrapCDN links-->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>


<body>

	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
		<span class="navbar-brand">
			Sintori Sports Club
		</span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Manage Membership
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="membership_create.php">New Membership</a>
						<a class="dropdown-item" href="membership_update.php">Update Membership</a>
						<?php if($_SESSION['user']=='manager') : ?>
							<a class="dropdown-item" href="membership_viewall.php">View Memberships</a>
							<a class="dropdown-item" href="member_viewall.php">View Members</a>
						<?php endif; ?>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="payment_create.php">Make Payment</a>
				</li>
				<?php
					//add manager settings
				if($_SESSION['user']=='manager') : ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Manage Staff
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="staff_create.php">Add Staff</a>
						<a class="dropdown-item" href="staff_viewall.php">View Staff</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Membership Type
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="type_create.php">Add Type</a>
						<a class="dropdown-item" href="type_viewall.php">View Types</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Events
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="event_create.php">Add Event</a>
						<a class="dropdown-item" href="event_viewall.php">View Events</a>
					</div>
				</li>
				<li class='nav-item'>
					<a class="nav-link" href="news_create.php">Add News</a>
				</li>
				<li class='nav-item'>
					<a class="nav-link" href="enquiry_viewall.php">Enquiries</a>
				</li>
				<li class='nav-item'>
					<a class="nav-link" href="location_update.php">Contact Details</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Reports
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="report_payment.php">Membership Payments</a>
						<a class="dropdown-item" href="report_membership.php">Membership Status</a>
						<a class="dropdown-item" href="report_enquiry.php">Enquiry Status</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  User Content
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="content_home.php">Home</a>
						<a class="dropdown-item" href="content_membership.php">Memberships</a>
						<a class="dropdown-item" href="content_dance.php">Dance Classes</a>
						<a class="dropdown-item" href="content_rock.php">Rock Climbing</a>
						<a class="dropdown-item" href="content_hurling.php">Hurling/Camogie</a>
						<a class="dropdown-item" href="content_skydiving.php">Indoor Skydiving</a>
					</div>
				</li>
			<?php	endif; ?>
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
