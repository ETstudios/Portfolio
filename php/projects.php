<?php
    include 'classes/database.class.php';
	include 'classes/projects.class.php';
	include 'classes/input.class.php';

    $db = new Database(3);
	$conn = $db->Connect();
	$projects = new Projects($conn);
	$input = new Input($conn);

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

    $projectList = [];

    foreach ($projectsList as $project) {
        if (in_array($project['title'], $projectTags)) {
            $info = [
                "thumbnailUrl" => $project['thumbnailUrl'],
                "thumbnailAlt" => $project['thumbnailAlt'],
                "title" => $project['title'],
                "description" => $project['description'],
                "urlDemo" => $project['urlDemo'],
                "urlRepo" => $project['urlRepo']
            ];
            array_push($projectList, $info);
        }
    }

        foreach ($projectList as $project) {
    ?>
    <div class="col-12 col-md-6 col-lg-3 project">
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
?>