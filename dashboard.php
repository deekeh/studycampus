<?php
	require_once 'auth/checkLogin.php';
	if (!isLoggedIn()) header('Location: auth/login.php');

	$db = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
	$stmt = $db->prepare("SELECT id, name from course where id IN (SELECT course_id FROM enrolled_course where user_id = ". $_SESSION['id'] .");");
	$stmt->execute();
	$rows = $stmt->fetchAll();
	$courses = $rows;
	// get videos
	$q = "select id, name, course_id from video where course_id in (";
	foreach ($courses as $course)
	{
		$q .= $course['id']. ", ";
	}
	$q .= "'-') order by id;";
	$stmt = $db->prepare($q);
	$stmt->execute();
	$videos = $stmt->fetchAll();
	$db = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>StudyCampus | Dashboard</title>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
	</script>
</head>
<body>
	<?php require_once 'layouts/navbar.php' ?>
	<div class="container-fluid">
		<h2>
			<ol class="breadcrumb" style="background: #ffffff;">
				<li class="breadcrumb-item"><?= $_SESSION['name'] ?></li>
				<li class="breadcrumb-item">Dashboard</li>
			</ol>
		</h2>
		<hr>

		<div class="container mb-5">
			<h4>
				Courses enrolled
			</h4>
			<div class="list-group">
				<?php
					foreach ($courses as $course)
					{
						?>
							<p>
								<button type="button" class="btn btn-outline-success mr-4" data-toggle="collapse" data-target="#course<?= $course['id'] ?>" aria-expanded="false" aria-controls="course<?= $course['id'] ?>">
									<?= $course['name'] ?>
								</button>
								<a class="btn btn-outline-info btn-sm" href="all-resources.php" role="button">View all resources topic-wise</a>
								<div class="collapse" id="course<?= $course['id'] ?>">
									<div class="list-group">
										<?php
										$i = 1;
										foreach($videos as $video)
										{
											if($video['course_id'] == $course['id'])
											{
											?>
												<a href="resource.php?vid=<?= $video['id'] ?>" class="list-group-item list-group-item-action">
													<?php
														if($video['course_id'] == $course['id']) echo $i. ". ".$video['name'];
														$i++;
													?>
												</a>
											<?php
											}
										}
										?>
									</div>
								</div>
							</p>
						</a>
							
						<?php
						$i++;
					}
				?>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>