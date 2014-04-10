<?php

require_once 'libs/models/trackable.php';
require_once 'libs/utils.php';
$id = (int) $_GET['id'];
$trackable = Trackable::getTrackableById($id);

if ($trackable != null) {
    showView('trackableview.php', array('trackable' => $trackable));
} else {
    showView('trackableview.php', array('trackable' => null,
        'error' => "Trackable not found!"));
}