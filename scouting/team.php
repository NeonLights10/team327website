<?php
	//Initialize session and load dependencies
	session_start();
	require_once("validate_login.php");
	require_once("session.php");
	require '../../vendor/autoload.php';
	(require_once("dbcreds.php")) or die("Unable to access database ERR:1");
	
	//Setup successful marker
    $successful = false;
	//Retrieve team we are looking up
	$team = htmlspecialchars($_GET['team']);
	//Retrieve which team's database we should pull info from
	$team_db = $_SESSION['user_team'];
	$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->$team_db;
			$cursor = $collection->findOne(
				['team_number' => (int) $team],
				[
					'projection' => [
						'team_number' => 1,
						'team_name' => 1,
						'team_school' => 1,
						'team_city' => 1,
						'team_state' => 1,
						'team_captain' => 1,
						'cap_ability_teleop' => 1,
						'low_projectile_ability_teleop' => 1,
						'high_projectile_ability_teleop' => 1,
						'beacon_ability_teleop' => 1,
						'cap_ability_auto' => 1,
						'low_projectile_ability_auto' => 1,
						'high_projectile_ability_auto' => 1,
						'beacon_ability_auto' => 1,
						'notes' => 1,
					],
				]
			);
			if($cursor == null) {
				//echo "Document does not exist";
				$_SESSION['errors'] = "Team does not exist!";
				header("Location: ../scouting/index.php");
			}
			if(!isset($cursor['team_name'])) {
				$cursor['team_name'] = "";
			}
			if(!isset($cursor['team_school'])) {
				$cursor['team_school'] = "";
			}
			if(!isset($cursor['team_city'])) {
				$cursor['team_city'] = "";
			}
			if(!isset($cursor['team_state'])) {
				$cursor['team_state'] = "";
			}
			if(!isset($cursor['team_captain'])) {
				$cursor['team_captain'] = "";
			}
			if(!isset($cursor['cap_ability_teleop'])) {
				$cursor['cap_ability_teleop'] = false;
			}
			if(!isset($cursor['low_projectile_ability_teleop'])) {
				$cursor['low_projectile_ability_teleop'] = false;
			}
			if(!isset($cursor['high_projectile_ability_teleop'])) {
				$cursor['high_projectile_ability_teleop'] = false;
			}
			if(!isset($cursor['beacon_ability_teleop'])) {
				$cursor['beacon_ability_teleop'] = false;
			}
			if(!isset($cursor['cap_ability_auto'])) {
				$cursor['cap_ability_auto'] = false;
			}
			if(!isset($cursor['low_projectile_ability_auto'])) {
				$cursor['low_projectile_ability_auto'] = false;
			}
			if(!isset($cursor['high_projectile_ability_auto'])) {
				$cursor['high_projectile_ability_auto'] = false;
			}
			if(!isset($cursor['beacon_ability_auto'])) {
				$cursor['beacon_ability_auto'] = false;
			}
			if(!isset($cursor['notes'])) {
				$cursor['notes'] = "";
			}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=0 initial-scale=0.75"/>
<?php
	echo '<title>' . $team . ' | ' . $cursor['team_name'] . '</title>'
?>

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
	<div style="display:flex;">	
	<div><a href="#" onclick="window.history.back();"><img src="../images/arrow-left.png" style="padding:22px 0px 0px 10px;"></img></a></div>
	<h2 style="padding-left:15px; font-weight:bold;">
	<?php
		echo $cursor['team_number'] . " | " . $cursor['team_name'];
	?>
	<?php echo '<a href="teamedit.php?team=' . $cursor['team_number'] . '">'?></h2><button style="margin:20px 20px 0px 20px; font-size:18px;" class="btn btn-danger">Edit</button></a>
	</div>
	<hr>
	<div class="container-fluid">	
		<table class="teamtable">
			<tr>
				<th class="teamlabel">School</th>
				<td><?php echo $cursor['team_school']?></td>
			</tr>
			<tr>
				<th class="teamlabel">City</th>
				<td><?php echo $cursor['team_city']?></td>
			</tr>
			<tr>
				<th class="teamlabel">State</th>
				<td><?php echo $cursor['team_state']?></td>
			</tr>
			<tr>
				<th class="teamlabel">Captain</th>
				<td><?php echo $cursor['team_captain']?></td>
			</tr>
		</table>
		<hr>
		<div class="row">
			<div class="col-lg-3">
				<h3 class="teamheading">TeleOp Capabilities</h3>
				<table class="teamtable">
					<tr>
						<td class="teamlabel">Cap Ball</td>
						<td><?php if($cursor['cap_ability_teleop']) { echo '✔️';} else { echo '❌';} ?></td>
					</tr>
					<tr>
						<td class="teamlabel">Low Goal Projectile Scoring</td>
						<td><?php if($cursor['low_projectile_ability_teleop']) { echo '✔️';} else { echo '❌';} ?></td>
					</tr>
					<tr>
						<td class="teamlabel">High Goal Projectile Scoring</td>
						<td><?php if($cursor['high_projectile_ability_teleop']) { echo '✔️';} else { echo '❌';} ?></td>
					</tr>
					<tr>
						<td class="teamlabel">Beacon Scoring</td>
						<td><?php if($cursor['beacon_ability_teleop']) { echo '✔️';} else { echo '❌';} ?></td>
					</tr>
				</table>
			</div>
			<div class="col-lg-3">
				<h3 class="teamheading">Autonomous Capabilities</h3>
				<table class="teamtable">
					<tr>
						<td class="teamlabel">Knock Cap Ball</td>
						<td><?php if($cursor['cap_ability_auto']) { echo '✔️';} else { echo '❌';} ?></td>
					</tr>
					<tr>
						<td class="teamlabel">Low Goal Projectile Scoring</td>
						<td><?php if($cursor['low_projectile_ability_auto']) { echo '✔️';} else { echo '❌';} ?></td>
					</tr>
					<tr>
						<td class="teamlabel">High Goal Projectile Scoring</td>
						<td><?php if($cursor['high_projectile_ability_auto']) { echo '✔️';} else { echo '❌';} ?></td>
					</tr>
					<tr>
						<td class="teamlabel">Beacon Scoring</td>
						<td><?php if($cursor['beacon_ability_auto']) { echo '✔️';} else { echo '❌';} ?></td>
					</tr>
				</table>
			</div>
		</div>	
		<hr>
		<h3 class="teamheading">Notes</h3>
		<h4><?php echo $cursor['notes'];?></h4>
		<hr>
		<h3 class="teamheading">Comments</h3>
		<!-- Add a error section here -->
		<form action="commentsubmit.php" name="comment-submit" method="post" class="comment-form">
			<textarea name="comment" class="comment-textarea" pattern="[\w\s\W]{1,400}"></textarea>
			<br>
			<input type="submit" class="btn btn-default comment-btn" value="Submit"/>
		</form>
		<?php include("comment-format.php"); ?>
	</div>
	<footer class="footer footer-muted">
		<span class="text-muted">FTC Team 327 &COPY;2017 | SCGSSM</span>
    	<span class="text-muted right">Isaiah Ho</span>
    </footer>
	<script type="application/javascript" src="../scripts/responsivenav.js"></script>
</body>	
</html>