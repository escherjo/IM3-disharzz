<?php

echo $_SESSION['user_id'];
echo $_SESSION['message'];
echo $_SESSION['success'];
echo $_SESSION['username'];

?>

<header>
  <div>
    <h1>Disharezz</h1>
    <nav>
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/projects.php">Projekte</a></li>
      </ul>
      <ul>
<?php
if ($auth->isLoggedIn()) {
    ?>
  <li>Hallo <?php echo $_SESSION['username'] ?></li>
  <li><a href="/profile.php">Profile</a></li>
  <li><a href="/auth/logout.php">Logout</a></li>
        <?php
} else {
    ?> 
    <li><a href="/login.php">Login</a></li>
    <li><a href="/register.php">Register</a></li>
  <?php
}
?>
      </ul>
    </nav>
  </div>
</header>
