<?php

require_once 'libs/models/logentry.php';
require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';

if (!loggedIn()) {
    showView('login.php', array('error' => "You must login to view this page."));
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
} else {
    $id = $_POST['id'];
}
$geocache = Geocache::getGeocacheById($id);

$newLogentry = new Logentry();

if (empty($_POST)) {
    showView('logcache.php', array('logentry' => $newLogentry, 'geocache' => $geocache));
}

$newLogentry->setUser($_SESSION['user']);
$newLogentry->setGeocacheid($geocache->getId());
$newLogentry->setVisittype($_POST['visittype']);
$newLogentry->setComment($_POST['comment']);

if ($newLogentry->isValid()) {
    $newLogentry->insertIntoDb();
    header('Location: geocacheview.php?id=' . $geocache->getId());
} else {
    $errors = $newLogentry->errors;
    showView('logcache.php', array('logentry' => $newLogentry, 'geocache' => $geocache, 'errors' => $errors));
}
