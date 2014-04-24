<?php $user = $data->user ?>
<div class="panel panel-geocachedb">
    <div class ="row">
        <div class="col-md-2">
            <div class="panel panel-geocachedb">
                <ul class="nav">
                    <li><a href="#">Hidden caches</a></li>
                    <li><a href="#">Found caches</a></li>
                    <li><a href="#">Owned trackables</a></li>
                    <li><a href="#">Discovered trackables</a></li>
                </ul>
            </div>
            <?php if (isset($_SESSION['user']) && $user->getId() == $_SESSION['user']->getId()): ?>
                <a class="btn btn-default" href="#">Change password</a>
                <a class="btn btn-default" href="#">Edit bio</a>
            <?php endif; ?>
        </div>
        <div class="col-md-10">
            <div class="panel panel-geocachedb">
                <h3><?php echo $user->getUsername() ?></h3>
                <font class="lead"><?php echo $user->visittypeCount('found') ?> caches found</font>
                <p>
                    <?php echo htmlspecialchars($user->getBio()) ?>
                </p>

            </div>
        </div>
    </div>
</div>
<h4>Logs by user</h4>
<?php
require_once 'libs/models/logentry.php';
$logentries = Logentry::getLogsByUser($user);
foreach ($logentries as $logentry) {
    include 'views/logentry.php';
}