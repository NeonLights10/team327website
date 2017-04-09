//TODO: Bulk Insert Teams
//		Insert One Team
//		Insert new field and value (one and many option)
//		Replace a team (wipe data clean besides basic)
//		Delete teams

//UI: Choose option, leads to page
//			Bulk Insert would be text box, use CSV format
//			Insert One Team would be a single line
//			Replace a team would ask for team number and confirmation
//			Delete teams would have checkboxes/dropdown <!--<select multiple>-->
<?php
session_start();
require_once("validate_login_admin.php");
require_once("session.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=0 initial-scale=0.75"/>
<title>Edit a Team</title>

<!-- Pull Boostrap and JQuery dependencies -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src='http://code.jquery.com/jquery-2.1.4.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Changes the Navbar to solid on scroll -->
<script src="/scripts/navbarAlter.js"></script>

<!-- Our main css file, holds the core styles -->
<link rel='stylesheet' href='/style/main.css'>
<link rel='stylesheet' href='/style/animate.css'>
</head>

<body class="scouting-buttons">
	<!--<div class="scouting-background2">
	</div>-->
	<ul class="nav navbar-nav" id="respnav">
					<span class="logo"><a href="/" style="color:black;"><img src="/images/logo.png" alt="Delta Drive" style="height:70px"/></a></span>
					<li class="navbutton"><a href="/scouting/index.php"><h4>Scouting</h4></a></li>
					<li class="navbutton"><a href="/scouting/teams.php"><h4>Teams</h4></a></li>
					<?php 
						if(isset($_SESSION['user_name'])) {
							echo '<li><a href="/login/login.php?logout"><h4>Sign Out, '. $_SESSION['first_name'] .'</h4></a></li>';
						}
						else {
							echo '<li><a href="/login/"><h4>Sign In</h4></a></li>';
						}
					?>
					<li class="navicon">
						<a href="javascript:void(0);" onclick="respnav()">&#9776;</a>
					</li>
				</ul>
	<div class="header_push">	
	</div>
	<div class="text-white center">	
		<?php
			if(isset($_SESSION['errors']))
			{
				echo '<mark><h4>' . $_SESSION['errors'] . "</h4></mark><br>";
				//Make sure the error only displays once (no persistance)
				unset($_SESSION['errors']);
			}
			if(isset($_SESSION['messages']))
			{
				echo '<mark>' . $_SESSION['messages'] . "</mark><br>";

				unset($_SESSION['messages']);
			}
		?>
	</div>
	<div class="header_push"></div>
	<h2>Hey! Remember that whenever you add or remove a field you NEED to update the template documents in /php/includes.</h2>