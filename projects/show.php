<?php
// load auth and project Class
require_once '../class/auth.php';
require_once '../class/projects.php';
$auth = new Auth();
$projects = new Projects();

// check if id is set 
// if not redirect to projects.php 
if (!isset($_GET['id'])) {
    header('Location: /projects.php');
    exit;
}

// get project from database 
// if project does not exist redirect to projects.php 
$project = $projects->getProject($_GET['id']);
if (!$project) {
    header('Location: /projects.php');
    exit;
}

?>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <!-- Include Header-->
        <?php include('../src/layout/header.php'); // File containing header code?>
        <h1>Test</h1>
        <p>Test</p>
        <?php include('../src/components/projects/projectCard.php'); ?>

        <!-- Include Footer -->
        <?php include('../src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
