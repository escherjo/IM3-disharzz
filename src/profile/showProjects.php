
<a href="/profile.php">back</a>
<h3>Meine Projekte</h3>
<?php
$projects = $projects -> getProjects($auth -> getUserID());
foreach ($projects as $project) {
    include('src/components/projects/projectCard.php');
}

?>
