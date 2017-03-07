 <!DOCTYPE html>
<html>
<head>
<title>GET Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style/main.css">
</head>

<body>
<?php
	require '../vendor/autoload.php';
	(require_once("/secure/dbcreds.php")) or die("Unable to access database ERR:1");
	$collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->dbname->users;
?>
<div style="margin: 20px">
	<h1 id="titleGet">View Users</h1>
	<?php if(empty($_GET)){ ?>
	<form name="search" method="get">
		Category:
		<select name="category" style="margin-right: 10px">
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="50">50</option>
		</select>
		
		<input type="submit" class="btn btn-default" value="Search"/>
	</form>
	<br>
	<a href="post.php" class="btn btn-default">Add Users</a>
	
	<?php }
		else{ 
			$category = htmlspecialchars(($_GET['category'])); 
			if($category==10){ 
				$cursor = $collection->find(
					[],
					[
						'projection' => [
							'email' => 1,
							'first_name' => 1,
							'last_name' => 1,
						],
						'limit' => 10,
					]
				);
				foreach($cursor as $document) {
					printf("%s, %s %s\n", $document['email'], $document['first_name'], $document['last_name']);
					echo "<br>";
				};
			}
			elseif($category==20){ 
				$cursor = $collection->find(
					[],
					[
						'projection' => [
							'email' => 1,
							'first_name' => 1,
							'last_name' => 1,
						],
						'limit' => 20,
					]
				);
				foreach($cursor as $document) {
					printf("%s, %s %s\n", $document['email'], $document['first_name'], $document['last_name']);
					echo "<br>";
				};
			}
			elseif($category==50){
				$cursor = $collection->find(
					[],
					[
						'projection' => [
							'email' => 1,
							'first_name' => 1,
							'last_name' => 1,
						],
						'limit' => 50,
					]
				);
				foreach($cursor as $document) {
					printf("%s, %s %s\n", $document['email'], $document['first_name'], $document['last_name']);
					echo "<br>";
				};
			} 
		} ?>
	</div>
	</body>
</html>