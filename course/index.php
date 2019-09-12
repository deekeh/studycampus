<?php
	// fetch course details from the database
	$dbc = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
	$stmtc = $dbc->query("select name, description from course where id = ". $_GET['id'] );
	$rc = $stmtc->fetch();
	if (!empty($rc['name']))
	{
		$course_name = $rc['name'];
		$course_description = $rc['description'];
		$dbc = null;
	}
	else
	{
		$course_name = "Course name error";
		$course_description = "Course description error";
		$dbc = null;
	}

	// fetch videos for the course from the database
	$dbv = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
	$stmtv = $dbv->prepare("select name from video where course_id = ". $_GET['id'] ." order by id");
	$stmtv->execute();
	$rv = $stmtv->fetchAll();
	$videos = $rv;
	$dbv = null;
	
	require_once '../auth/checkLogin.php';
	if (isset($_POST['Enrol']))
	{
		if (!isLoggedIn()) header('Location: ../auth/login.php');
		else
		{
			
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
	<title>StudyCampus | Course Details</title>
</head>
<body>
	<?php require_once '../layouts/navbar.php' ?>

	<div class="container mt-3">
		<h3 class="display-4">
			<div class="row">
				<div class="col-10">
					<?= $course_name ?>
				</div>
				<div class="col-2">
					<?php
						if (isLoggedIn())
						{
							// only a student is allowed to enrol to a course
							if ($_SESSION['type']) // type is 'true' if a 'student' is logged in
							{
								$db = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
								$stmt = $db->query("select count(*) as is_enrolled from enrolled_course where user_id = ". $_SESSION['id']);
								$row = $stmt->fetch();

								if ($row['is_enrolled'] == 0)
								{

					?>
					<form action="" method="post">
						<input type="submit" value="Enrol" name="Enrol" class="btn btn-outline-success">
					</form>
					<?php
								}
								else
								{
									// display 'enrolled'
								}
							}
						}
						else {
					?>
						<a href="../auth/Login.php" class="btn btn-outline-success">Login to enrol</a>
					<?php } $db = null; ?>
				</div>
			</div>
		</h3>
		
		<div class="lead">
			<em>
				<?= $course_description ?>
			</em>
		</div><hr>

		<div class="text-muted mt-5" style="font-family: 'lucida console';">
			<h4 class="">
				Content
			</h4>
		</div>

		<div class="list-group mx-3 mb-5">
			<?php
				foreach ($videos as $video) {
			?>
			<a href="video" class="list-group-item list-group-item-action"><?= $video['name'] ?></a>
			<?php } ?>
		</div>

	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>