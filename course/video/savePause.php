<?php
    $video_time = (int) $_POST['video_time'];
    $video_id = $_POST['video_id'];
    $user_id = $_POST['user_id'];
    
    $db = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
    $sql = "insert into video_pause (user_id, video_id, video_time) values (". $user_id .", ". $video_id .", ". $video_time .");";
	$db->beginTransaction();
	$db->exec($sql);
	$db->commit();
	$db = null;

    echo (int) $_POST['video_time'];
?>