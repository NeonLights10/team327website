<?php
if ((isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 0) OR (!isset($_SESSION['user_login_status']))) {
	header("Location: /login/index.php");
}
?>