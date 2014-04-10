<?php

require_once 'libs/models/trackable.php';
require_once 'libs/utils.php';

showView('trackablelist.php', array('trackablelist' => Trackable::getTrackablesList()));