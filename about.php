<?php
session_start();
require_once("session.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=0 initial-scale=0.75"/>
<title>FTC 327 | Caveman with Cloud</title>

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

<body class="mainbackground">
	<!--Navbar-->
	<ul class="nav navbar-nav" id="respnav">
		<span class="logo"><a href="/" style="color:black;"><img src="/images/logo.png" alt="Delta Drive" style="height:70px"/></a></span>
		<li class="navbutton"><a href="/index.php"><h4>Home</h4></a></li>
		<li class="navbutton"><a href="/about.php"><h4>Roster</h4></a></li>
		<li class="navbutton"><a href="/scouting/index.php"><h4>Scouting</h4></a></li>
		<li class="navbutton"><a href="/contact.php"><h4>Contact Us</h4></a></li>
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
	<div class="container-fluid well main-top-padding">
		<h2>Leadership</h2>
		<ul>
			<li>Hunter Damron: Team Captain, Programming Lead</li>
			
			<li>James Johnson: Safety Captain</li>
			<li>Kaitlyn Baldizzi: Public Relations Lead</li>
			<li>Cray Johnson: Mechanical Lead</li>
		</ul>
		<h2>Mechanical Team</h2>
		<ul>
			<li>Cray Johnson</li>
			<li>Chloe Harris</li>
<li>Chelse VanAtter</li>
<li>Isaiah Ho</li>
<li>James Johnson</li>
<li>Hunter Damron</li>
<li>Anthony Rockwell</li>
<li>Duncan Harmon</li>
<li>Brennan Cain</li>
<li>Michelle Huang</li>
</ul>
<h2>Programming Team</h2>
<ul>
<li>Hunter Damron</li>
<li>Duncan Harmon</li>
<li>Brennan Ravan</li>
<li>Brennan Cain</li>
<li>James Johnson</li>
<li>Isaiah Ho</li>
</ul>
<h2>Public Relations Team</h2>
<ul>
<li>Kaitlyn Baldizzi</li>
<li>Chloe Harris</li>
<li>Brennan Cain</li>
<li>Duncan Harmon</li>
<li>Isaiah Ho</li>
<li>Chelse VanAtter</li>
</ul>
	</div>	
	<!--Footer-->
   	<footer class="footer">
		<span class="text-muted">FTC Team 327 &COPY;2017 | SCGSSM</span>
    	<span class="text-muted right">Isaiah Ho</span>
    </footer>
    
    <script type="application/javascript" src="scripts/responsivenav.js"></script>
</body>
</html>
