<?php
  $error = $_GET['error'];
?>
<html>
    <?php include('src/layout/head.php'); // File containing head code ?>
    <body>
        <!-- Include Header-->
        <?php include('src/layout/header.php'); // File containing header code?>

      <main class="container">

        <div class="error">
          <p><?php echo $error ?></p>
        </div>
        <form action="/auth/register.php" method="post">
          <input type="text" name="username" placeholder="Username" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="submit" name="register" value="Register">
        </form> 
      </main>

        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
