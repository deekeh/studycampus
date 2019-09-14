<?php
	if(isset($_GET['q']))
	{
		// if (session_status() == PHP_SESSION_NONE) session_start();
		$db = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
		$stmt = $db->prepare("SELECT id, name, description FROM course where name like '%". $_GET['q'] ."%' ");
		$stmt->execute();
		$row = $stmt->fetchAll();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>StudyCampus | Search</title>
</head>
<body>
	<?php include '../layouts/navbar.php' ?>
	<div class="container">
		<div class="row">
			<div class="col-6">
			<font color="red">
				<h4 class="mt-3 search_head">
					Search results
				</h4>
			</font>
			</div>
			<div class="col">
				<form action="">
					<div class="input-group input-group-md mt-3" id="searchButton">
						<input type="text" class="form-control" placeholder="Search..." aria-label="Search for courses here" aria-describedby="button-addon2" name="q" required>
							<div class="input-group-append">
								<input type="submit" value="Let's Go!" class="btn btn-outline-danger">
							</div>
					</div>
				</form>
			</div>
		</div>
		<hr>

		<?php
			if(!isset($row[0])) {
		?>
				<div class="alert alert-danger" role="alert">
					Oops! We didn't find any course for the term '<i><?= $_GET['q'] ?></i>'. Please search for some other term.
				</div>

		<?php
			}
			else
			{
				foreach ($row as $course)
				{
		?>
					<a href="../course?id=<?= $course['id'] ?>" style="text-decoration: none; color: #000000">
					<div class="card mx-2 mb-3">
						<div class="card-body">
							<h5 class="card-title"><?= $course['name'] ?></h6>
							<p class="card-text"><?= $course['description'] ?></p>
						</div>
					</div>
					</a>

		<?php
				}
			}
			$db = null;
		?>

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>