<?php

require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';
$id = (int) $_GET['id'];
$geocache = Geocache::getGeocacheById($id);

if ($geocache != null) {
    showView('geocacheview.php', array('geocache' => $geocache));
} else {
    showView('geocacheview.php', array('geocache' => null,
        'error' => "Geocache not found!"));
}
