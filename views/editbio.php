<?php $user = $data->user ?>
<h4>Edit bio</h4>
<form class="form-inline" role="form" method="post">
    <textarea class="form-control" name="bio"><?php echo htmlspecialchars($user->getBio()) ?></textarea>
    <br>
    <button type="submit" class="btn btn-default">Submit</button>
</form>