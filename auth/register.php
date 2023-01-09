<?php


require_once '../class/auth.php';
$auth = new Auth();

if ($auth -> isLoggedIn()) {
    header('Location: /');
    exit();
}

// Create a new instance of the Auth class

// Check if the form has been submitted
// If it has, process the form and save it to the database
// If it hasn't, display the form

if (isset($_POST['register'])) {
    // Confirm that the form has been submitted
    // Check if the username and password have been entered
    if (!$_POST['username'] || !$_POST['email'] || !$_POST['password']) {
        // If they haven't, display an error message
        $error = 'Please enter a username, email and password';
    } else {
        // If they have, check if the username is already in use
        if ($auth->isUsernameExists($_POST['username'])) {
            // If it is, display an error message
            $error = 'That username is already in use';
            header('Location: /register.php?error=' . $error);
            exit;
        } else {
            // If it isn't, register the user
            $auth->register($_POST['username'], $_POST['email'], $_POST['password']);
            $_SESSION['success'] = 'Registration successful';
            // Redirect the user to the login page
            header('Location: /login.php');
            exit;
        }
    }
}
