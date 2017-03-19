<?php
	//Initialize session and load dependencies
	session_start();
	require_once("validate_login.php");
	require_once("session.php");
	require '../../vendor/autoload.php';
	(require_once("dbcreds.php")) or die("Unable to access database ERR:1");
	
	//Setup successful marker and get any page references
    $successful = false;
	$cursor;

	//Retrieve team user belongs to
	$team_db = (string) $_SESSION['user_team'];
	$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->$team_db;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//echo "Post received";
		// collect value of input field
		if (isset($_POST['team_number'])) { $number = test_input($_POST['team_number']); }
		if (isset($_POST['team_name'])) { $name = test_input((string) $_POST['team_name']); }
		if (isset($_POST['team_school'])) { $school = test_input((string) $_POST['team_school']); }
		if (isset($_POST['team_city'])) { $city = test_input((string) $_POST['team_city']); }
		if (isset($_POST['team_state'])) { $state = test_input((string) $_POST['team_state']); }
		if (isset($_POST['team_captain'])) { $captain = test_input((string) $_POST['team_captain']); }
		$cap_ability_teleop = IsChecked('abilities','cap_ability_teleop');
		$low_projectile_ability_teleop = IsChecked('abilities','low_projectile_ability_teleop');
		$high_projectile_ability_teleop = IsChecked('abilities','high_projectile_ability_teleop');
		$beacon_ability_teleop = IsChecked('abilities','beacon_ability_teleop');
		$cap_ability_auto = IsChecked('abilities','cap_ability_auto');
		$low_projectile_ability_auto = IsChecked('abilities','low_projectile_ability_auto');
		$high_projectile_ability_auto = IsChecked('abilities','high_projectile_ability_auto');
		$beacon_ability_auto = IsChecked('abilities','beacon_ability_auto');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=0 initial-scale=0.75"/>
<title>Search Results</title>

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
	<h2 style="padding-left:20px;">Search Results</h2>
	<hr>
<?php
	if (empty($number) && empty($name) && empty($school) && empty($city) && empty($state) && empty($captain) && ($cap_ability_teleop == false) && ($low_projectile_ability_teleop == false) && ($high_projectile_ability_teleop == false) && ($beacon_ability_teleop == false) && ($cap_ability_auto == false) && ($low_projectile_ability_auto == false) && ($low_projectile_ability_auto == false) && ($high_projectile_ability_auto == false) && ($beacon_ability_auto == false)) {
		//echo "All empty";
		$cursor = $collection->find(
			[],
			[
				'projection' => [
					'team_number' => 1,
					'team_name' => 1,
				],
			]
		);
		//var_dump($cursor);
		foreach($cursor as $document) {
			//echo("<tr><td>" .$document['team_number'] . "</td><td>" . $document['team_name'] . "</td></tr>");
			$num = (int) $document['team_number'];
			$name = $document['team_name'];
			include("../temp/team_format.php");
		};

	} 
	else {
		//echo "Not all empty";
		$filter = array();
		if(!empty($number)) {
			$filter['team_number'] = (int) $number;
		}
		if(!empty($name)) {
			$filter['team_name'] = new MongoDB\BSON\Regex($name, 'i');
		}
		if(!empty($school)) {
			$filter['team_school'] = new MongoDB\BSON\Regex($school, 'i');
		}
		if(!empty($city)) {
			$filter['team_city'] = new MongoDB\BSON\Regex($city, 'i');
		}
		if(!empty($state)) {
			$filter['team_state'] = new MongoDB\BSON\Regex($state, 'i');
		}
		if(!empty($captain)) {
			$filter['captain'] = new MongoDB\BSON\Regex($captain. 'i');
		}
		if($cap_ability_teleop) {
			$filter['cap_ability_teleop'] = true;
		}
		if($low_projectile_ability_teleop) {
			$filter['low_projectile_ability_teleop'] = true;
		}
		if($high_projectile_ability_teleop) {
			$filter['high_projectile_ability_teleop'] = true;
		}
		if($beacon_ability_teleop) {
			$filter['beacon_ability_teleop'] = true;
		}
		if($cap_ability_auto) {
			$filter['cap_ability_auto'] = true;
		}
		if($low_projectile_ability_auto) {
			$filter['low_projectile_ability_auto'] = true;
		}
		if($high_projectile_ability_auto) {
			$filter['high_projectile_ability_auto'] = true;
		}
		if($beacon_ability_auto) {
			$filter['beacon_ability_auto'] = true;
		}
		$cursor = $collection->find(
			$filter,
			[
				'projection' => [
					'team_number' => 1,
					'team_name' => 1,
				],
			]
		);
		if($cursor == null) {
			echo "No results found.";
		}
		else {
			foreach($cursor as $document) {
				//echo("<tr><td>" .$document['team_number'] . "</td><td>" . $document['team_name'] . "</td></tr>");
				$num = (int) $document['team_number'];
				$name = $document['team_name'];
				include("../temp/team_format.php");
			};
		}
	}
}
	//echo "exit state";
	function test_input($data) {
		$data = trim($data);
  		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function IsChecked($chkname,$value) {
		if(!empty($_POST[$chkname])) {
			foreach($_POST[$chkname] as $chkval) {
				if($chkval == $value) {
					return true;
				}
			}
		}
		return false;
	}
?>
