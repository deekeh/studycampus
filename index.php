<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>StudyCampus</title>
	
	<style type="text/css">
		.bigName
		{
			font-size: 4rem;
			background-color: #ffffff;
		}
		.t1,.t7{color: #346eeb;}
		.t2,.t8{color: #8334eb;}
		.t3,.t9{color: #a834eb;}
		.t4,.t10{color: #eb3464;}
		.t5,.t11{color: #231fa3;}
		.t6{color: #34eb80;}
	</style>
</head>
<body>
	<?php include 'layouts/navbar.php' ?>

	<div>
		<div class="jumbotron bigName text-center">
			<font size="7">
			<span class="t1">S</span><span class="t2">t</span><span class="t3">u</span><span class="t4">d</span><span class="t5">y</span><span class="t6">C</span><span class="t7">a</span><span class="t8">m</span><span class="t9">p</span><span class="t10">u</span><span class="t11">s</span>
			</font>
			<br><br>
			<form action="search/">
				<div class="input-group input-group-lg mb-3" id="searchButton">
					<input type="text" class="form-control" placeholder="Search for courses..." aria-label="Search for courses here" aria-describedby="button-addon2" name="q" required>
						<div class="input-group-append">
							<input type="submit" value="Let's Go!" class="btn btn-outline-danger">
						</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>