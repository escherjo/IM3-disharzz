<?php
require_once 'class/auth.php';
require_once 'class/db.php';
require_once 'class/projects.php';
$auth = new Auth();
$projects = new Projects();


if (!$auth -> isLoggedIn()) {
    header('Location: /');
    exit();
}
?>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <!-- Include Header-->
        <?php include('src/layout/header.php'); // File containing header code?>
        <h1>Profile</h1>
        <?php
          switch ($_GET['page']) {
              case 'createProject':
                  include('src/profile/createProject.php');
                  break;
              case 'showProjects':
                  include('src/profile/showProjects.php');
                  break;
              default:
                  include('src/profile/overview.php');
                  break;
          }
?>
        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
