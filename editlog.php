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
        showView('editlog.php', array('logentry' => $logentry, 'editlogReferer' => $_SERVER['HTTP_REFERER']));
}

$logentry->setComment($_POST['comment']);
$referer = $_POST['referer'];

if ($logentry->isValid()) {
    $logentry->updateInDb();
    header("Location: $referer");
} else {
    $errors = $logentry->errors;
    showView('editlog.php', array('logentry' => $logentry, 'editlogRef' => $referer, 'errors' => $errors));
}