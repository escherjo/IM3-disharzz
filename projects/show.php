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
    <?php include('../src/layout/head.php'); // File containing head code ?>
    <body>
        <!-- Include Header-->
        <?php include('../src/layout/header.php'); // File containing header code?>
      <main class="container">
      <h1><?php echo $project['title'] ?></h1>
      <div class="project-card__tags">
        <?php
        // create array of tags delemited by comma
        $tags = explode(',', $project['tags']);
        // loop through the tags 
        foreach ($tags as $tag) {
          // create the tag in a <span></span>
          // and append it to the tags <div></div>
          if ($tag !== '') {
            // trim whitespace of tag 
            $tag = trim($tag);
            echo "<span class='tag'>#$tag</span>";
          }
        }
        ?>
      </div>
      <p><?php echo $project['description'] ?></p>
      <?php 
      if ($auth -> isLoggedIn()) {
      ?>
      <h3>Kontakt:</h3>
      <p>Name: <?php echo $project['username'] ?></p>
      <p>
      E-Mail:
      <a href="mailto:<?php echo $project['email'] ?>"><?php echo $project['email'] ?></a>
      </p>
      <?php } ?>

      </main>
        <!-- Include Footer -->
        <?php include('../src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
