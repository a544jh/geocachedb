<?php

require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';

$id = (int) $_GET['id'];
$geocache = Geocache::getGeocacheById($id);

if ($geocache->getOwner() == $_SESSION['user']->getId()) {
    //archive
} else {
    showView($page)
}