<?php
// load auth and project Class
require_once '../class/auth.php';
require_once '../class/projects.php';
$auth = new Auth();
$projects = new Projects();

$auth = new Auth();
$projects = new Projects();

// check if user is logged in 
if (!$auth->isLoggedIn()) {
    header('Location: /');
    exit;
}

// get project id from url 
// if id is not set redirect to projects.php 
if (!isset($_GET['id'])) {
    header('Location: /projects.php');
    exit;
}


// check if user is owner of project 
// if not redirect to projects.php 
if (!$projects->isOwner($_GET['id'], $auth->getUserID())) {
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

// check if form was submitted 
// if yes update project 
// if no show form 
if (isset($_POST['submit'])) {
  if($projects->updateProject($_GET['id'], $_POST['title'], $_POST['description'])) {
    $_SESSION['success'] = 'Project updated successfully';
    header('Location: /projects/show.php?id=' . $_GET['id']);
  }
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
        <form action="" method="post">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" value="<?php echo $project['title'] ?>">
          <label for="description">Description</label>
          <textarea name="description" id="description" cols="30" rows="10"><?php echo $project['description'] ?></textarea>
          <input type="submit" name="submit" value="Update">
        </form>

        <!-- Include Footer -->
        <?php include('../src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
