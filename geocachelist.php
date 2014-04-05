<?php

require_once 'libs/models/geocache.php';
require_once 'libs/utils.php';

if (isset($_GET['search'])) {
    if ($_GET['search'] == 'name') {
        $name = '%' . $_GET['name'] . '%';
        $published = isset($_GET['published']);
        $archived = isset($_GET['archived']);
        $geocachelist = Geocache::searchByName($name, $published, $archived);
        showView('geocachelist.php', array('geocachelist' => $geocachelist));
    }
}

$geocachelist = Geocache::getGeocachesList();
showView('geocachelist.php', array('geocachelist' => $geocachelist));

