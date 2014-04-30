<?php
$user = User::getUserById($logentry->getUser());
require_once 'libs/models/trackable.php';
?>
<div class="panel panel-geocachedb">
    <div class="row">
        <div class="col-md-2">
            <?php echo date('Y-m-d H:i', strtotime($logentry->getTimestamp())) ?>
            <?php
            $edited = $logentry->getEdited();
            if (isset($edited)):
                ?><br><small>Edited <?php echo date('Y-m-d H:i', strtotime($edited)); ?></small>
            <?php endif;
            ?>
            <br>
            <?php if ($logentry->userIsOwner()): ?>
                <a class="btn btn-default btn-xs" href="editlog.php?id=<?php echo $logentry->getId() ?>">Edit <span class="glyphicon glyphicon-edit"></span></a>
                <?php
            endif;
            if ($logentry->userIsOwner()):
                ?>
                <a class="btn btn-default btn-xs" href="deletelog.php?id=<?php echo $logentry->getId() ?>">Delete <span class="glyphicon glyphicon-remove"></span></a>
            <?php endif; ?>
            <div class="panel panel-geocachedb">
                <?php echo $user->getLink() ?><br>
                <?php echo $user->visittypeCount('found') ?> Found
            </div>
        </div>
        <div class="col-md-10">
            <?php
            if ($logentry->getVisittype() != null):
                $visittype = $logentry->getVisittype();
                $visitMessage = Logentry::$visitMessages[$logentry->getVisittype()];
                ?>
                <div class="panel panel-geocachedb">
                    <?php echo $visitMessage . " " . Geocache::getGeocacheById($logentry->getGeocacheid())->getLink() ?>
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
                                ?>
                                Created
                                <?php
                                echo Trackable::getTrackableById($trackablelog->getTrackableid())->getLink();
                                break;
                            case 'grab':
                                ?>
                                Grabbed <?php echo Trackable::getTrackableById($trackablelog->getTrackableid())->getLink() ?> from
                                <?php
                                if ($logentry->getGeocacheid() != null):
                                    echo Geocache::getGeocacheById($logentry->getGeocacheid())->getLink();
                                else:
                                    echo User::getUserById($trackablelog->getFromuser())->getLink();
                                endif;
                                break;
                            case 'drop':
                                ?>
                                Dropped <?php echo Trackable::getTrackableById($trackablelog->getTrackableid())->getLink() ?> into 
                                <?php echo Geocache::getGeocacheById($logentry->getGeocacheid())->getLink(); ?>
                                <?php
                                break;
                            case 'visit':
                                ?>
                                <?php echo Trackable::getTrackableById($trackablelog->getTrackableid())->getLink() ?>
                                visited <?php echo Geocache::getGeocacheById($logentry->getGeocacheid())->getLink(); ?>
                                <?php
                                break;
                            case 'comment':
                                ?>
                                Left a comment on <?php echo Trackable::getTrackableById($trackablelog->getTrackableid())->getLink() ?>
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