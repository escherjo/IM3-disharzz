<?php
// load auth Class
require_once 'class/auth.php';
require_once 'class/projects.php';
$auth = new Auth();
$projects = new Projects();
?>
<html>
    <?php include('src/layout/head.php'); // File containing head code ?>
    <body>
      <!-- Include Header-->
      <?php include('src/layout/header.php'); // File containing header code?>
      <main class="container">
        <h1>Test</h1>
        <p>Test</p>
      </main>
        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
