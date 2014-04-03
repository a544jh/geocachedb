<?php
require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';

if(!loggedIn()) {
    showView('login.php', array('error' => "You must login to view this page."));
}

$newGeocache = new Geocache();

if(empty($_POST)) {
    showView('addcacheform.php', array('geocache' => $newGeocache));
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
    header('Location: geocachelist.php');
} else {
    $errors = $newGeocache->errors;
    showView('addcacheform.php', array('geocache' => $newGeocache, 'errors' => $errors));
}

