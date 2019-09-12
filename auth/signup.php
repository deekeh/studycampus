<?php
	if (isset ($_POST["Submit"]))
	{
		$r_email = $_POST["reg_email"];
		$r_name = $_POST["reg_name"];
		$r_password = $_POST["reg_pass"];
		$r_type = 0;
		if($_POST["reg_type"] == "Student") $r_type = 1;
		$error = "";
		
		try
		{
			$db = new PDO('mysql:host=localhost;dbname=studycampus', "root", "");
			if(!$db) die();
			$stmt = $db->query("SELECT email FROM user where email = '". $r_email ."';");
			$row = $stmt->fetch();
			if(!empty($row['email'])) $error = "User already exists";
			else
			{
				$sql = "insert into user (email, name, type, password) values ('". $r_email ."', '". $r_name ."', ". $r_type .", '". $r_password ."')";
				$db->beginTransaction();
				$db->exec($sql);
				$db->commit();
				$db = null;
				header('Location: login.php');
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
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
	<title>StudyCampus | Signup</title>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script type="text/javascript">
		$(function() {
			$("#reg_form").on("submit", function(e) {
				var p = document.getElementById("reg_pass").value;
				var pc = document.getElementById("reg_pass_c").value;
				if (p != pc)
				{
					alert("Passwords do not match")
					e.preventDefault();
				}
			});
		});
	</script>
</head>
<body>
	<?php include '../layouts/navbar.php' ?>

	

	<div class="container">
		<font color="red">
			<h4 class="mt-3">Register to StudyCampus</h4>
		</font>
		<hr>

		<form action="signup.php" method="post" id="reg_form">
			<div class="form-group">
				<label for="reg_email">Email ID <font color="red">*</font></label>
				<span style="color: #ff00ff;"><i><?php if (isset ($error)) echo $error; ?></i></span>
				<input type="email" class="form-control" name="reg_email" id="reg_email"aria-describedby="emailHelp" placeholder="Enter email ID" required>
				<small id="emailHelp" class="form-text text-muted">Your email will be safe with us.</small>
			</div>
			<div class="form-group">
				<label for="reg_name">Name <font color="red">*</font></label>
				<input type="text" name="reg_name" id="reg_name" class="form-control" placeholder="Enter name" required>
			</div>
			<div class="row">
			<div class="form-group col-6">
				<label for="reg_pass">Password <font color="red">*</font></label>
				<input type="password" name="reg_pass" id="reg_pass" class="form-control" placeholder="Enter a strong password" minlength="8" required>
			</div>
			<div class="form-group col-6">
				<label for="reg_pass">Confirm Password <font color="red">*</font></label>
				<input type="password" name="reg_pass_c" id="reg_pass_c" class="form-control" placeholder="Re-enter the password" minlength="8" required>
			</div>
			</div>
			<div class="form-group">
				<label for="">Type of user <font color="red">*</font></label><br>
				<div class="form-check form-check-inline">
					<label>
					<input type="radio" name="reg_type" value="Student" id="reg_type1" class="form-check-input">Student
					</label>
				</div>
				<div class="form-check form-check-inline">
					<label>
					<input type="radio" name="reg_type" value="Instructor" id="reg_type2" class="form-check-input">Instructor
					</label>
				</div>
			</div>
			<br>
			<input type="submit" value="Submit" name="Submit" class="btn btn-danger" id="reg_submit">
		</form>
	</div>
	

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>