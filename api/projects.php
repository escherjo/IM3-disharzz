<?php
require_once '../class/projects.php';
$projects = new Projects();
  // get projects and serve as json for javascript to use  
$projects = $projects->getAllProjects();
echo $projects;

