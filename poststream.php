<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>POST Results</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style/main.css">
</head>
<body>
<?php 
	require '../vendor/autoload.php';
	(require_once("/secure/dbcreds.php")) or die("Unable to access database ERR:1");
	$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->teams;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// collect value of input field
		$number = $_POST['team_number'];
		$name = $_POST['team_name'];
		if (empty($name)) {
			echo "Name is empty" . "<br>";
			if (empty($number)) {
				echo "Number is empty";
			}
		} 
		else if (empty($number)) {
        	echo "Number is empty";
    	}
		else {
			$name = test_input($name);
  			$number = test_input($number);
			echo $name . "<br>";
			echo $number . "<br>";
			$userinfo = array(
				'team_name'   => $name,
				'team_number' => $number
			);
			$result = $collection->updateOne(
				['team_number' => $userinfo['team_number']],
				['$set'  => ['team_number' => $userinfo['team_number'], 'team_name' => $userinfo['team_name']]],
				['upsert' => true]
			);
			// $users->insert($userinfo, array('safe' => true)); Use if you want synchronous addition
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
	}
	
	function test_input($data) {
		$data = trim($data);
  		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
</body>
</html>