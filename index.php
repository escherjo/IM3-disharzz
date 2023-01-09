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
        <h1>Hey!</h1>
        <h2>Du bist bei Disharzz gelandet</h2>
        <p>Wir sind eine Sharingplattform für Digezzprojekte</p>
        <p>Auf was hast du Lust?</p>
        <div class="is-flex">
          <a href="/projects.php">
          <button class="brutal-btn">
              Projekte Durchsuchen
          </button>
          </a>
          <a href="/profile.php?page=createProject">
          <button class="brutal-btn">
              Projekte erstellen
          </button>
          </a>
        </div>
      </main>
        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
