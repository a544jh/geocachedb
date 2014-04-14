<?php

require_once 'libs/models/logentry.php';
require_once 'libs/models/geocache.php';
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
$geocache = Geocache::getGeocacheById($id);

$newLogentry = new Logentry();
//show the form
if (empty($_POST)) {
    showView('logcache.php', array('logentry' => $newLogentry, 'geocache' => $geocache));
}
//if there is data in POST, set the fields in the object
$newLogentry->setUser($_SESSION['user']);
$newLogentry->setGeocacheid($geocache->getId());
$newLogentry->setVisittype($_POST['visittype']);
$newLogentry->setComment($_POST['comment']);

$trackablelogs = array();
//create trackablelogs for the selected actions in the form
foreach (array_keys($_POST) as $action) {
    if (preg_match('/\d+_action/', $action)){
        $expl = explode('_', $action);
        $trackableid = $expl[0];
        if ($_POST[$action] == 'grab') {
            $trackablelogs[] = new Trackablelog('grab', $trackableid, null);
        }
        if ($_POST[$action] == 'drop') {
            $trackablelogs[] = new Trackablelog('drop', $trackableid, null);
        }
        if ($_POST[$action] == 'visit'){
            $trackablelogs[] = new Trackablelog('visit', $trackableid, null);
        }
    }
}
//check the tracking codes
$trackingcodeErrors = array();
foreach($trackablelogs as $trackablelog) {
    if ($trackablelog->getAction() == 'grab') {
        $trackable = Trackable::getTrackableById($trackablelog->getTrackableid());
        if (!($trackable->getTrackingcode() === 
                $_POST[$trackable->getId().'_trackingcode'])) {
            $trackingcodeErrors[] = "Wrong tracking code for trackable ".$trackable->getName();
        }
    }
}

if ($newLogentry->isValid() && empty($trackingcodeErrors)) {
    $newLogentry->insertIntoDb();
    foreach ($trackablelogs as $trackablelog) {
        $trackablelog->insertIntoDb($newLogentry);
    }
    header('Location: geocacheview.php?id=' . $geocache->getId());
} else {
    $logerrors = $newLogentry->errors;
    showView('logcache.php', array('logentry' => $newLogentry, 'geocache' => $geocache, 'errors' => array_merge($logerrors, $trackingcodeErrors)));
}
