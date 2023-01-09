<footer>
  <div class='footer__container'>
    <div class="footer__logo">
    <a href="/">
      <p>Disharzz</p>
    </a>
    </div>
    <nav class="footer__nav">
      <ul class="footer__menu">
        <li><a href="/projects.php">
          <button class="brutal-btn">Projekte</button>
        </a></li>
      </ul>
    </nav>
    <nav class="footerr__nav">
      <ul class="footer__menu">
      <?php
      if ($auth->isLoggedIn()) {
        ?>
          <li><a href="/profile.php">
            <button class="brutal-btn">Profile</button>
          </a></li>
          <li><a href="/auth/logout.php">
            <button class="brutal-btn">Logout</button>
          </a></li>
        <?php
        } else {
        ?> 
          <li><a href="/login.php">
            <button class="brutal-btn">Login</button>
          </a></li>
          <li><a href="/register.php">
            <button class="brutal-btn">Register</button>
          </a></li>
        <?php
      }
      ?>
      </ul>
    </nav>
  </div>
</footer>
