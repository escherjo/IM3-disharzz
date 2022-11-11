<?php


require_once '../class/auth.php';

$auth = new Auth();

/*
 * check if user is logged in
 * if yes log him out
 */
if ($auth -> isLoggedIn()) {
    $auth -> logout();
    header('Location: /');
}

/*
 * if user is not logged in
 * redirect him to login page
 */
header('Location: /');
