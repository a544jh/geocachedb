<?php

require_once 'libs/models/logentry.php';
require_once 'libs/models/trackable.php';
require_once 'libs/utils.php';

if (!loggedIn()) {
    showView('login.php', array('error' => "You must login to view this page."));
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
} else {
    $id = $_POST['id'];
}
$trackable = Trackable::getTrackableById($id);

$newLogentry = new Logentry();
//show the form
if (empty($_POST)) {
    showView('logtrackable.php', array('logentry' => $newLogentry, 'trackable' => $trackable));
}
//if there is data in POST, set the fields in the object
$newLogentry->setUser($_SESSION['user']);
$newLogentry->setComment($_POST['comment']);

//create trackablelog
//check if the action is valid
if ($_POST['action'] === 'grab' || $_POST['action'] === 'comment') {
    $action = $_POST['action'];
}
$location = $trackable->getLocation();
if ($action === 'grab' && $location instanceof User) {
    $fromuser = $location->getId();
} else {
    $fromuser = null;
}
$newTrackablelog = new Trackablelog($action, $trackable->getId(), $fromuser);

//check the tracking code
if ($action === 'grab') {
    if (!($trackable->getTrackingcode() ===
            $_POST['trackingcode'])) {
        $trackingcodeError = "Wrong tracking code.";
    }
}

if ($newLogentry->isValid() && !isset($trackingcodeError)) {
    $newLogentry->insertIntoDb();
    $newTrackablelog->insertIntoDb($newLogentry);
    header('Location: trackableview.php?id=' . $trackable->getId());
} else {
    $errors = $newLogentry->errors;
    if (isset($trackingcodeError)) {
        $errors[] = $trackingcodeError;
    }
    showView('logtrackable.php', array('logentry' => $newLogentry, 'trackable' => $trackable, 'errors' => $errors));
}