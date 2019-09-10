<?php require_once 'checkLogin.php'; ?>
<nav class="navbar navbar-light bg-light">
	<a class="navbar-brand" href="/studycampus">StudyCampus</a>
	<div>
		<?php if (!isLogIn()) { ?>
		<a href="/studycampus/auth/login.php">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/studycampus/auth/signup.php">Sign up</a>
		<?php
			}
			else {
		?>
			<a href="/studycampus/dashboard.php"><?= $_SESSION['name'] ?>'s account</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="/studycampus/auth/logout.php">Logout</a>
		<?php
			}
		?>
	</div>
</nav>