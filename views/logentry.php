<div class="panel panel-geocachedb">
    <div class="row">
        <div class="col-md-2">
            <?php echo $logentry->getTimestamp() ?>
            <br>
<!--            <button type="button" class="btn btn-default btn-xs">Delete <span class="glyphicon glyphicon-remove"></span></button>-->
            <div class="panel panel-geocachedb">
                <a href="userprofile.php"><?php echo User::getUserById($logentry->getUser())->getUsername(); ?></a><br>
                -- found
            </div>
        </div>
        <div class="col-md-10">
            <div class="panel panel-geocachedb">
                <?php echo Logentry::$visitMessages[$logentry->getVisittype()]; ?>
            </div>
            <div class="panel panel-geocachedb">
                <?php echo htmlspecialchars($logentry->getComment()); ?>
            </div>
            <?php foreach ($logentry->getTrackableLogs() as $trackablelog): ?>
                <div class="panel panel-geocachedb">
                    <?php
                    switch ($trackablelog->getAction()):
                        case 'create':
                            echo "Created " ?><a href="trackableview.php?id=<?php echo $trackablelog->getTrackable() ?>"><?php echo Trackable::getTrackableById($trackablelog->getTrackable())->getName() ?></a>
                            <?php
                            break;
                        case 'grab':
                            echo "Grabbed from ";
                            if ($logentry->getGeocacheid != null):
                                ?><a href="geocacheview.php?id=<?php echo $logentry->getGeocacheid() ?>"><?php echo Geocache::getGeocacheById($logentry->getGeocacheid())->getName() ?></a>
                            <?php else: ?>
                                <a href="userprofile.php?id=<?php echo $trackablelog->getFromuser() ?>"><?php echo User::getUserById($trackablelog->getFromuser())->getUsername() ?></a> 
                            <?php
                            endif;
                            break;
                        case 'drop':
                            echo "Dropped into "
                            ?><a href="geocacheview.php?id=<?php echo $logentry->getGeocacheid() ?>"><?php echo Geocache::getGeocacheById($logentry->getGeocacheid())->getName() ?></a>
                            <?php
                            break;
                    endswitch;
                    ?>
                </div>
<?php endforeach; ?>
        </div>
    </div>
</div>