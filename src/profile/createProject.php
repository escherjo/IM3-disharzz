<a href="/profile.php">Back</a>
<h2>create project</h2>
<form action="" method="post">
  <div class="form-group">
    <label for="title">Titel</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Titel">
  </div>
  <div class="form-group">
    <label for="description">Beschreibung</label>
    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" name="tags" id="tags" value="<?php echo $project['tags'] ?>">
  </div>
  <button type="submit" name="createProject" class="btn btn-primary">Projekt erstellen</button>
