<?php
  $error = $_GET['error'];
?>
<div><?php echo $error ?></div>
<form action="/auth/register.php" method="post">
  <input type="text" name="username" placeholder="Username" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="submit" name="register" value="Register">
</form> 
