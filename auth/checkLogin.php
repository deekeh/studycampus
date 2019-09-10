<?php
	function isLoggedIn()
	{
		// if (session_status() == PHP_SESSION_NONE) session_start();
		if (isset($_SESSION['uid'])) return true;
		return false;
	}
	echo isLoggedIn(). "test1";
?>