<?php
require_once 'libs/models/trackable.php';
require_once 'libs/utils.php';

//if (!loggedIn()) {
//    showView('login.php', array('error' => "You must login to view this page."));
//}

$id = (int) $_GET['id'];
$trackable = Trackable::getTrackableById($id);

if (!$trackable->userIsOwner()) {  
        $_SESSION['error'] = "You are not the owner of this trackable.";
        header("Location: trackableview.php?id=$id");
        exit();
    }

if (empty($_POST)) {
        showView('trackableform.php', array('action' => "edittrackable.php?id=$id", 'trackable' => $trackable));
}

$trackable->setName($_POST['name']);
$trackable->setDescription($_POST['description']);

if ($trackable->isValid()) {
    $trackable->updateInDb();
    header("Location: trackableview.php?id=$id");
} else {
    $errors = $trackable->errors;
    showView('trackableform.php', array('action' => "edittrackable.php?id=$id", 'trackable' => $trackable, 'errors' => $errors));
}
