<?php
	require_once 'auth/checkLogin.php';
	if(!isLoggedIn()) header('Location: auth/login.php');
	if(!isset($_GET['vid']))
	{
		echo 'Link error';
		return;
	}
	else
	{
		$db = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
		$stmt = $db->prepare("SELECT video_time from video_pause WHERE user_id = ". $_SESSION['id'] ." AND video_id = ". $_GET['vid'] .";");
		$stmt->execute();
		$pauses = $stmt->fetchAll();

		$q = "SELECT end_point, topic_name, resource_url from video_topic_breakpoint WHERE video_id = ". $_GET['vid'] . ";";
		$stmt = $db->prepare($q);
		$stmt->execute();
		$topics = $stmt->fetchAll();

		$stmt = $db->prepare("SELECT count(*) as breaks from video_topic_breakpoint WHERE video_id = ". $_GET['vid'] . ";");
		$stmt->execute();
		$breaksx = $stmt->fetch();
		$breaks = (int) $breaksx['breaks'];
		$db = null;

		$endpoints = array();
		foreach ($topics as $topic) array_push($endpoints, ((int) $topic['end_point']));
		$pt = array();
		for ($t = 0; $t < $breaks; $t++) $pt[$t] = 0;

		foreach ($pauses as $pause)
		{
			$iterator = 0;
			foreach ($endpoints as $endpoint)
			{
				if (((int)($pause['video_time'])) <= $endpoint)
				{
					$pt[$iterator] ++;
					break;
				}
				$iterator++;
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>StudyCampus | Extras</title>
</head>
<body>
	<?php require_once 'layouts/navbar.php' ?>
	<div class="container">
		<div class="table-responsive">
			<table class="table table-hover mt-4">
				<thead>
					<th>#</th>
					<th>Topics</th>
					<th>Pauses</th>
					<th>Extra Help Resources</th>
					<th>Delete</th>
				</thead>
				<tbody>
					<?php
						$row_num = 1; $i = 0;
						foreach ($topics as $topic)
						{
							if ($pt[$i] != 0)
							{
					?>
					<tr>
						<th scope="row"><?= $row_num ?></th>
						<td><?= $topic['topic_name'] ?></td>
						<td><?= $pt[$i] ?></td>
						<td><a target="_blank" href="<?= $topic['resource_url'] ?>"><?= $topic['resource_url'] ?></a></td>
						<td>
							<form action="delete-pause.php" method="get">
								<input type="hidden" name="vid" value='<?= $_GET['vid'] ?>'>
								<input type="hidden" name="endpoint" value='<?= $topic['end_point'] ?>'>
								<button type="submit" class="close" aria-label="Close">
									<span class="mr-5" aria-hidden="true">&times;</span>
								</button>
							</form>
						</td>
					</tr>
					<?php
								$row_num++;
							}
							$i ++;
						}
					?>
				</tbody>
			</table>
		</div>
		<a class="btn btn-outline-info mt-3" href="all-resources.php" role="button">View all resources topic-wise</a>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>