<?php
	//Initialize session and load dependencies
	session_start();
	require_once("validate_login.php");
	require_once("session.php");
	require '../../vendor/autoload.php';
	(require_once("dbcreds.php")) or die("Unable to access database ERR:1");
	
	//Setup successful marker and get any page references
    $successful = false;
	if(isset($_GET['ref'])){
		$ref = htmlspecialchars($_GET['ref']);
	}
	else {
		$ref = "";
	}
	//Initialize cursor for query
	$cursor;

	//Retrieve team user belongs to and initialize database connection
	$team_db = (string) $_SESSION['user_team'];
	$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->$team_db;

	//Checks to see if the page has made a request to the server (either POST or GET in this instance)
	if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
		// TODO: fix jerry-rig GET option for edit button on team page (unsure how to do)
		// If sent from clicking the "edit" button on a team page, grab the team number
		if(isset($_GET['team'])) {
			$number = (int) htmlspecialchars($_GET['team']);	
			$name = "";
		}
		//Else get the team number from the form on edit.php which was sent through POST
		else if(!isset($_GET['team'])){
			$number = (int) $_POST['team_number'];
			//If the number is empty, return an error and redirect accordingly
			if (empty($number)) {
				$_SESSION['errors'] = "Team Number is empty";
				redirect($ref);	
			} 
			$name = (string) $_POST['team_name'];
		}
		//Checks various data constraints for data validation
		if ($number<100000 && strlen($name) <= 128
            && preg_match('/^([&|-|a-z\d-*,]+\s*)*$/i', $name)) {
			//echo "Looking up document...";
			$name = test_input($name);
  			$team = test_input($number);
			/* 
			 * Main query for team information. 
			 * Sets up the cursor which queries the collection and retrieves information and stores it.
			 */
			$cursor = $collection->findOne(
				['team_number' => (int) $team],
				[
					'projection' => [
						//CHANGE THESE VALUES WHEN UPDATING FIELDS
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
			/*
			 * Main Data Validation
			 * Checks for any null values and sets them to a blank value so that it can be displayed in an input box.
			 */
			//CHANGE THESE VALUES WHEN UPDATING FIELDS
			if($cursor == null) {
				//echo "Document does not exist";
				$_SESSION['errors'] = "Team does not exist!";
				redirect($ref);
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
		}
	//Was query successful? Yes
	$successful = true;
	}
	//Error returned when page does not send a POST or GET request.
	else {
		$_SESSION['errors'] = "Data was not sent to the server in the correct format. ERR:4";
		redirect($ref);
	}

	function test_input($data) {
		$data = trim($data);
  		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function redirect($ref) {
		if($ref == "add") {
			header("Location: ../scouting/add.php");
		}
		else if ($ref == "edit") {
			header("Location: ../scouting/edit.php");
		}
		else {
			//header("Location: ../scouting/index.php");
		}
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=0 initial-scale=0.75"/>
<?php
	if($ref == "add") {
		echo '<title>Add a Team</title>';
	}
	else if($ref == "edit") {
		echo '<title>Edit a Team</title>';
	}
	else {
		echo '<title>Team Edit Template</title>';
	}
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
	<h2 style="padding-left:15px; font-weight:bold;">
	<?php
		//Displays Team Number and Team Name at the top header
		echo $cursor['team_number'] . " | " . $cursor['team_name'];
	?>
	</h2>
	<hr>
	<div class="container-fluid">	
	<form action="teamsubmit.php" name="team-edit" method="post" class="teamedit">
		<input style="visibility:hidden;" type="text" name="team_number" value=<?php echo '"' . $cursor['team_number'] . '"';?>/>
		<input style="visibility:hidden;" type="text" name="team_name" value=<?php echo '"' . $cursor['team_name'] . '"';?>/>
		<fieldset>
			Team School
			<br>
			<?php
				//Displays team school
				echo '<input type="text" length="128" name="team_school" value="' . $cursor['team_school'] . '" class="teamedit-input"/>';
			?>
			<br>
			Team City
			<br>
			<?php
				//Displays team city
				echo "<input type='text' length='128' name='team_city' pattern='^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?){1,5}$' value='" . $cursor['team_city'] . "'class='teamedit-input'/>";
			?>
			<br>
			Team State
			<br>
			<?php
				//Sets up an array of states and associates them with their respective abbreviations so that it matches the format that is stored in the db
				$states = array( 'Alabama'=>'AL', 'Alaska'=>'AK', 'Arizona'=>'AZ', 'Arkansas'=>'AR', 'California'=>'CA', 'Colorado'=>'CO', 'Connecticut'=>'CT', 'Delaware'=>'DE', 'Florida'=>'FL', 'Georgia'=>'GA', 'Hawaii'=>'HI', 'Idaho'=>'ID', 'Illinois'=>'IL', 'Indiana'=>'IN', 'Iowa'=>'IA', 'Kansas'=>'KS', 'Kentucky'=>'KY', 'Louisiana'=>'LA', 'Maine'=>'ME', 'Maryland'=>'MD', 'Massachusetts'=>'MA', 'Michigan'=>'MI', 'Minnesota'=>'MN', 'Mississippi'=>'MS', 'Missouri'=>'MO', 'Montana'=>'MT', 'Nebraska'=>'NE', 'Nevada'=>'NV', 'New Hampshire'=>'NH', 'New Jersey'=>'NJ', 'New Mexico'=>'NM', 'New York'=>'NY', 'North Carolina'=>'NC', 'North Dakota'=>'ND', 'Ohio'=>'OH', 'Oklahoma'=>'OK', 'Oregon'=>'OR', 'Pennsylvania'=>'PA', 'Rhode Island'=>'RI', 'South Carolina'=>'SC', 'South Dakota'=>'SD', 'Tennessee'=>'TN', 'Texas'=>'TX', 'Utah'=>'UT', 'Vermont'=>'VT', 'Virginia'=>'VA', 'Washington'=>'WA', 'West Virginia'=>'WV', 'Wisconsin'=>'WI', 'Wyoming'=>'WY' );
				
				//Generates the dropdown list with each state as an option
				function generateSelect($name = '', $options = array(), $default = '', $cursor = array()) {
					$state_menu = '<select name="'.$name.'" class="teamedit-input">';
					foreach ($options as $option => $value) {
						if ($value == $cursor['team_state']) {
							$state_menu .= '<option value='.$value.' selected="selected">'.$option.'</option>';
						} 
						else if ($cursor['team_state'] == null) {
							$state_menu .= '<option value="" selected="selected"></option>';
						}
						else {
							$state_menu .= '<option value='.$value.'>'.$option.'</option>';
						}
					}

				$state_menu .= '</select>';
				return $state_menu;
				}

				/* And then call it like */
				$state_menu = generateSelect("team_state", $states, '', $cursor);
				echo $state_menu;
			?>
			<br>
			Team Captain
			<br>
			<?php
				//Displays team captain
				echo '<input type="text" length="128" name="team_captain" value="' . $cursor['team_captain'] . '" class="teamedit-input" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+[\'-]?){1,3}$"/>';
			?>
			<br>
		</fieldset>
		<fieldset>
			<hr>
			<div class="row">
				<div class="col-lg-3">
				<!--TODO: Change this into a table instead of the stupid <span> tags and custom padding-->
				<!--This section contains all of the checkboxes for the various objectives during teleop and autonomous.-->
				<!--MAKE SURE TO CHANGE THESE VALUES IF YOU UPDATE ANY OF THE QUERY FIELDS-->
				<h3 class="teamheading">TeleOp Capabilities</h3>
				<span class="teamedit-text" style="padding-right: 196px;">Cap Ball</span>
				<?php
					//If the value stored is true, go ahead and make the box checked. Else leave it unchecked.
					if ($cursor['cap_ability_teleop'] == true) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="cap_ability_teleop" checked/>';
					}
					else if ($cursor['cap_ability_teleop'] == false) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="cap_ability_teleop"/>';
					}
				?>
				<br>
				<span class="teamedit-text" style="padding-right: 37px;">Low Goal Projectile Scoring</span>
				<?php
					if ($cursor['low_projectile_ability_teleop'] == true) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="low_projectile_ability_teleop" checked/>';
					}
					else if ($cursor['low_projectile_ability_teleop'] == false) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="low_projectile_ability_teleop"/>';
					}
				?>
				<br>
				<span class="teamedit-text" style="padding-right: 32.5px;">High Goal Projectile Scoring</span>
				<?php
					if ($cursor['high_projectile_ability_teleop'] == true) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="high_projectile_ability_teleop" checked/>';
					}
					else if ($cursor['high_projectile_ability_teleop'] == false) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="high_projectile_ability_teleop"/>';
					}
				?>
				<br>
				<span class="teamedit-text" style="padding-right: 135px;">Beacon Scoring</span>
				<?php
					if ($cursor['beacon_ability_teleop'] == true) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="beacon_ability_teleop" checked/>';
					}
					else if ($cursor['beacon_ability_teleop'] == false) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="beacon_ability_teleop"/>';
					}
				?>
				</div>
				<div class="col-lg-3">
					<h3 class="teamheading">Autonomous Capabilities</h3>
					<span class="teamedit-text" style="padding-right: 140px;">Knock Cap Ball</span>
				<?php
					if ($cursor['cap_ability_auto'] == true) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="cap_ability_auto" checked/>';
					}
					else if ($cursor['cap_ability_auto'] == false) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="cap_ability_auto"/>';
					}
				?>
				<br>
				<span class="teamedit-text" style="padding-right: 36px;">Low Goal Projectile Scoring</span>
				<?php
					if ($cursor['low_projectile_ability_auto'] == true) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="low_projectile_ability_auto" checked/>';
					}
					else if ($cursor['low_projectile_ability_auto'] == false) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="low_projectile_ability_auto"/>';
					}
				?>
				<br>
				<span class="teamedit-text" style="padding-right: 31.5px;">High Goal Projectile Scoring</span>
				<?php
					if ($cursor['high_projectile_ability_auto'] == true) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="high_projectile_ability_auto" checked/>';
					}
					else if ($cursor['high_projectile_ability_auto'] == false) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="high_projectile_ability_auto"/>';
					}

				?>
				<br>
				<span class="teamedit-text" style="padding-right: 134px;">Beacon Scoring</span>
				<?php
					if ($cursor['beacon_ability_auto'] == true) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="beacon_ability_auto" checked/>';
					}
					else if ($cursor['beacon_ability_auto'] == false) {
						echo '<input type="checkbox" class="teamedit-checkbox" name="abilities[]" value="beacon_ability_auto"/>';
					}
				?>
				</div>
			</div>
		<hr>
		</fieldset>
		<fieldset>
			<h3 class="teamheading">Notes</h3>
			<?php
				//Displays notes
				echo '<textarea name="notes" class="teamedit-textarea">' . $cursor['notes'] . '</textarea>';
			?>
		</fieldset>
			<br>
			<input type="submit" class="btn btn-default teamedit-btn" value="Submit"/>
	</form>
	</div>
	<footer class="footer footer-muted">
		<span class="text-muted">FTC Team 327 &COPY;2017 | SCGSSM</span>
    	<span class="text-muted right">Isaiah Ho</span>
    </footer>
	<script type="application/javascript" src="../scripts/responsivenav.js"></script>
</body>
</html>