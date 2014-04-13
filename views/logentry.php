<?php $user = User::getUserById($logentry->getUser()) ?>
<div class="panel panel-geocachedb">
    <div class="row">
        <div class="col-md-2">
            <?php echo $logentry->getTimestamp() ?>
            <br>
<!--            <button type="button" class="btn btn-default btn-xs">Delete <span class="glyphicon glyphicon-remove"></span></button>-->
            <div class="panel panel-geocachedb">
                <a href="userprofile.php"><?php echo $user->getUsername(); ?></a><br>
                <?php echo $user->visittypeCount('found') ?> Found
            </div>
        </div>
        <div class="col-md-10">
            <div class="panel panel-geocachedb">
                <?php echo Logentry::$visitMessages[$logentry->getVisittype()]; ?>
            </div>
            <div class="panel panel-geocachedb">
                <?php echo htmlspecialchars($logentry->getComment()); ?>
            </div>
            <?php
            $trackablelogs = $logentry->getTrackableLogs();
            if (!empty($trackablelogs)):
                foreach ($trackablelogs as $trackablelog):
                    ?>
                    <div class="panel panel-geocachedb">
                        <?php
                        switch ($trackablelog->getAction()):
                            case 'create':
                                echo "Created "
                                ?><a href="trackableview.php?id=<?php echo $trackablelog->getTrackableid() ?>"><?php echo Trackable::getTrackableById($trackablelog->getTrackableid())->getName() ?></a>
                                <?php
                                break;
                            case 'grab':
                                ?>
                                Grabbed <a href="trackableview.php?id=<?php echo $trackablelog->getTrackableid() ?>"><?php echo Trackable::getTrackableById($trackablelog->getTrackableid())->getName() ?></a> from
                                <?php if ($logentry->getGeocacheid() != null):
                                    ?><a href="geocacheview.php?id=<?php echo $logentry->getGeocacheid() ?>"><?php echo Geocache::getGeocacheById($logentry->getGeocacheid())->getName() ?></a>
                                <?php else: ?>
                                    <a href="userprofile.php?id=<?php echo $trackablelog->getFromuser() ?>"><?php echo User::getUserById($trackablelog->getFromuser())->getUsername() ?></a> 
                                <?php
                                endif;
                                break;
                            case 'drop':
                                ?>
                                Dropped <a href="trackableview.php?id=<?php echo $trackablelog->getTrackableid() ?>"><?php echo Trackable::getTrackableById($trackablelog->getTrackableid())->getName() ?></a> into 
                                <a href="geocacheview.php?id=<?php echo $logentry->getGeocacheid() ?>"><?php echo Geocache::getGeocacheById($logentry->getGeocacheid())->getName() ?></a>
                                <?php
                                break;
                            case 'visit':
                                ?>
                                <a href="trackableview.php?id=<?php echo $trackablelog->getTrackableid() ?>"><?php echo Trackable::getTrackableById($trackablelog->getTrackableid())->getName() ?></a>
                                visited <a href="geocacheview.php?id=<?php echo $logentry->getGeocacheid() ?>"><?php echo Geocache::getGeocacheById($logentry->getGeocacheid())->getName() ?></a>
                                <?php
                                break;
                        endswitch;
                        ?>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>