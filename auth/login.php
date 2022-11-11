<?php


require_once '../class/auth.php';

$auth = new Auth();

if ($auth -> isLoggedIn()) {
    header('Location: /');
    exit();
}

if (isset($_POST['login'])) {
    // Confirm that the form has been submitted
    // Check if the username and password have been entered
    if (!$_POST['username'] || !$_POST['password']) {
        // If they haven't, display an error message
        $error = 'Please enter a username, email and password';
        // leave function early
        return;
    }
    if ($auth -> login($_POST['username'], $_POST['password'])) {
        // If the login is successful, redirect the user to the members page
        header('Location: /');
        exit();
    } else {
        // If the login is unsuccessful, display an error message
        $error = 'Incorrect username, email or password';
    }
}
