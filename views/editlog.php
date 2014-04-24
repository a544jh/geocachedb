<?php $logentry = $data->logentry ?>
<h4>Edit comment</h4>
<br>
<form class="form-inline" role="form" method="post">
    <input type="hidden" name="referer" value="<?php echo $data->editlogReferer ?>">
    <textarea class="form-control" name="comment"><?php echo htmlspecialchars($logentry->getComment()) ?></textarea>
    <br>
    <button type="submit" class="btn btn-default">Submit</button>
</form>