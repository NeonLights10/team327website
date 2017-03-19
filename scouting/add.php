<?php
session_start();
require_once("validate_login.php");
require_once("session.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=0 initial-scale=0.75"/>
<title>Add a Team</title>

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

<body>
	<div class="scouting-background2">
	</div>
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
	<div class="center">		
		<div class="editform">
			<h2 style="text-align:center;">Add a Team to your Notebook</h2>
			<div class="container-fluid center">
				<form action="teamedit.php?ref=add" name="addteam" method="post" class="teamform">
					<fieldset>
						Team Number: 
						<span class="required">*</span>
						<br>
						<input type="text" length="60" name="team_number" style="margin-right: 10px;" required="required" aria-required="true"
						pattern="^([0-9]{1,5})$" title="Team Number"/>
						<span class="error" id="email_error"></span>
						<br>
						Team Name:
						<br>
						<input type="text" length="60" name="team_name" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+[\'-]?){1,15}$" style="margin-bottom: 10px; margin-right: 10px" 
						title="Team Name (No special characters)"/>
						<span class="error" id="name_error"></span>
						<br>
						<br>
						<input type="submit" class="btn btn-default add-btn" value="Go"/>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<footer class="footer" style="background-color:rgba(0,0,0,0) !important;">
		<span class="text-white">FTC Team 327 &COPY;2017 | SCGSSM</span>
		<span class="text-white right">Isaiah Ho</span>
	</footer>

	<script type="application/javascript" src="../scripts/responsivenav.js"></script>
</body>
</html>