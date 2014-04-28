<?php $user = $data->user ?>
<div class="panel panel-geocachedb">
    <div class ="row">
        <div class="col-md-2">
            <div class="panel panel-geocachedb">
                <ul class="nav">
                    <li><a href="geocachelist.php?search=owner&user=<?php echo $user->getId() ?>">Hidden caches</a></li>
                    <li><a href="geocachelist.php?search=foundby&user=<?php echo $user->getId() ?>">Found caches</a></li>
                    <li><a href="trackablelist.php?search=owner&user=<?php echo $user->getId() ?>">Owned trackables</a></li>
                </ul>
            </div>
            <?php if (isset($_SESSION['user']) && $user->getId() == $_SESSION['user']->getId()): ?>
            <a class="btn btn-default btn-block" href="changepassword.php">Change password</a>
            <a class="btn btn-default btn-block" href="editbio.php">Edit bio</a>
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