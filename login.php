<?php
require_once 'class/auth.php';
$auth = new Auth();

echo $_SESSION['message'];

if ($auth -> isLoggedIn()) {
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

        <div><?php echo $_SESSION['error']?></div>
        <form action="/auth/login.php" method="post">
          <input type="text" name="username" placeholder="Username" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="submit" name="login" value="Login">
        </form> 
        <!-- Include Footer -->
        <?php include('src/layout/footer.php'); // File containing footer code?>
    </body>
</html>
