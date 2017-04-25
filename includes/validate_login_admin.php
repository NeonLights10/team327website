<?php
if ((isset($_SESSION['user_login_status_admin']) AND $_SESSION['user_login_status_admin'] == 0) OR (!isset($_SESSION['user_login_status_admin']))) {
	header("Location: /admin/login/index.php");
}
?>