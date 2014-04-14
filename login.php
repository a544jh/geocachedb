<?php

require_once 'libs/utils.php';
require_once 'libs/models/user.php';

if (isset($_GET['logout']) && $_GET['logout'] == 'success') {
    showView("login.php", array('success' => "Logout successful!"));
}

if (empty($_POST)) {
    showView("login.php");
}

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

//check the password
if ($user != null &&
        crypt($password, $user->getPassword()) === $user->getPassword()) {
    $_SESSION['user'] = $user;
    $_SESSION['success'] = "Login successful!";
    header('Location: index.php');
} else {
    showView("login.php", array('username' => $username,
        'error' => "Wrong username or password."));
}
