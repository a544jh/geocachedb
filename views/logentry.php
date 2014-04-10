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
<!--            <div class="panel panel-geocachedb">
                Dropped off <a href="trackableview.php">trackable</a>
            </div>-->
        </div>
    </div>
</div>