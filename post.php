<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>POST Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style/main.css">
</head>

<body>
<h1>THIS PAGE IS DEPRECATED</h1>
<div style="margin: 20px">
	<h1 id="titleGet">Add User</h1>
	<form name="user" action="#" onsubmit="return validateForm()" method="post">
		<fieldset>
		Team Number: 
		<span class="required">*</span>
		<br>
		<input type="text" length="60" name="team_number" style="margin-right: 10px" required="required" aria-required="true"
		pattern="^([0-9]{1,5})$" title="Team Number"/>
		<span class="error" id="email_error"></span>
		<br>
		Team Name:
		<span class="required">*</span>
		<br>
		<input type="text" length="60" name="team_name" style="margin-bottom: 10px; margin-right: 10px" required="required" aria-required="true"
		title="Team Name (No special characters)"/>
		<span class="error" id="name_error"></span>
		<br>
		<input type="submit" class="btn btn-default" value="Go"/>
		</fieldset>
	</form>
	<br>
	<a href="get.php" class="btn btn-default">View Users</a>
	</div>
	<script src="form_validation.js" type="application/javascript"></script>
</body>
</html>