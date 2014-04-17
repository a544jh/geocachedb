<?php
$logentry = $data->logentry;
$trackable = $data->trackable;
?>
<h4>Logging <?php echo $trackable->getName() ?></h4>
<form class="form-inline" role="form" method="post">
    <input type="hidden" name="id" value="<?php echo $trackable->getId(); ?>">
    <div class="form-group">
        <label for="logType">Action</label>
        <select class="form-control" id="logType" name="action">
            <option value="comment">Leave comment</option>
            <option value="grab">Grab</option>
        </select>
        <label for="trackableidCode">Tracking code</label>
        <input type="text" class="form-control" id="trackableidCode" name="trackingcode">
        <br>
        <label for="logComment">Comment</label>
        <textarea class="form-control" id="logComment" name="comment"><?php echo $logentry->getComment() ?></textarea>
        <br>
        <button type="submit" class="btn btn-default">Submit</button>
    </div>
</form>