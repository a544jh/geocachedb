<?php

require_once 'libs/models/geocache.php';
require_once 'libs/models/user.php';
require_once 'libs/utils.php';

if (isset($_GET['search'])) {
    if ($_GET['search'] === 'name') {
        $name = '%' . filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING) . '%';
        $published = isset($_GET['published']);
        $archived = isset($_GET['archived']);
        $pub = ($published ? "Published" : "Unpublished");
        $arc = ($archived ? "Archived" : "Unarchived");
        $header = (strlen($name) === 2 ? "All $pub and $arc geocaches" :
                        "$pub and $arc geocaches with name containing " . substr($name, 1, strlen($name) - 2));
        if ($published === false && !userHasMinRole(5)) {
            showView('geocachelist.php', array('geocachelist' => $geocachelist,
                'error' => "You do not have the rights to view unpublished caches.",
                'geocachelistHeader' => $header));
        }
        $geocachelist = Geocache::searchByName($name, $published, $archived);
        showView('geocachelist.php', array('geocachelist' => $geocachelist, 'geocachelistHeader' => $header));
    }
    if ($_GET['search'] === 'coords') {
        $lat = filter_input(INPUT_GET, 'lat', FILTER_SANITIZE_STRING);
        $lon = filter_input(INPUT_GET, 'lon', FILTER_SANITIZE_STRING);
        $header = "Geocaches near $lat, $lon";
        if (!is_numeric($lat) || !is_numeric($lon)) {
            showView('geocachelist.php', array('geocachelist' => $geocachelist,
                'error' => 'Coordinates must be numeric.',
                'geocachelistHeader' => ''));
        }
        $geocachelist = Geocache::searchByCoords($lat, $lon);
        showView('geocachelist.php', array('geocachelist' => $geocachelist,
            'geocachelistHeader' => $header));
    }
    if ($_GET['search'] === 'owner') {
        $ownerid = $_GET['user'];
        $geocachelist = Geocache::getCachesOwnedBy($ownerid);
        $header = "Geocaches owned by " . User::getUserById($ownerid)->getUsername();
        showView('geocachelist.php', array('geocachelist' => $geocachelist, 
            'geocachelistHeader' => $header, 'showForm' => false));
    }
    if($_GET['search'] === 'foundby') {
        $userid = $_GET['user'];
        $geocachelist = Geocache::getCachesFoundBy($userid);
        $header = "Geocaches found by " . User::getUserById($userid)->getUsername();
        showView('geocachelist.php', array('geocachelist' => $geocachelist, 
            'geocachelistHeader' => $header, 'showForm' => false));
    }
}

//$geocachelist = Geocache::getGeocachesList();
//$geocachelist = Geocache::searchByName('%', true, false);
//showView('geocachelist.php', array('geocachelist' => $geocachelist));
header('Location: geocachelist.php?search=name&name=&published=on');

