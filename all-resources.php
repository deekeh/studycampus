<?php
	require_once 'auth/checkLogin.php';
	if(!isLoggedIn()) header('Location: auth/login.php');
	else
	{
		$db = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
		$q = "SELECT end_point, topic_name, resource_url from video_topic_breakpoint;";
		$stmt = $db->prepare($q);
		$stmt->execute();
		$topics = $stmt->fetchAll();
		$db = null;
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
					
					<th>Extra Help Resources</th>
				</thead>
				<tbody>
					<?php
                        $row_num = 1;
                        foreach ($topics as $topic)
                        {
					?>
					<tr>
						<th scope="row"><?= $row_num ?></th>
						<td><?= $topic['topic_name'] ?></td>
						
						<td><a target="_blank" href="<?= $topic['resource_url'] ?>"><?= $topic['resource_url'] ?></a></td>
					</tr>
					<?php
                            $row_num++;
                        }
					?>
				</tbody>
			</table>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>