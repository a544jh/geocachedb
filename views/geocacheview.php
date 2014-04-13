<?php $geocache = $data->geocache;
require_once 'libs/models/trackable.php';
require_once 'libs/models/trackablelog.php';
?>
<div class="panel panel-geocachedb">
    <div class ="row">
        <div class="col-md-2">
            <div class="panel panel-geocachedb">
                <?php echo $geocache->getType(); ?><br>
                Hidden <?php echo $geocache->getDateadded(); ?><br>
                <?php if (loggedIn()) : ?>
                    Coordinates<br>     
                    <?php echo $geocache->getLatitude(); ?><br>
                    <?php echo $geocache->getLongitude(); ?>
<?php else: ?> You must be logged in to see coordinates.<?php endif; ?>
            </div>
            <div class="panel panel-geocachedb">
                Trackables in cache<br>
                <?php foreach (Trackable::trackablesInCache($geocache) as $trackable): ?>
                    <a href="trackableview.php?id=<?php echo $trackable->getId() ?>"><?php echo $trackable->getName() ?></a><br>
            <?php endforeach; ?>
            </div>
<?php if (loggedIn()): ?>
                <a href="logcache.php?id=<?php echo $geocache->getId() ?>" role="button" class="btn btn-default btn-block">Post log 
                    <span class="glyphicon glyphicon-comment"></span></a><?php endif; ?>
<?php if ($geocache->userIsOwner()): ?>
                <a href="editcache.php?id=<?php echo $geocache->getId() ?>" role="button" class="btn btn-default btn-block">Edit 
                    <span class="glyphicon glyphicon-edit"></span></a><?php endif; ?>
<?php if (userHasMinRole(5) && !$geocache->getPublished()): ?>
                <a href="publishcache.php?id=<?php echo $geocache->getId() ?>" role="button" class="btn btn-default btn-block">Publish 
                    <span class="glyphicon glyphicon-ok-sign"></span></a><?php endif; ?>
<?php if ($geocache->userIsOwner() && !$geocache->getArchived()): ?>
                <a href="archivecache.php?id=<?php echo $geocache->getId() ?>" role="button" class="btn btn-default btn-block">Archive 
                    <span class="glyphicon glyphicon-remove"></span></a><?php endif; ?>

        </div>
        <div class="col-md-10">
            <div class="panel panel-geocachedb">
                <h3><?php echo $geocache->getName(); ?></h3><br>
                by <a href="userprofile.php"><?php echo User::getUserById($geocache->getOwner())->getUsername(); ?></a>
            </div>



            <div class="panel panel-geocachedb">
                Difficulty:<?php echo $geocache->getDifficulty(); ?>
                Terrain:<?php echo $geocache->getTerrain(); ?> <font class="lead"><?php echo $geocache->visittypeCount('found'); ?> Found it, <?php echo $geocache->visittypeCount('dnf'); ?> Didn't find it</font>
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
<?php
require_once 'libs/models/logentry.php';
$logentries = Logentry::getLogsForCache($geocache);
foreach ($logentries as $logentry) {
    include 'views/logentry.php';
}
