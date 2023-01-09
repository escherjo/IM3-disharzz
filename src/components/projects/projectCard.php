  <div class='project-card'>
    <div class="project-card__header gradient">
      <p>
        <?php     echo $project['title']; ?>
      </p>
    </div>
    <div class="project-card__body">
      <p><?php echo $project['description'] ?></p>
      <div class="project-card__tags">
        <?php
        // create array of tags delemited by comma
        $tags = explode(',', $project['tags']);
        // loop through the tags 
        foreach ($tags as $tag) {
          // create the tag in a <span></span>
          // and append it to the tags <div></div>
          if ($tag !== '') {
            // trim whitespace of tag 
            $tag = trim($tag);
            echo "<span class='tag'>#$tag</span>";
          }
        }
        ?>
    </div>
    </div>
    <div class="project-card__footer">
    <?php
  if ($project['user_id'] == $_SESSION['user_id']) {
      ?>
    <a href="/projects/edit.php?id=<?php echo $project['id'] ?>">
    <button class='brutal-btn'>Edit</button>
    </a>
    <a href="/projects/delete.php?id=<?php echo $project['id'] ?>">
    <button class='brutal-btn'>Delete</button>
    </a>
      <?php
  }
  ?>
    </div>
  </div>
