<?php
	require_once 'auth/checkLogin.php';
	if (isset($_GET['vid']) AND isset($_GET['endpoint']) AND isLoggedIn())
	{
		$e = (int) $_GET['endpoint'];
		$db = new PDO('mysql:host=localhost;dbname=studycampus', 'root', '');

		$stmt = $db->prepare("SELECT end_point FROM video_topic_breakpoint WHERE video_id = ". $_GET['vid'] ." ORDER BY end_point;");
		$stmt->execute();
		$endpoints = $stmt->fetchAll();


		$lower_limit = 0; $upper_limit = 0;
		foreach($endpoints as $endpoint)
		{
			$ep = (int) $endpoint['end_point'];
			$lower_limit = $upper_limit;
			$upper_limit = $ep;
			if($e <= $ep) break;
		}


		$do = $db->prepare("DELETE FROM video_pause WHERE video_id = ". $_GET['vid'] ." AND user_id = ". $_SESSION['id'] ." AND video_time BETWEEN ". $lower_limit ." AND ". $upper_limit .";");
		$db->beginTransaction();
		$do->execute();
		$db->commit();
		$db = null;
		header('Location: resource.php?vid='. $_GET['vid']);
	}
	else header('Location: /studycampus');
?>