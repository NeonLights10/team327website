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
?>