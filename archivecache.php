<?php

require_once 'libs/models/user.php';
require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';

$id = (int) $_GET['id'];
$geocache = Geocache::getGeocacheById($id);

if (isset($_SESSION['user']) && $geocache->getOwner() == $_SESSION['user']->getId()) {
    $geocache->archive();
    $_SESSION['success'] = "Geocache archived!";
    header("Location: geocacheview.php?id=".$geocache->getId());
} else {
    $_SESSION['error'] = "You are not the owner of this geocache";
    header("Location: geocacheview.php?id=".$geocache->getId());
}