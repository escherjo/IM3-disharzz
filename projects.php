<?php
// load auth Class
require_once 'class/auth.php';
require_once 'class/projects.php';
$auth = new Auth();
$projects = new Projects();
?>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <!-- Include Header-->
        <?php include('src/layout/header.php'); // File containing header code?>
        <h1>Test</h1>
        <p>Test</p>

        <?php
        $projects = $projects->getAllProjects();
        foreach ($projects as $project) {
            include('src/components/projects/projectCard.php');
        }
        ?>
        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
