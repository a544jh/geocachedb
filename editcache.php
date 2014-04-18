<?php

require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';

//if (!loggedIn()) {
//    showView('login.php', array('error' => "You must login to view this page."));
//}

$id = (int) $_GET['id'];
$geocache = Geocache::getGeocacheById($id);

if (!$geocache->userIsOwner()) {  
        $_SESSION['error'] = "You are not the owner of this geocache.";
        header("Location: geocacheview.php?id=$id");
        exit();
    }

if (empty($_POST)) {
        showView('cacheform.php', array('action' => "editcache.php?id=$id", 'geocache' => $geocache));
}

$geocache->setType($_POST['type']);
$geocache->setName($_POST['name']);
$geocache->setDescription($_POST['description']);
$geocache->setHint($_POST['hint']);
$geocache->setDifficulty($_POST['difficulty']);
$geocache->setTerrain($_POST['terrain']);
$geocache->setLatitude($_POST['latitude']);
$geocache->setLongitude($_POST['longitude']);

if ($geocache->isValid()) {
    $geocache->updateInDb();
    header("Location: geocacheview.php?id=$id");
} else {
    $errors = $geocache->errors;
    showView('cacheform.php', array('action' => "editcache.php?id=$id", 'geocache' => $geocache, 'errors' => $errors));
}
