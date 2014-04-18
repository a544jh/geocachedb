<?php $user = User::getUserById($logentry->getUser()) ?>
<div class="panel panel-geocachedb">
    <div class="row">
        <div class="col-md-2">
            <?php echo date('Y-m-d H:i', strtotime($logentry->getTimestamp())) ?>
            <?php
            $edited = $logentry->getEdited();
            if (isset($edited)):
                ?><br>Edited <?php
                echo date('Y-m-d H:i', strtotime($edited));
            endif;
            ?>
            <br>
            <?php if ($logentry->userIsOwner()): ?>
                <a class="btn btn-default btn-xs" href="editlog.php?id=<?php echo $logentry->getId() ?>">Edit <span class="glyphicon glyphicon-edit"></span></a>
                <?php
            endif;
            if ($logentry->userIsOwner()):
                ?>
                <a class="btn btn-default btn-xs" href="deletelog.php?id=<?php echo $logentry->getId()?>">Delete <span class="glyphicon glyphicon-remove"></span></a>
            <?php endif; ?>
            <div class="panel panel-geocachedb">
                <a href="userprofile.php"><?php echo $user->getUsername(); ?></a><br>
                <?php echo $user->visittypeCount('found') ?> Found
            </div>
        </div>
        <div class="col-md-10">
            <?php
            $visitMessage = Logentry::$visitMessages[$logentry->getVisittype()];
            if ($visitMessage != null):
                ?>
                <div class="panel panel-geocachedb">
                    <?php echo $visitMessage; ?>
                </div>
                <?php
            endif;
            $comment = htmlspecialchars($logentry->getComment());
            if (isset($comment)):
                ?>
                <div class="panel panel-geocachedb">
                    <?php echo $comment; ?>
                </div>
                <?php
            endif;
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
                            case 'comment':
                                ?>
                                Left a comment on <a href="trackableview.php?id=<?php echo $trackablelog->getTrackableid() ?>"><?php echo Trackable::getTrackableById($trackablelog->getTrackableid())->getName() ?></a>
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