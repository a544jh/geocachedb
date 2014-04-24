<?php

require_once 'libs/models/user.php';
require_once 'libs/models/logentry.php';
require_once 'libs/utils.php';

$id = (int) $_GET['id'];
$logentry = Logentry::getLogentryById($id);
$referer = $_SERVER['HTTP_REFERER'];

if ($logentry->userIsOwner()) {
    $logentry->delete();
    $_SESSION['success'] = "Log deleted!";
    header("Location: $referer");
} else {
    $_SESSION['error'] = "You are not the owner of this logentry";
    header("Location: $referer");
}