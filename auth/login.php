<?php
	require_once 'checkLogin.php';
	if(isLoggedIn()) header('Location: ../index.php');
	if(isset($_POST['login-submit']))
	{
			if (session_status() == PHP_SESSION_NONE) session_start();
			$db = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
			$stmt = $db->query("SELECT id, email, password, name, type FROM user where email = '". $_POST['loginemail'] ."' and password = '". $_POST['loginpassword'] ."' ");
			$row = $stmt->fetch();
			if(!empty($row['email']))
			{
				$_SESSION['email'] = $row['email'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['type'] = $row['type'];
				$_SESSION['id'] = $row['id'];
				header('Location: ../index.php');
			}
			else echo 'invalid';
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
	<title>StudyCampus | Login</title>
</head>
<body>
	<?php include '../layouts/navbar.php' ?>
	<div class="container">
		<font color="red">
			<h4 class="mt-3">Login to StudyCampus to access your account</h4>
		</font>
		<hr>

		<form method="post">
			<div class="form-group">
				<label for="loginemail">Email address</label>
				<input type="email" class="form-control" name="loginemail" id="loginemail" aria-describedby="emailHelp" placeholder="Enter email" required>
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
				<label for="loginpassword">Password</label>
				<input type="password" class="form-control" id="loginpassword" name="loginpassword" placeholder="Password" required>
			</div>
			<button type="submit" class="btn btn-danger" name="login-submit">Submit</button>
		</form>
	</div>


	


	<!-- Bootstrap js content -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>