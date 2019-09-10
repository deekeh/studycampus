<?php
		session_start();
		setcookie('PHPSESSID', '', time() - 86400);
		$_SESSION=array();
		unset($_SESSION);
		session_destroy();
		header('Location: ../index.php');
?>