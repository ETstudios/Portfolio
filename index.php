<?php
	include 'php/classes/database.class.php';
	include 'php/classes/projects.class.php';
	include 'php/classes/input.class.php';

	$db = new Database(2);
	$conn = $db->Connect();
	$projects = new Projects($conn);
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

	/* To-Do: 
		Set up experiences and education tables and queries inside an "Experience" class
	*/

	$jobsArray = [
		array(
			"company" => "VizVibe LLC", 
			"jobTitle" => "CTO &amp; Content Creator", 
			"description" => "As the CTO, I do research and development into new, emerging technologies and techniques in the Augmented Reality and Virtual Reality fields. Beyond just learning more about them, I look at the programming involved to implement them into our process, to keep our projects as up-to-date and forwards-compatible as possible. <br><br> As a content creator, I serve as a generalist. I do any 3D modeling, rigging, animation, and texturing for our content, as needed. While it isn’t the main part of my job, I also aid in UI, UX, and graphic design, including any 2D animation and programming required to make our designs work.", 
			"startDate" => "May 2017", 
			"endDate" => "Present"
		),
		array(
			"company" => "Eric Thomas Studios", 
			"jobTitle" => "3D Generalist", 
			"description" => "Freelanced as a 3D modeler, rigger, animator, and texture artist.", 
			"startDate" => "Jun 2013",
			"endDate" => "Dec 2020"
		),
		array(
			"company" => "Luzerne County Community College", 
			"jobTitle" => "Student Tutor", 
			"description" => "Provided tutoring to college students with concentration in the areas of web design, frontend coding, graphic design, and communications.", 
			"startDate" => "Sep 2015",
			"endDate" => "May 2016"
		)
	];

	$educationArray = [
		array(
			"college" => "Luzerne County Community College", 
			"degreeType" => "Associate's Degree", 
			"degreeField" => "Computer Graphic Design", 
			"description" => "An Associate Degree program which entails graphic design, photography, and web design skills.", 
			"activities" => "Phi Theta Kappa, Sigma Kappa Delta, LCCC Art Club, LCCC Photography Club", 
			"startDate" => "2012", 
			"endDate" => "2014"
		),
		array(
			"college" => "Luzerne County Community College", 
			"degreeType" => "Associate's Degree", 
			"degreeField" => "Graphic Design / Advertising", 
			"description" => "An advertising- and branding-oriented Associate Degree program.", 
			"activities" => "LCCC Photography Club (V.P.)", 
			"startDate" => "2014", 
			"endDate" => "2015"
		)
	];
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
				
			</div>
			
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="col-12 center-text">
						<h2> Work Experiences </h2>
					</div>
					<?php foreach ($jobsArray as $job) { ?>
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

				<div class="col-12 col-md-6">
					<div class="col-12 center-text">
						<h2> Education </h2>
					</div>
					<?php foreach ($educationArray as $edu) { ?>
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

   	<script src="js/mobile-nav.js"></script>
   	<script src="js/bootstrap.min.js"></script>
</body>
</html>