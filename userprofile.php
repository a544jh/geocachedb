<?php

require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';
$id = (int) $_GET['id'];
$user = User::getUserById($id);

if ($user != null) {
    showView('userprofile.php', array('user' => $user));
} else {
    showView('userprofile.php', array('user' => null,
        'error' => "User not found!"));
}