  <div>
  <h4>Title:
  <?php     echo $project['title']; ?>
  </h4>
  <p><?php echo $project['description'] ?></p>
  <?php 
  if ($project['user_id'] == $_SESSION['user_id']) {
      ?>
      <a href="/projects/edit.php?id=<?php echo $project['id'] ?>">Edit</a>
      <a href="/projects/delete.php?id=<?php echo $project['id'] ?>">Delete</a>
      <?php
  }
  ?>
  </div>
