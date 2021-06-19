<?php
	$projects = [
		array ("title" => "404 Page Challenge", "description" => "Create a 404 page following supplied design.", "urlDemo" => "https://phasmatechnologies.com/404/", "urlRepo" => "https://github.com/ETstudios/DevChallenges-404", "thumbnailName" => "404.jpg", "thumbnailAlt" => "404 error page UI design" ),
		array ("title" => "My Team Challenge", "description" => "Create a team info page following supplied design.", "urlDemo" => "https://phasmatechnologies.com/team/", "urlRepo" => "https://github.com/ETstudios/DevChallenges-Team", "thumbnailName" => "team.jpg", "thumbnailAlt" => "Creative Team informational web page" ),
		array ("title" => "Interior Consultancy Challenge", "description" => "Create an interior consultancy info page following supplied design.", "urlDemo" => "https://phasmatechnologies.com/interior/", "urlRepo" => "https://github.com/ETstudios/DevChallenges-Interior-Consultant", "thumbnailName" => "interior.jpg", "thumbnailAlt" => "Interior Consultancy product landing web page" ),
		array ("title" => "Recipe Challenge", "description" => "Create a recipe service page following supplied design.", "urlDemo" => "https://phasmatechnologies.com/recipe/", "urlRepo" => "https://github.com/ETstudios/DevChallenges-Recipes", "thumbnailName" => "recipes.jpg", "thumbnailAlt" => "Recipe information web page" ),
		array ("title" => "My Gallery Challenge", "description" => "Create a recipe service page following supplied design.", "urlDemo" => "https://phasmatechnologies.com/gallery/", "urlRepo" => "https://github.com/ETstudios/DevChallenges-Gallery", "thumbnailName" => "gallery.jpg", "thumbnailAlt" => "Photographer gallery web page design" ),
		array ("title" => "Checkout Challenge", "description" => "Create a checkout page based on supplied design, with frontend JavaScript and backend PHP validation.", "urlDemo" => "https://phasmatechnologies.com/checkout/", "urlRepo" => "https://github.com/ETstudios/DevChallenges-Checkout", "thumbnailName" => "checkout.jpg", "thumbnailAlt" => "Store checkout web page design" ),
		array ("title" => "Edie Challenge", "description" => "Create a portfolio page based on supplied design, with frontend JavaScript.", "urlDemo" => "https://phasmatechnologies.com/edie/", "urlRepo" => "https://github.com/ETstudios/DevChallenges-Edie", "thumbnailName" => "edie.jpg", "thumbnailAlt" => "Web design studio landing web page" )
	];

	$tags = [
		"All Projects" => array ("404 Page Challenge", "My Team Challenge", "Interior Consultancy Challenge", "Recipe Challenge", "My Gallery Challenge", "Checkout Challenge", "Edie Challenge"),
		"JavaScript" => array ("Interior Consultancy Challenge", "Checkout Challenge", "Edie Challenge"),
		"PHP" => array ("My Team Challenge", "Checkout Challenge")
	];

	$setTag = null;
	if(isset($_GET['tag'])) {
		// Sanitize GET['tag']
		$setTag = str_replace("%20", " ", $_GET['tag']);
	}
	else {
		$setTag = "All Projects";
	}

	/* To-Do: 
		Migrate to database
			In db, use tagId matched to projectId
			All projects just calls whole $projects
			if $setTag is set, use a WHERE clause in query to decide which projects to pull
		Use an AJAX call with sanitized GET switch() to set which array is used on the fly
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
					<?php foreach ($tags as $tag => $tagValue) { 
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
				// set $projects here, based on $setTag being used above

				foreach ($projects as $project) {
					if (in_array($project['title'], $tags[$setTag])) {
			?>
			<div class="col-6 col-md-4 col-lg-3 project">
				<figure>
					<img src="<?php echo "https://phasma-technologies.s3.us-east-2.amazonaws.com/portfolio/thumbnails/" . $project['thumbnailName']; ?>" class="hero" alt="<?php echo $project['thumbnailAlt']; ?>">
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