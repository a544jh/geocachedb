<?php

require_once 'libs/models/trackable.php';
require_once 'libs/models/logentry.php';
require_once 'libs/utils.php';

if (!loggedIn()) {
    showView('login.php', array('error' => "You must login to view this page."));
}

$newTrackable = new Trackable();

if (empty($_POST)) {
    showView('trackableform.php', array('action' => 'addtrackable.php', 'trackable' => $newTrackable));
}

$newTrackable->setName($_POST['name']);
$newTrackable->setDescription($_POST['description']);
//date from db
$newTrackable->setOwner($_SESSION['user']->getId());
do{
    //Generate a unique tracking code
    $trackingcode = Trackable::generateTrackingcode();
} while (Trackable::getTrackableByTrackingcode($trackingcode) != null);
$newTrackable->setTrackingcode($trackingcode);

if ($newTrackable->isValid()) {
    $newTrackable->insertIntoDb();
    $logentry = new Logentry;
    $logentry->setUser($_SESSION['user']);
    $logentry->insertIntoDb();
    $trackablelog = new Trackablelog('create', $newTrackable->getId(), null);
    $trackablelog->insertIntoDb($logentry);
    header('Location: trackablelist.php');
} else {
    $errors = $newTrackable->errors;
    showView('trackableform.php', array('action' => 'addtrackable.php', 'trackable' => $newTrackable, 'errors' => $errors));
}

