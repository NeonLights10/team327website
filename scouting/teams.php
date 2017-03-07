<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Teams</title>
</head>

<body>
<?php
	require '../../vendor/autoload.php';
	(require_once("../secure/dbcreds.php")) or die("Unable to access database ERR:1");
	$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->teams;
	$cursor = $collection->find(
		[],
		[
			'projection' => [
				'team_number' => 1,
				'team_name' => 1,
			],
			'limit' => 50,
		]
	);
	echo("<table>");
	foreach($cursor as $document) {
		echo("<tr><td>" .$document['team_number'] . "</td><td>" . $document['team_name'] . "</td></tr>");
		echo "<br>";
	};
?>


</body>
</html>