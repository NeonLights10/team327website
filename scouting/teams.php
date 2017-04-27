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
<title>Teams</title>

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
<body class="scouting-background3">
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
	<h2 style="padding-left:20px;">Teams</h2>
	<hr>
	<?php
		require '../../vendor/autoload.php';
		(require_once("dbcreds.php")) or die("Unable to access database ERR:1");
		$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->teams;

		//Search query with no search parameters
		$cursor = $collection->find(
			[],
			[
				'projection' => [
					'team_number' => 1,
					'team_name' => 1,
					'team_division' => 1,
				],
				//Limits results at 100, can be changed
				'limit' => 100,
			]
		);
		//echo("<table>");
		foreach($cursor as $document) {
			//echo("<tr><td>" .$document['team_number'] . "</td><td>" . $document['team_name'] . "</td></tr>");
			$num = (int) $document['team_number'];
			$name = $document['team_name'];
			$team_division = $document['team_division'];
			include("../temp/team_format.php");
		};
	?>
	<footer class="footer footer-muted">
		<span class="text-muted">FTC Team 327 &COPY;2017 | SCGSSM</span>
    	<span class="text-muted right"><a href="mailto:iho17@gssm.k12.sc.us">Contact us if you have issues</a></span>
    </footer>
	<script type="application/javascript" src="../scripts/responsivenav.js"></script>
</body>
</html>
