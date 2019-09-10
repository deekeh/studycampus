<?php
	function isLoggedIn()
	{
		if (session_status() == PHP_SESSION_NONE) session_start();
		if (isset($_SESSION['email'])) return true;
		return false;
	}
?>