<?php
  // if post request create project 
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  echo 'post request';
    // if create project success 
    if ($projects -> createProject($_POST['title'], $_POST['description'], $auth -> getUserID())) {
      echo 'project created';
      header('Location: /profile.php');
    } else {
      echo 'Error';
      $_SESSION['error'] = 'Project creation failed';
    }
  }
?>

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
  <button type="submit" class="btn btn-primary">Projekt erstellen</button>
