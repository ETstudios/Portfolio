<?php
   // To-Do: Migrate to database

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Eric Thomas">
	<meta name="description" content="Eric Thomas developer portfolio">
	<title> My Portfolio </title>
	<link rel="shortcut icon" href="img/icon.png">    
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/portfolio.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" rel="stylesheet">
</head>
<body>
	<a href="#projects" class="skip"> Skip to content </a>

	<header id="header">
		<div class="container">
			<nav class="row">
				<div class="col-9 col-md-4 col-lg-3">
					<h2 class="logo"> Eric Thomas </h2>
				</div>
				<div class="col-3 col-md-8 col-lg-9">
					<div id="menu">
						<span class="material-icons" id="menu-toggle" onclick="MenuToggle()">menu</span>
						<ul role="list" aria-label="Navigation list">
							<li role="listItem">
								<a href="#projects"> Projects </a>
							</li>
							<li role="listItem">
								<a href="#experiences"> Experiences </a>
							</li>
							<li role="listItem">
								<a href="#about"> About Me </a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<div class="row info">
					<div class="col-12 col-md-1 hidden"> &nbsp; </div>
					<div class="col-12 col-md-4">
						<img src="img/placeholder.jpg" class="hero">
					</div>
					<div class="col-12 col-md-1 hidden"> &nbsp; </div>
					<div class="col-12 col-md-4 bio">
						<h2> 
							Hey, I'm Eric Thomas!
						</h2>
						<p>
							I’m a full-stack developer and designer based in Pennsylvania.
						</p>
						<a href="#projects" class="ghost"> My Projects </a>
					</div>
					<div class="col-12 col-md-2 hidden"> &nbsp; </div>
				</div>
			</div>
	</header>

	
   	<script src="js/mobile-nav.js"></script>
   	<script src="js/bootstrap.min.js"></script>
</body>
</html>