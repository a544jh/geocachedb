<?php

require_once 'libs/utils.php';
require_once 'libs/models/user.php';

if (empty($_POST["username"])) {
    showView("login.php", array('error' => "No username given."));
}
$username = $_POST["username"];

if (empty($_POST["password"])) {
    showView("login.php", array('user' => $username,
        'error' => "No password given."));
}

$password = $_POST["password"];

$user = User::getUserByName($username);

if ($user->getPassword() == $password) {
    $_SESSION['user'] = $user;
    header('Location: frontpage.php');
} else {
    showView("login.php", array('user' => $username,
        'error' => "Wrong username or password."));
}
