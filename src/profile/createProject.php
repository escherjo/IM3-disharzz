<a href="/profile.php">
  <button class="brutal-btn">
  Back
  </button>
</a>
<h2>create project</h2>
<form action="" method="post">
  <div class="form-group">
    <label for="title">Titel</label>
    <div class="input__container">
    <input type="text" class="form-control" id="title" name="title" placeholder="Titel">
    </div>
  </div>
  <div class="form-group">
    <label for="description">Beschreibung</label>
    <div class="textarea__container">
    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="tags">Tags</label>
    <div class="input__container">
    <input type="text" name="tags" id="tags" value="<?php echo $project['tags'] ?>">
    </div>
  </div>
  <button type="submit" name="createProject" class="brutal-btn">Projekt erstellen</button>
