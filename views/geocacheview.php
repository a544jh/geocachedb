<?php $geocache = $data->geocache ?>
<div class="panel panel-geocachedb">
            <div class ="row">
                <div class="col-md-2">
                    <div class="panel panel-geocachedb">
                        <?php echo $geocache->getType(); ?><br>
                        <?php echo $geocache->getDateadded(); ?><br>
                        <?php echo $geocache->getLatitude(); ?><br>
                        <?php echo $geocache->getLongitude(); ?>
                    </div>
                    <div class="panel panel-geocachedb">
                        Trackables in cache<br>
                        <a href="trackableview.php">Trackable</a>
                    </div>
                    <a href="postlog.php" role="button" class="btn btn-default btn-block">Post log 
                        <span class="glyphicon glyphicon-comment"></span></a>
                    <a href="geocacheform.php" role="button" class="btn btn-default btn-block">Edit 
                        <span class="glyphicon glyphicon-edit"></span></a>
                    <a href="#" role="button" class="btn btn-default btn-block">Archive 
                        <span class="glyphicon glyphicon-remove"></span></a>

                </div>
                <div class="col-md-10">
                    <div class="panel panel-geocachedb">
                        <h3><?php echo $geocache->getName(); ?></h3><br>
                        by <a href="userprofile.php"><?php echo User::getUserById($geocache->getOwner())->getUsername(); ?></a>
                    </div>



                    <div class="panel panel-geocachedb">
                        Difficulty:<?php echo $geocache->getDifficulty(); ?>
                        Terrain:<?php echo $geocache->getTerrain(); ?> <font class="lead">-- Found - -- Didn't find</font>
                    </div>
                    <div class="panel panel-geocachedb">
                        <h4>Description</h4>
                        <p>
                            <?php echo htmlspecialchars($geocache->getDescription()); ?>
                        </p>
                    </div>
                    <div class="panel panel-geocachedb">
                        <h4>Hint</h4>
                        <?php echo $geocache->getHint(); ?>
                    </div>
                </div>
            </div>
        </div>
        <h4>Logs</h4>
        <div class="panel panel-geocachedb">
            <div class="row">
                <div class="col-md-2">
                    [timestamp]
                    <div class="panel panel-geocachedb">
                        Admin
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="panel panel-geocachedb">
                        Cache was published [dateadded]
                    </div>
                    <div class="panel panel-geocachedb">
                        [Comment]
                    </div>
                </div>
            </div></div>
