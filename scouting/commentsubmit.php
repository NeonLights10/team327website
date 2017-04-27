<?php
	session_start();
	require_once("validate_login.php");
	require_once("session.php");
	require '../../vendor/autoload.php';
	(require_once("dbcreds.php")) or die("Unable to access database ERR:1");
	$_SESSION['errors']="";
	//Setup successful marker and get any page references
    $successful = false;
	//$ref = htmlspecialchars($_GET['ref']);

	//Retrieve team user belongs to
	$team_reference = (int) $_POST['team_number'];
	$team_submitter = $_SESSION['user_team'];
	$user_submitter = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
	$filter = fopen("../../profanity.txt", "r");
	$prepare_header = "Location: ../scouting/team.php?team=" . $team_reference;

	//sanitize comment with regex and length check
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (isset($_POST['comment'])) 
		{
			$comment = test_input($_POST['comment']);
			if ($filter) 
			{
				//Check comment against profanity filter, and deny it if it contains any profanity.
				if(is_profane($comment,$filter))
				{
					echo("Profanity is not allowed.");
					header($prepare_header);
				}
				else {
					echo "Filter loaded";
					if ($comment == "") {
						$_SESSION['errors'] = "You cannot submit an empty comment.";
						header("Location: ../scouting/team.php");
					}
					else if (strlen($comment) < 400)
					{
						$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->comments;
						$result = $collection->InsertOne(
							['team_reference' => $team_reference,
							 'team_submitter' => $team_submitter,
							 'user_submitter' => $user_submitter,
							 'content' => $comment,]
						);

						printf("Inserted %d document(s)\n", $result->getInsertedCount());
						echo $prepare_header;
						header($prepare_header);
					} else {
						printf("bad comment");
					}
				}
			}
		}
		else {
			$_SESSION['errors'] = "The page did not submit data in an accepted manner.";
			header($prepare_header);
		}
	}
	else {
		$_SESSION['errors'] = "The page did not submit data in an accepted manner.";
		header($prepare_header);
	}

	//echo $_SESSION['errors'];

	function test_input($data) {
		$data = trim($data);
  		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function is_profane($comment,$filter)
	{
		while (($line = fgets($filter)) !== false) {
			$line = trim($line);
			if (preg_match('/(\W|^)('.$line.')(\W|$)/i', $comment)) 
			{
				$_SESSION['errors'] = "This comment was denied for profanity.";
				return true;		
			}
		}
		return false;
	}
?>
