<?php $trackable = $data->trackable; ?>
<div class="panel panel-geocachedb">
            <div class ="row">
                <div class="col-md-2">
                    <div class="panel panel-geocachedb">
                        Created <?php echo $trackable->getDateadded(); ?><br>
                        [current location]<br>
                        <?php if ($trackable->userIsOwner()): ?>
                        Tracking code <?php echo $trackable->getTrackingcode() ?>
                        <?php endif; ?>
                    </div>
                    <a href="posttrackablelog.php" role="button" class="btn btn-default btn-block">Grab it / comment 
                        <span class="glyphicon glyphicon-comment"></span></a>
                    <a href="trackableform.php" role="button" class="btn btn-default btn-block">Edit 
                        <span class="glyphicon glyphicon-edit"></span></a>
                </div>
                <div class="col-md-10">
                    <div class="panel panel-geocachedb">
                        <h3><?php echo $trackable->getName(); ?></h3><br>
                        by <a href="userprofile.php"><?php echo User::getUserById($trackable->getOwner())->getUsername(); ?></a>
                    </div>



                    <div class="panel panel-geocachedb">
                        <font class="lead">Travelled --km Been at -- users and -- geocaches</font>
                    </div>
                    <div class="panel panel-geocachedb">
                        <h4>Description</h4>
                        <p>
                            <?php echo htmlspecialchars($trackable->getDescription()); ?>
                        </p>
                    </div>

                </div></div></div>
        <h4>Logs</h4>