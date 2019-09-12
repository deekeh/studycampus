<?php
	require_once '../../auth/checkLogin.php';
	if (!isLoggedIn()) header('Location: ../../auth/login.php');

	if (!isset($_GET['vid']))
	{
		echo "link error";
		return;
	}
	$db = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
	$stmt = $db->query("select name, url from video where id = ". $_GET['vid']);
	$vid_detail = $stmt-> fetch();
	if (!empty($vid_detail['name']))
	{
		$v_name = $vid_detail['name'];
		$v_url = $vid_detail['url'];
		$v_id = $_GET['vid'];
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="//cdn.jsdelivr.net/npm/afterglowplayer@1.1"></script>
	<title>Document</title>
</head>
<body>
	<?php require_once '../../layouts/navbar.php' ?>
	<div class="container">
		<div class="row">
		<div class="col-11 mt-3 mx-auto" >
			<!-- <video controls class="afterglow" src="<?= '../../data/'. $v_url ?>" width="100%"></video> -->
			<video autoplay class="afterglow" id="" width="1280" height="720" data-skin="dark">
 				<source type="video/mp4" src="<?= '../../data/'. $v_url ?>" />
			</video>
		</div>
		</div>
	</div>



	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>