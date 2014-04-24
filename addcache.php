<?php
require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';

if(!loggedIn()) {
    showView('login.php', array('error' => "You must login to view this page."));
}

$newGeocache = new Geocache();

if(empty($_POST)) {
    showView('cacheform.php', array('action' => 'addcache.php', 'geocache' => $newGeocache));
}

$newGeocache->setType($_POST['type']);
$newGeocache->setName($_POST['name']);
$newGeocache->setDescription($_POST['description']);
$newGeocache->setHint($_POST['hint']);
//date from db
$newGeocache->setOwner($_SESSION['user']->getId());
$newGeocache->setDifficulty($_POST['difficulty']);
$newGeocache->setTerrain($_POST['terrain']);
$newGeocache->setLatitude($_POST['latitude']);
$newGeocache->setLongitude($_POST['longitude']);

if ($newGeocache->isValid()) {
    $newGeocache->insertIntoDb();
    $_SESSION['success'] = "Geocache added successfully. It's now waiting to be published by an admin.";
    header('Location: geocachelist.php');
} else {
    $errors = $newGeocache->errors;
    showView('cacheform.php', array('action' => 'addcache.php', 'geocache' => $newGeocache, 'errors' => $errors));
}

