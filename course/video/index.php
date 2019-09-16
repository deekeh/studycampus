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
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- <script type="text/javascript">
		$(function() {
			var toast_isset = false;
			
			$('#videox').on('pause', function(e) {
				// var timeout = 3000;
				var videoHandler = $("#videox")[0];
				var showHelp = setTimeout(function() {
					$('#help_toast').toast('show');
					// timeout += 3000
				}, 3000);

				// clearTimeout();
				var hideHelp = setTimeout(function() {
					$('#help_toast').toast('hide');
					// timeout += 3000;
				}, 6000);

				// clearTimeout();
				// $('.toast').toast('show');
				// $.post('savePause.php', { video_time : videoHandler.currentTime, video_id : <?= $v_id ?>, user_id : <?= $_SESSION['id'] ?> }, function(response) {
					// console.log(response);
				// });
			});
			
			$('#btn-no').click(function() {
				toast_isset = false;
				clearTimeout(showHelp);
				clearTimeout(hideHelp);
				
				$('#help_toast').toast('hide');
			});
			$('#btn-yes').click(function() {
				toast_isset = true;
				clearTimeout();
				$('#help_toast').toast('hide');
				$('#url_toast').toast('show');
			});
			$('#btn-close').click(function() {
				// toast_isset = false;
				$('#url_toast').toast('hide');
			});
		});
	</script> -->
	<script type="text/javascript">
		$(function() {
			// $('#help_toast')
			function show_help()
			{
				$('#help_toast').toast('show');
			}
			function hide_help()
			{
				$('#help_toast').toast('hide');
			}
			$("#videox").on('pause', function() {
				show_help();
				var help_hide = setTimeout(hide_help, 3000);
				// $('#help_toast').toast('show');
			});
			$("#videox").on('play', function() {
				$('#help_toast').toast('hide');
			});
		});
	</script>

	<title>StudyCampus | Watch</title>
</head>
<body>
	<?php require_once '../../layouts/navbar.php' ?>
	<div class="container">

		<div class="toast" id="help_toast" data-autohide="false" animation="true" style="position: fixed; top:100px; right:20px; z-index: 5; width: 1000px;">
			<div class="toast-body">
				Topic: '<?= $v_name ?>'
				<hr>
				<div class="row">
					<div class="col-6 mx-auto">
						<button class="btn mx-auto close" data-dismiss="toast" id="btn-yes" style="font-size: 1rem;">Help!</button>
					</div>
					<div class="col-6 mx-auto">
						<button class="btn mx-auto close" data-dismiss="toast" style="font-size: 1rem; id="btn-no">Close</button>
						<!-- <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      						<span aria-hidden="true"></span>No
    					</button> -->
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="toast" id="url_toast" data-autohide="false" animation="true" style="position: fixed; right:20px; z-index: 5; width: 1000px;">
			<div class="toast-body">
				Here's a post which we think might help you:<br>
				<a href="" target="_blank">'<?= $v_name ?>'</a>
				<hr>
				<div class="row">
					<div class="col-12 mx-auto">
						<button class="col-12 btn mx-auto" id="btn-close">Help me!</button>
					</div>
					
				</div>
			</div>
		</div> -->

		<div class="mt-3">
			<div class="mx-5">
				<div class="embed-responsive embed-responsive-16by9">
					<video controls src="<?= '../../data/'. $v_url ?>" class="embed-responsive-item" id="videox" controlsList="nodownload"></video>
				</div>
			</div>
		</div>
		<hr>
		<h5>
			<?= $v_name; ?>
		</h5>
	</div>

	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>