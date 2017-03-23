<?php
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
	$team_reference = (int) $cursor['team_name'];
	$team_submitter = $_SESSION['user_team'];
	$user_submitter = $_SESSION['user_name'];
	$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->comments;

	//sanitize comment with regex and length check
	//TODO: add profanity filter
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['comment'])) {
			$comment = test_input($_POST['comment']);
		}
		if ($comment == "") {
			$_SESSION['errors'] = "You cannot submit an empty comment."
		}
		else if (strlen($comment) < 400) {
			$result = $collection->InsertOne(
				['team_reference' => $team_reference,
				 'team_submitter' => $team_submitter,
				 'user_submitter' => $user_submitter,
				 'content' => $comment,]
			);

		printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
		header("Location: ../scouting/team.php");
		}
	}
	else {
		$_SESSION['errors'] = "The page did not submit data in an accepted manner.";
		header("Location: ../scouting/team.php");
	}

	function test_input($data) {
		$data = trim($data);
  		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>