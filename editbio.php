<?php

require_once 'libs/models/user.php';
require_once 'libs/utils.php';

if (!loggedIn()) {
    showView('login.php', array('error' => "You must login to view this page."));
}

$user = $_SESSION['user'];

if (empty($_POST)) {
    showView('editbio.php', array('user' => $user));
}

$user->setBio($_POST['bio']);

if ($user->isValid()){
    $user->updateInDb();
    header('Location: userprofile.php?id=' . $user->getId());
} else {
    showView('editbio.php', array('user' => $user, 'errors' => $user->errors));
}