<?php

require_once 'libs/models/user.php';
require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';

$id = (int) $_GET['id'];
$geocache = Geocache::getGeocacheById($id);

if (userHasMinRole(5)) {
    $geocache->publish();
    $_SESSION['success'] = "Geocache published!";
    header("Location: geocacheview.php?id=".$geocache->getId());
} else {
    $_SESSION['error'] = "You do not have the rights to publish a geocache.";
    header("Location: geocacheview.php?id=".$geocache->getId());
}