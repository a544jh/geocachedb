<?php

require_once 'libs/utils.php';
require_once 'libs/models/user.php';

$newUser = new User();

if (empty($_POST)) {
    showView('register.php', array('user' => $newUser));
}

$newUser->setUsername($_POST['username']);

if ($_POST['password'] != $_POST['verifyPassword']) {
    showView('register.php', array('user' => $newUser, 'error' => "Passwords do not match."));
}
$newUser->setPassword($_POST['password']);
$newUser->setRole(0);

if ($newUser->isValid()) {
    $newUser->insertIntoDb();
    $username = $newUser->getUsername();
    $_SESSION['success'] = "User $username created successfully";
    header("Location: login.php");
} else {
    showView('register.php', array('user' => $newUser, 'errors' => $newUser->errors));
}