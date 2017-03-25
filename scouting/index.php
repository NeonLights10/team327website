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

<body class="scouting-buttons">
	<!--<div class="scouting-background">
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
		<div class="header_push"></div>
		<div class="header_push"></div>
		<div class="row center">	
			<div class="col-xs-12 col-sm-6">
				<!--<div class="container-fluid">-->
					<h2>Welcome to ScoutCloud v0.8β</h2>
						<!--<div class="row section panel3">-->
						<div class="container-fluid center">
							<a href="/scouting/search.php" class="btn btn-info scouting-button no-border-button" id="scout1">Search</a><br>
						</div>
							<!--<a href="/scouting/add.php"><button type="button" class="btn btn-success scouting-button no-border-button" id="scout2">Add</button></a><br>-->
						<div class="container-fluid center">
							<a href="/scouting/edit.php" class="btn btn-danger scouting-button no-border-button" id="scout3">Edit</a><br>
						</div>
						<div class="container-fluid center">
							<a href="/scouting/teams.php"class="btn btn-warning scouting-button no-border-button" id="scout4">Teams</a>
						</div>
				
			</div>
		</div>
		<footer class="footer" style="background-color:rgba(0,0,0,0) !important;">
			<span class="text-muted">FTC Team 327 &COPY;2017 | SCGSSM</span>
			<span class="text-muted right"><a href="mailto:iho17@gssm.k12.sc.us">Contact us if you have issues</a></span>
		</footer>

		<script type="application/javascript" src="../scripts/responsivenav.js"></script>
</body>
</html>
