<?php
require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';
$geocaches = Geocache::getGeocachesList();
showView('geocachelist.php', array('geocachelist' => $geocaches));

