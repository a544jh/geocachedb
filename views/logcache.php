<?php
$logentry = $data->logentry;
$geocache = $data->geocache;
require_once 'libs/models/trackable.php';
?>
<h4>Logging <?php echo $geocache->getName(); ?></h4>
<form class="form-inline" role="form" method="POST" action="logcache.php">
    <input type="hidden" name="id" value="<?php echo $geocache->getId(); ?>">
    <div class="form-group">
        <label for="logType">Log type</label>
        <select class="form-control" id="logType" name="visittype">
            <option value="found">Found</option>
            <option value="dnf">Didn't find</option>
            <option value="comment">Leave comment</option>
        </select>
        <br>
        <label for="logComment">Comment</label>
        <textarea class="form-control" id="logComment" name="comment"><?php echo $logentry->getComment() ?></textarea>
        <br>
        Trackables in cache<br>
        <?php
        $incache = Trackable::trackablesInCache($geocache);
        if (!empty($incache)):
            ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Trackable</th>
                        <th>Action</th>
                        <th>Tracking Code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($incache as $trackable): ?>
                        <tr>
                            <td><?php echo $trackable->getName() ?></td>
                            <td><select class="form-control" id="trackableidAction" name="<?php echo $trackable->getId() . '_action' ?>">
                                    <option value="none">Do nothing</option>
                                    <option value="grab">Grab</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control" id="trackableidCode" name="<?php echo $trackable->getId() . '_trackingcode' ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody></table>
        <?php endif; ?>
        Inventory
        <?php
        $atuser = Trackable::trackablesHeldBy($_SESSION['user']);
        if (!empty($atuser)):
            ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Trackable</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($atuser as $trackable): ?>
                        <tr>
                            <td><?php echo $trackable->getName() ?></td>
                            <td><select class="form-control" id="trackableidAction" name="<?php echo $trackable->getId() . '_action' ?>">
                                    <option value="none">Do nothing</option>
                                    <option value="visit">Visit</option>
                                    <option value="drop">Drop</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody></table>
        <?php endif; ?>
        <button type="submit" class="btn btn-default">Submit</button>
    </div>
</form>