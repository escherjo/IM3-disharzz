<header>

  <?php

  // if successful message show message and reset session
  if (isset($_SESSION['message'])) {
      echo '<div class="header__message" id="message">' . $_SESSION['message'] . '</div>';
      unset($_SESSION['message']);
  }
  if (isset($_SESSION['success'])) {
      echo '<div class="header__success" id="success">' . $_SESSION['success'] . '</div>';
      unset($_SESSION['success']);
  }

  ?>
  </div>

  <div class="header__container">
    <div class="header__logo">
      <h1>Disharzz</h1>
    </div>
  <div class="header__burger" style='z-index: 100;'>
    <div class="burger" id="burger">
      <span class="line line1"></span>
      <span class="line line2"></span>
      <span class="line line3"></span>
    </div>
  </div>
    <nav class="header__nav" id='nav'>
      <ul class="header__menu">
        <li><a href="/">Home</a></li>
        <li><a href="/projects.php">Projekte</a></li>
      <?php
      if ($auth->isLoggedIn()) {
        ?>
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

<script>
  const burger = document.getElementById('burger');
  const nav = document.getElementById('nav');

  burger.addEventListener('click', () => {
      toggleBurger(burger, nav);
  });


  removeMessage();
  removeSuccess();
</script>
