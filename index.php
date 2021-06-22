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
	$projectsList = $projects->ListProjects();

	$setTag = null;
	if(isset($_GET['tag'])) {
		$tag = $input->Input($_GET['tag']);
		$setTag = str_replace("%20", " ", $tag);

		if(!$projects->GetTagId($setTag)) {
			$setTag = "All Projects";
		}
	}
	else {
		$setTag = "All Projects";
	}
	$tagId = $projects->GetTagId($setTag);
	$projectTags = $projects->ListProjectTags($tagId);

	$jobs = $experiences->ListJobs();
	$education = $experiences->ListEducation();

	/* To-Do: 
		About
		Hobbies
		Footer
		Mobile
		iPad
		WCAG
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
						<img src="img/placeholder.jpg" alt="" class="hero">
					</div>
					<div class="col-12 col-md-1 hidden"> &nbsp; </div>
					<div class="col-12 col-md-4 bio">
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
					<?php foreach ($tags as $tag) { 
						$selected = null;
						if ($setTag == $tag) { $selected = "class=\"active\""; }
					?>
						<li>
							<a href="index.php?tag=<?php echo $tag; ?>#projects" <?php echo $selected; ?>>
								<?php echo $tag; ?>
							</a>
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
			<?php
				// set $projectsList here, based on $setTag being used above

				foreach ($projectsList as $project) {
					if (in_array($project['title'], $projectTags)) {
			?>
			<div class="col-6 col-md-4 col-lg-3 project">
				<figure>
					<img src="<?php echo $project['thumbnailUrl']; ?>" class="hero" alt="<?php echo $project['thumbnailAlt']; ?>">
					<figcaption>
						<h3 class="text-center"> <?php echo $project['title']; ?> </h3>
						<p>
							<?php echo $project['description']; ?>
						</p>
						<div class="container links">
							<div class="row">
								<?php 
								if ($project['urlDemo'] == null || $project['urlRepo'] == null) {
									if ($project['urlDemo'] == null) { ?>
										<div class="col-12">
											<a href="<?php echo $project['urlRepo']; ?>"> Repo </a>
										</div>
									<?php } else { ?>
										<div class="col-12">
											<a href="<?php echo $project['urlDemo']; ?>"> Demo </a>
										</div>
									<?php }
								} else { ?>
									<div class="col-6">
										<a href="<?php echo $project['urlDemo']; ?>"> Demo </a>
									</div>
									<div class="col-6">
										<a href="<?php echo $project['urlRepo']; ?>"> Repo </a>
									</div>
								<?php } ?>
							</div>
						</div>
					</figcaption>
				</figure>
			</div>
			<?php } 
				}
			?>
		</div>
	</section>
	
	<div class="clear"> &nbsp; </div>

	<img src="img/experiences.jpg" alt="" class="hero">

	<section id="experiences">
		<div class="container">			
			<div class="row">
				<div class="col-12 col-md-5">
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

				<div class="col-12 col-md-2 hidden"> &nbsp; </div>
				<div class="col-12 col-md-5">
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
			<div class="row">
				<div class="col-12 col-md-1 hidden"> &nbsp; </div>
				<div class="col-12 col-md-3">
					<img src="img/placeholder.jpg" alt="" class="hero">
					<br><br>
				</div>
				<div class="col-12 col-md-1 hidden"> &nbsp; </div>
				<div class="col-12 col-md-5">
					<p class="about-text">
						I started coding in 2009, picked up Photoshop in 2011, and have been doing art and programming ever since. I'm a web designer, 3D modeler, and full stack web and game developer. Always striving to learn new skills, I've become a creative jack of all trades over the years.
					</p>
					<br><br>
					<div class="row">
						<div class="col-4 col-md-2">
							<a href="https://github.com/ETstudios" target="_blank">
								<img src="img/github.png" alt="Github logo" class="hero">
							</a>
						</div>
						<div class="col-4 col-md-2">
							<a href="https://twitter.com/ET_Studios" target="_blank">
								<img src="img/twitter.png" alt="Twitter logo" class="hero">
							</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-2 hidden"> &nbsp; </div>
			</div>
		</div>
	</section>

   	<script src="js/mobile-nav.js"></script>
   	<script src="js/bootstrap.min.js"></script>
</body>
</html>