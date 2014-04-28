<?php

require_once 'libs/models/trackable.php';
require_once 'libs/models/user.php';
require_once 'libs/utils.php';

if (empty($_GET)) {
    showView('trackablelist.php', array('trackablelist' => Trackable::getTrackablesList(),
        'trackablelistHeader' => "All trackables"));
}

if (isset($_GET['search'])) {
    if ($_GET['search'] === 'owner') {
        $ownerid = filter_input(INPUT_GET, 'user');
        showView('trackablelist.php', array('trackablelist' => Trackable::trackablesOwnedBy($ownerid),
        'trackablelistHeader' => "Trackables owned by " . User::getUserById($ownerid)->getUsername()));
    }
}