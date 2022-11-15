<?php
  $error = $_GET['error'];
?>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <!-- Include Header-->
        <?php include('src/layout/header.php'); // File containing header code?>
        <div><?php echo $error ?></div>
        <form action="/auth/register.php" method="post">
          <input type="text" name="username" placeholder="Username" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="submit" name="register" value="Register">
        </form> 

        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
