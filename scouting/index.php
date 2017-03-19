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
<title>Scouting App</title>

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
</head>

<body>
	<div class="scouting-background">
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
		<div class="header_push"></div>
		<div class="header_push"></div>
		<div class="center">		
			<div class="scouting-buttons">
				<div class="container-fluid">
					<h3>Welcome to <br>Cloud Scout v0.8β</h3>
					<div class="col-xs-6">
						<div class="section panel3">
							<a href="/scouting/search.php"><button type="button" class="btn btn-info scouting-button no-border-button" id="scout1">Search</button></a><br>
							<!--<a href="/scouting/add.php"><button type="button" class="btn btn-success scouting-button no-border-button" id="scout2">Add</button></a><br>-->
							<a href="/scouting/edit.php"><button type="button" class="btn btn-danger scouting-button no-border-button" id="scout3">Edit</button></a><br>
							<a href="/scouting/teams.php"><button type="button" class="btn btn-warning scouting-button no-border-button" id="scout4">Teams</button></a>
						</div>	
					</div>
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