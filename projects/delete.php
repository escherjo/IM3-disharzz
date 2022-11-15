<?php
// load auth and project Class
require_once '../class/auth.php';
require_once '../class/projects.php';

$auth = new Auth();
$projects = new Projects();

// check if user is logged in 
if (!$auth->isLoggedIn()) {
    header('Location: /');
    exit;
}

// get project id from url 
// if id is not set redirect to projects.php 
if (!isset($_GET['id'])) {
    header('Location: /projects.php');
    exit;
}


// check if user is owner of project 
// if not redirect to projects.php 
if (!$projects->isOwner($_GET['id'], $auth->getUserID())) {
    header('Location: /projects.php');
    exit;
}

// get project from database 
// if project does not exist redirect to projects.php 
$project = $projects->getProject($_GET['id']);
if (!$project) {
    header('Location: /projects.php');
    exit;
}

// try to delete project 
// if success redirect to projects.php 
// if not show error message 
if ($projects->deleteProject($_GET['id'])) {
    $_SESSION['success'] = 'Project deleted successfully';
    header('Location: /projects.php');
} else {
    $_SESSION['error'] = 'Something went wrong';
    header('Location: /projects.php');
}
