<?php

require_once 'libs/models/user.php';
require_once 'libs/models/logentry.php';
require_once 'libs/utils.php';

$id = (int) $_GET['id'];
$logentry = Logentry::getLogentryById($id);

if ($logentry->userIsOwner()) {
    $logentry->delete();
    $_SESSION['success'] = "Log deleted!";
    //TODO: ref
    header("Location: geocacheview.php?id=".$logentry->getGeocacheid());
} else {
    $_SESSION['error'] = "You are not the owner of this logentry";
    header("Location: geocacheview.php?id=".$logentry->getId());
}