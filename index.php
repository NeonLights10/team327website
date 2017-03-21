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
	
	<!--Jumbotron-->
	<div style="z-index: -1">
		<div class="main-top-padding">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="main-center-float">
							<h2 class="fadeInUp animated">Welcome to ScoutCloud!</h2>
							<p>If you're a scouter, click the button below to open the scouting app.</p>
							<a href="/scouting/index.php"><button type="button" class="btn btn-info signup-button no-border-button">START SCOUTING</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Circle Image Links-->
	<div class="container-fluid">
		<div class="row section mini-panel1">
				<div class="iconlinks">
					<div class="col-lg-3">
						<a href="https://github.com/Team327/Competition16-17"><img class="img-circle" src="/images/github.jpg" alt="Generic placeholder image" width="100" height="100"></a>
						<h4>Github</h4>
					</div>
					<div class="col-lg-3">
						<a href="https://drive.google.com"><img class="img-circle" src="/images/google_drive.png" alt="Generic placeholder image" width="100" height="100"></a>
						<h4>Google Drive</h4>
					</div>
					<div class="col-lg-3">
						<a href="https://trello.com/b/WdQM8YI9"><img class="img-circle" src="/images/trello.png" alt="Generic placeholder image" width="100" height="100"></a>
						<h4>Trello</h4>
					</div>
				</div>
		</div>
	</div>	
	<!--Image-->
	<div class="container-fluid">
			<div class="center row section panel1">
				<!--<div class="col-md-6 col-md-offset-3">
					<h1>This is some filler text that is a header for the image.</h1>
				</div>-->
			</div>
		</div>
	<!--Text Panel-->
	<div class="container-fluid">
		<div class="row section panel2">
			<div class="col-md-6 col-md-offset-3" style="padding-bottom:10px;">
				<h2> Welcome to ScoutCloud/FTC Team 327</h2>
			</div>
			<div class="col-md-12 no-center">
			<h3>About ScoutCloud</h3>
			<h4>ScoutCloud is our attempt at making the scouting life in FTC easier. A lot of our team members found that scouting can be very hectic, having to scribble notes in a messy notebook and constantly looking up information. ScoutCloud attempts to consolidate the experience into an intuitive and easy to use system, with powerful search queries and the ability to view teams based on match performance, geographical information, or user input.</h4>
			<h3>About the Team</h3>
			<h4>We are Team 327, Caveman with Cloud. Our members currently attend the South Carolina Governor’s School for Science and Mathematics (GSSM). GSSM is a residential school that aims to bring academically motivated students from all over South Carolina together where they can specialize in STEM subjects in order to maximize their talents and better prepare for college. The school is purposefully designed to be more challenging than an average high school, with classes being taught in a college-style manner and schedule, and with high expectations and in-depth lesson plans. The students will attend GSSM during their junior and senior year of high school (having applied for admittance during their sophomore year).
			</h4>
			<h4>
			Team 327 was created in 2005, the inaugural year of  the FTC program. The team name and the majority of our team members change yearly as a result of the two-year timeframe of student attendance at GSSM. We have an experienced team of students this year; 10 of our team members have previously participated in FTC or FRC programs. The majority of our team members are a part of our team as a result of having chosen to take the robotics class at our school. Some students also attend team meetings as an extracurricular activity, but all team members participate and are viewed equally. The robotics class is graded based on our dedication and work ethic, follow-through on scheduled milestones for robot development, collaboration with the rest of the team, and the end of the semester performance of the robot.
			</h4>
			<h4>Together with team 772, our GSSM robotics teams have qualified for the World Championships in 2009 as well as the inaugural Southern Super-Regional in the 2014-2015 FTC season. Awards our team have earned in the past include the 2015-2016 South Carolina Regional PTC Design Award and Winning Alliance 2016-2017 at the South Carolina Regionals.
			</h4>
			<br>
			<!--Sponsor Panel-->
			<h2 class="center">
				Our Sponsors
			</h2>
			<div class="container-fluid">
				<div class="row section mini-panel1" style="background-color:white !important;">
					<div class="iconlinks">
						<div class="col-lg-3">
							<img class="img-logo" src="images/ftc.jpg" width=200px;>
						</div>
						<div class="col-lg-3">
							<img class="img-logo" src="images/2016_challenge.jpg" width=200px;>
						</div>
					</div>
					<div class="iconlinks">
						<div class="col-lg-3">
							<img class="img-logo" src="images/scgssm.png" width=400px; style="margin: 40px 0px;">
						</div>
					</div>
					<div class="iconlinks">
						<div class="col-lg-3">
							<img class="img-logo" src="images/gssm_foundation.png" width=400px; style="margin-bottom: 40px;">
						</div>
					</div>
					<div class="iconlinks">
						<div class="col-lg-3">
							<img class="img-logo" src="images/clemson.png" width=200px; style="margin-top:40px;">
						</div>
						<div class="col-lg-3">
							<img class="img-logo" src="images/lowes.png" width=200px; style="margin-top:10px;">
						</div>
					</div>
					<div class="iconlinks">
						<div class="col-lg-3">
							<img class="img-logo" src="images/1501.jpg" width=200px; style="margin-top:40px;">
						</div>
						<div class="col-lg-3">
							<img class="img-logo" width=200px; style="margin-top:10px;">
						</div>
					</div>
				</div>
			</div>	
			</div>
		</div>
	</div>	
	<!--Footer-->
   	<footer class="footer">
		<span class="text-muted">FTC Team 327 &COPY;2017 | SCGSSM</span>
    	<span class="text-muted right">Isaiah Ho</span>
    </footer>
    
    <script type="application/javascript" src="scripts/responsivenav.js"></script>
</body>
</html>

