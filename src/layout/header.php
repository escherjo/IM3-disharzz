<header>

  <?php

  // if successful message show message and reset session
  if (isset($_SESSION['message'])) {
      echo '<div class="header__message">' . $_SESSION['message'] . '</div>';
      unset($_SESSION['message']);
  }
  if (isset($_SESSION['success'])) {
      echo '<div class="header__success">' . $_SESSION['success'] . '</div>';
      unset($_SESSION['success']);
  }

  ?>
  </div>

  <div class="container">
    <div class="header__logo">
      <h1>Disharzz</h1>
    </div>
    <nav class="header__nav">
      <ul class="header__menu">
        <li><a href="/">Home</a></li>
        <li><a href="/projects.php">Projekte</a></li>
      </ul>
      <ul class="header__profile">
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
