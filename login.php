<?php
require_once 'class/auth.php';
$auth = new Auth();

if ($auth -> isLoggedIn()) {
    header('Location: /');
    exit();
}
?>
<html>
    <?php include('src/layout/head.php'); // File containing head code ?>
    <body>
        <!-- Include Header-->
        <?php include('src/layout/header.php'); // File containing header code?>

      <main class="container">
        <form action="/auth/login.php" method="post">
          <label for="username">Username</label>
          <div class="input__container">
          <input type="text" name="username" placeholder="Username" required>
          </div>
          <label for="password">Password</label>
          <div class="input__container">
          <input type="password" name="password" placeholder="Password" required>
          </div>
          <button type="submit" name="login" class='brutal-btn'>Login</button>
        </form> 
      </main>
        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
