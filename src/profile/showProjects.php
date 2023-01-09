
<a href="/profile.php">
  <button class="brutal-btn">
  Back
  </button>
</a>
<h2>Meine Projekte</h2>
<div class="projects">
<?php
$projects = $projects -> getUserProjects($auth -> getUserID());
foreach ($projects as $project) {
    include('src/components/projects/projectCard.php');
}

?>
</div>
