<?php
	session_start();
	require_once("validate_login.php");
	require_once("session.php");
	require '../../vendor/autoload.php';
	(require_once("dbcreds.php")) or die("Unable to access database ERR:1");

	//Setup successful marker and get any page references
    $successful = false;
	$cursor;

	//Retrieve team user belongs to
	$team_reference = (int) $cursor['team_name'];
	$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->comments;

	$cursor = $collection->find(
				['team_reference' => (int) $team_reference],
				[
					'projection' => [
						'team_submitter' => 1,
						'user_submitter' => 1,
						'content' => 1,
					],
				]
			);
	if ($cursor == null) {
		$hascomments = false;
	}
	else {
		$hascomments = true;
	} 
	
	if ($hascomments) { 
		foreach($cursor as $document) {
			echo '<div class="comment">';
			echo '<h4 class="comment-heading">' . $cursor['user_submitter'] . ' from ' . $cursor['team_submitter'] . '</h4>';
			echo '<p>' . $cursor['content'] . '</p>';
			echo '</div><div class="comment-spacing"></div>';
		}
	}
?>
