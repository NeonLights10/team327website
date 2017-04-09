<?php
	//Initialize session and load dependencies
	session_start();
	require_once("validate_login.php");
	require_once("session.php");
	require '../../vendor/autoload.php';
	(require_once("dbcreds.php")) or die("Unable to access database ERR:1");
	
	//Setup successful marker and get any page references
    $successful = false;
	//$ref = htmlspecialchars($_GET['ref']);
	$cursor;

	//Retrieve team user belongs to
	$team_db = (string) $_SESSION['user_team'];
	$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->$team_db;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//echo "Post received";
		// collect value of input field
		$number = (int) $_POST['team_number'];
		$name = (string) $_POST['team_name'];
		$school = (string) $_POST['team_school'];
		$city = (string) $_POST['team_city'];
		$state = (string) $_POST['team_state'];
		$captain = (string) $_POST['team_captain'];
		$cap_ability_teleop = IsChecked('abilities','cap_ability_teleop');
		$low_projectile_ability_teleop = IsChecked('abilities','low_projectile_ability_teleop');
		$high_projectile_ability_teleop = IsChecked('abilities','high_projectile_ability_teleop');
		$beacon_ability_teleop = IsChecked('abilities','beacon_ability_teleop');
		$cap_ability_auto = IsChecked('abilities','cap_ability_auto');
		$low_projectile_ability_auto = IsChecked('abilities','low_projectile_ability_auto');
		$high_projectile_ability_auto = IsChecked('abilities','high_projectile_ability_auto');
		$beacon_ability_auto = IsChecked('abilities','beacon_ability_auto');
		$notes = (string) $_POST['notes'];
		$editor = (string) $_SESSION['user_name'] . " from Team " . (string) $_SESSION['user_team'];
		echo $notes;
		
		if (empty($number)) {
			$_SESSION['errors'] = "Team Number is empty";
			//redirect($ref);	
		} 
		else if (empty($name)) {
			$_SESSION['errors'] = "Team Name is empty";
			//redirect($ref);
		} 
		else if (!empty($_POST['team_number']) && $number<100000 && strlen($name) <= 128 && strlen($school) <= 128 && strlen($city) <= 128 && strlen($captain) <= 128 && strlen($notes) <= 5000) {
			//echo "Looking up document...";
			$name = test_input($name);
  			$number = test_input($number);
			$school = test_input($school);
			$city = test_input($city);
			$state = test_input($state);
			$captain = test_input($captain);
			$notes = test_input($notes);
			$result = $collection->updateOne(
				['team_number' => (int) $number],
				['$set'  => 
				['team_number' => (int) $number, 
				 'team_name' => $name, 
				 'team_school' => $school, 
				 'team_city' => $city, 
				 'team_state' => $state, 
				 'team_captain' => $captain, 
				 'cap_ability_teleop' => $cap_ability_teleop,
				 'low_projectile_ability_teleop' => $low_projectile_ability_teleop,
				 'high_projectile_ability_teleop' => $high_projectile_ability_teleop,
				 'beacon_ability_teleop' => $beacon_ability_teleop,
				 'cap_ability_auto' => $cap_ability_auto,
				 'low_projectile_ability_auto' => $low_projectile_ability_auto,
				 'high_projectile_ability_auto' => $high_projectile_ability_auto,
				 'beacon_ability_auto' => $beacon_ability_auto,
				 'notes' => $notes,
				 'editor' => $editor]],
				['upsert' => true]
			);
			printf("Matched %d document(s)\n", $result->getMatchedCount());
			echo "<br>";
			printf("Modified %d document(s)\n", $result->getModifiedCount());
			echo "<br>";
			printf("Upserted %d document(s)\n", $result->getUpsertedCount());
			echo "<br>";

			$upsertedDocument = $collection->findOne([
    			'_id' => $result->getUpsertedId(),
			]);

			var_dump($upsertedDocument);
		}
	$successful = true;
	header("Location: ../scouting/team.php?team=" . (string) $number);
	}
	else {
		$_SESSION['errors'] = "Data was not sent to the server in the correct format. ERR:4";
		header("Location: ../scouting/teamedit.php");
	}

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