<?php require_once 'checkLogin.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	$(function() {
		$("#nav-logo-name").mouseenter(function() {
			$("#logo").animate(
				{ deg: 360 },
				{
					duration : 400,
					step: function(now) {
						$(this).css({ transform: 'rotate(' + now + 'deg)' });
					}
				}
			);
		});
		$("#nav-logo-name").mouseleave(function() {
			$("#logo").animate(
				{ deg: 0 },
				{
					duration : 400,
					step: function(now) {
						$(this).css({ transform: 'rotate(' + now + 'deg)' });
					}
				}
			);
		});
	});
</script>
<nav class="navbar navbar-light bg-light">
	<a class="navbar-brand" href="/studycampus" id="nav-logo-name">
	<img src="/studycampus/img/logo.png" id="logo" width="35" height="35" class="d-inline-block align-top" alt="">
		 | StudyCampus
	</a>
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