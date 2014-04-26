<?php

require_once 'libs/models/user.php';
require_once 'libs/utils.php';

if (!loggedIn()) {
    showView('login.php', array('error' => "You must login to view this page."));
}

$user = clone $_SESSION['user'];

if (empty($_POST)) {
    showView('changepassword.php', array('user' => $user));
}

$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$verifyNewPassword = $_POST['verifyNewPassword'];

if (!$user->checkPassword($currentPassword)) {
    showView('changepassword.php', array('user' => $user, 'error' => "Current password is wrong."));
}

if ($newPassword != $verifyNewPassword) {
    showView('changepassword.php', array('user' => $user, 'error' => "Passwords do not match."));
}

$user->setPassword($newPassword);

if ($user->isValid()) {
    $user->updateInDb();
    $_SESSION['success'] = "Password changed successfully!";
    header('Location: userprofile.php?id=' . $user->getId());
} else {
    showView('changepassword.php', array('user' => $user, 'errors' => $user->errors));
}