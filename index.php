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
		Use an AJAX call with sanitized GET switch() to set which array is used on the fly
		Set up experiences and education tables and queries inside an "Experience" class
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

   	<script src="js/mobile-nav.js"></script>
   	<script src="js/bootstrap.min.js"></script>
</body>
</html>