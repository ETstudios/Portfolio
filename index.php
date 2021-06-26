<?php
	include 'php/classes/database.class.php';
	include 'php/classes/projects.class.php';
	include 'php/classes/experiences.class.php';
	include 'php/classes/input.class.php';

	$db = new Database(2);
	$conn = $db->Connect();
	$projects = new Projects($conn);
	$experiences = new Experiences($conn);
	$input = new Input($conn);
	
	$tags = $projects->ListTags();
	$jobs = $experiences->ListJobs();
	$education = $experiences->ListEducation();

	/* To-Do: 
		Header profile photo
		Experiences header image
		About profile photo
	*/
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Eric Thomas">
	<meta name="description" content="Eric Thomas developer portfolio">
	<title> My Portfolio </title>
	<link href="img/icon.png" rel="shortcut icon">    
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/portfolio.css" rel="stylesheet" type="text/css">
	<link href="fonts/all.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" rel="stylesheet">
</head>
<body onload="SwitchProjects('All Projects')">
	<a href="#projects" class="skip" id="skip"> Skip to content </a>
	<span id="to-top">
		<i class="fas fa-sort-up"></i>
		<p>
			Top
		</p>
	</span>

	<header id="header">
		<div class="container">
			<nav class="row" id="nav">
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
					<div class="col-12 col-md-4 col-lg-4">
						<img src="img/placeholder.jpg" alt="" class="hero">
					</div>
					<div class="col-12 col-md-1 hidden"> &nbsp; </div>
					<div class="col-12 col-md-6 col-lg-4 bio">
						<h2> 
							Hey, I'm Eric Thomas!
						</h2>
						<p>
							I'm a full-stack developer and designer based in Pennsylvania.
						</p>
						<a href="#projects" class="ghost"> My Projects </a>
					</div>
					<div class="col-12 col-md-2 hidden"> &nbsp; </div>
				</div>
			</div>
	</header>

	<div class="clear"> &nbsp; </div>

	<section class="container" id="projects">
		<div class="row">
			<div class="col-12">
				<h2> My Projects </h2>
			</div>
		</div>		
		<div class="row tags">
			<div class="col-12">
				<ul>
					<?php foreach ($tags as $tag) { ?>
						<li>
							<button onclick="SwitchProjects('<?php echo $tag; ?>')" class="tag-button"><?php echo $tag; ?></button>
						</li>							
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-12 center-text">
				Click a project below to learn more.
			</div>
		</div>
		<div class="clear"> &nbsp; </div>
		<div class="row">
			<div class="row tags" id="projects-list"></div>
		</div>
	</section>

	<div class="clear"> &nbsp; </div>

	<img src="img/experiences.jpg" alt="" class="hero">

	<div class="clear"> &nbsp; </div>

	<section id="experiences">
		<div class="container">			
			<div class="row">
				<div class="col-12 col-md-6 col-lg-5">
					<div class="col-12 center-text">
						<h2> Work Experiences </h2>
					</div>
					<?php foreach ($jobs as $job) { ?>
						<div class="row">
							<div class="col-12 experience">
								<h3> <?php echo "{$job['company']}"; ?> </h3>
								<strong> <?php echo "{$job['jobTitle']} ({$job['startDate']} - {$job['endDate']})"; ?> </strong>
								<br><br>
								<p>
									<?php echo $job['description']; ?>
								</p>
							</div>
						</div>
					<?php } ?>
				</div>

				<div class="col-12 col-lg-2 hidden"> &nbsp; </div>
				<div class="col-12 col-md-6 col-lg-5">
					<div class="col-12 center-text">
						<h2> Education </h2>
					</div>
					<?php foreach ($education as $edu) { ?>
						<div class="row">
							<div class="col-12 edu">
								<h3> <?php echo "{$edu['college']}"; ?> </h3>
								<strong> <?php echo "{$edu['degreeType']} of {$edu['degreeField']}"; ?> </strong>
								<br><br>
								<strong> <?php echo "({$edu['startDate']} - {$edu['endDate']})"; ?> </strong>
								<br><br>
								<p>
									<?php echo $edu['description']; ?>
								</p>
								<p>
									Activities: <?php echo $edu['activities']; ?>
								</p>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

	<div class="clear"> &nbsp; </div>

	<section id="about">
		<div class="container">
			<div class="clear"> &nbsp; </div>
			<div class="row">
				<div class="col-12">
					<h2> About Me </h2>
				</div>
			</div>

			<div class="clear"> &nbsp; </div>

			<div class="row about">
				<div class="col-12 col-lg-1 hidden"> &nbsp; </div>
				<div class="col-12 col-md-4 col-lg-3">
					<img src="img/placeholder.jpg" alt="" class="hero">
					<br><br>
				</div>
				<div class="col-12 col-md-2 col-lg-1 hidden"> &nbsp; </div>
				<div class="col-12 col-md-6 col-lg-5">
					<p class="about-text">
						I started coding in 2009, picked up Photoshop in 2011, and have been doing art and programming ever since. I'm a web designer, 3D modeler, and full stack web and game developer. Always striving to learn new skills, I've become a creative jack of all trades over the years.
					</p>
					<br>
					<div class="row socials">
						<div class="col-4 col-md-2">
							<a href="https://github.com/ETstudios" target="_blank">
								<i class="fab fa-github-alt fa-5x"></i>
							</a>
						</div>
						<div class="col-4 col-md-2">
							<a href="https://twitter.com/ET_Studios" target="_blank">
								<i class="fab fa-twitter fa-5x"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-2 hidden"> &nbsp; </div>
			</div>

			<div class="clear"> &nbsp; </div>

			<div class="row">
				<div class="col-12 col-md-6">
					<div class="container skills">
						<h4> Development </h4>
						<br>
						<div class="row">
							<div class="col-6 col-md-6 col-lg-3 skill">
								<i class="fab fa-html5 fa-5x"></i>
								<h5> HTML5 </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<i class="fab fa-css3-alt fa-5x"></i>
								<h5> CSS3 </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<i class="fab fa-js fa-5x"></i>
								<h5> JavaScript </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<img src="img/c-sharp.png" alt="C# programming language icon" class="hero">
								<h5> Mono C# </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<i class="fab fa-unity fa-5x"></i>
								<h5> Unity Engine </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<i class="fas fa-database fa-5x"></i>
								<h5> MySQL </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<i class="fab fa-php fa-5x"></i>
								<h5> PHP </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<i class="fab fa-docker fa-5x"></i>
								<h5> Docker </h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="container skills">
						<h4> Art &amp; Design </h4>
						<br>
						<div class="row">
							<div class="col-6 col-md-6 col-lg-3 skill">
								<img src="img/blender.png" alt="Blender icon" class="hero blender">
								<h5> Blender </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<i class="fas fa-cube fa-5x"></i>
								<h5> 3D Modeling </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<i class="fas fa-paint-brush fa-5x"></i>
								<h5> Texturing </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<i class="fas fa-play fa-5x"></i>
								<h5> 3D Animation </h5>
							</div>
							<div class="col-6 col-md-6 col-lg-3 skill">
								<img src="img/adobe.png" alt="Adobe icon" class="hero adobe">
								<h5> Adobe Suite </h5>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="clear"> &nbsp; </div>

			<div class="row">
				<div class="col-12">
					<div class="container hobbies">
						<h4> My Hobbies </h4>
						<br>
						<div class="row">
							<div class="col-12 col-md-6 col-lg-4 hobby">
								<img src="img/modeling.jpg" alt="3D character texture maps showcase" class="hero">
								<h5> 3D Modeling </h5>
								<p>
									5 years ago, I felt like trying out Blender, and I haven't stopped using it since. Over the years, I've tried modeling a lot of different subjects, though bar-none I seem to most enjoy, and do well at, prop modeling. Doing all the other steps in the process also helps me keep up my various art and animation skills.
								</p>
							</div>
							<div class="col-12 col-md-6 col-lg-4 hobby">
								<img src="img/reading.jpg" alt="A filled up bookshelf" class="hero">
								<h5> Reading </h5>
								<p>
									Whether it's been for entertainment, escapism, or education, I've been an avid reader my entire life. Outside of technical and creative pursuits, it's the main way I spend my downtime. I'm willing to sink time into most kinds of reading, but urban fantasy and the mythology it tends to use has always been my main genre.
								</p>
							</div>
							<div class="col-12 col-md-6 col-lg-4 hobby">
								<img src="img/gamedev.jpg" alt="Hands typing on a laptop" class="hero">
								<h5> Game Development </h5>
								<p>
									While there's some overlap with work, I also do various game development experiments for fun. They don't tend to see the light of day, but they're a great way for me to work out various ideas I have and to continue learning new things. It also involves watching gameplay videos, which is both educational and relaxing.
								</p>
							</div>
						</div>
					</div>

					<div class="clear"> &nbsp; </div>
				</div>
			</div>
		</div>
	</section>

	<footer class="container">
		<div class="row">
				<div class="col-sm-12 center-text">
					Created by <a href="https://github.com/ETstudios" target="_blank">Eric Thomas</a> - <a href="https://devchallenges.io/" target="_blank">devChallenges.io</a>
				</div>
			</div>
	</footer>

   	<script src="js/mobile-nav.js"></script>
   	<script src="js/portfolio.js"></script>
</body>
</html>