<?php

require_once 'libs/models/logentry.php';
require_once 'libs/utils.php';

$id = (int) $_GET['id'];
$logentry = Logentry::getLogentryById($id);

if (!$logentry->userIsOwner()) {  
        $_SESSION['error'] = "You are not the owner of this logentry.";
        header("Location: index.php");
        exit();
    }
    
if (empty($_POST)) {
        showView('editlog.php', array('logentry' => $logentry));
}

$logentry->setComment($_POST['comment']);

if ($logentry->isValid()) {
    $logentry->updateInDb();
    //TODO: direct to refering page
    header("Location: geocacheview.php?id=".$logentry->getGeocacheid());
} else {
    $errors = $logentry->errors;
    showView('editlog.php', array('logentry' => $logentry, 'errors' => $errors));
}