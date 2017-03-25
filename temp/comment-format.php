<?php
	//Setup successful marker and get any page references
    $successful = false;
	$cursor;

	//Retrieve team user belongs to
	$team_reference = (int) $team;
	$ccollection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->comments;

	$cursor = $ccollection->find(
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
			echo '<h4 class="comment-heading">' . $document['user_submitter'] . ' from ' . $document['team_submitter'] . '</h4>';
			echo '<p>' . $document['content'] . '</p>';
			echo '</div><div class="comment-spacing"></div>';
		}
	}
?>
