<?php
require_once 'class/auth.php';
require_once 'class/db.php';
require_once 'class/projects.php';
$auth = new Auth();
$projects = new Projects();


if (!$auth -> isLoggedIn()) {
    header('Location: /login.php');
    exit();
}
//
// check if form was submitted 
// if yes update project 
// if no show form 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST['createProject'])) {
    if (!$projects -> createProject($auth -> getUserID(), $_POST['title'], $_POST['description'], $_POST['tags'] )) {
      $_SESSION['error'] = 'Project creation failed';
    }
  }
}
?>
<html>
   <?php include('src/layout/head.php'); // File containing head code ?>
    <body>
        <!-- Include Header-->
        <?php include('src/layout/header.php'); // File containing header code?>
      <main class="container">
        <h1>Profile</h1>
        <?php
        switch ($_GET['page']) {
            case 'createProject':
                include('src/profile/createProject.php');
                break;
            case 'editProject':
                include('src/profile/editProject.php');
                break;
            case 'showProjects':
                include('src/profile/showProjects.php');
                break;
            default:
                include('src/profile/overview.php');
                break;
        }
        ?>
      </main>
        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
