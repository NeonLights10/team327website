<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=0;"/>
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
	<ul class="nav navbar-nav" id="respnav">
		<span class="logo"><a href="/" style="color:black;"><img src="/images/logo.png" alt="Delta Drive" style="height:70px"/></a></span>
		<li class="navbutton"><a href="/index.php"><h4>Home</h4></a></li>
		<li class="navbutton"><a href="/teams.php"><h4>Teams</h4></a></li>
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
	<div class="container-fluid">
		
	</div>
</body>
</html>