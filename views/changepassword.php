<?php $user = $data->user; ?>
<h4>Change password for user <?php echo $user->getUsername() ?></h4>
<div class="col-md-3">
    <form class="form" method="post" action="changepassword.php">
        <label>Current password:</label>
        <input class="form-control" type="password" name="currentPassword">
        <br>
        <label>New password:</label>
        <input class="form-control" type="password" name="newPassword">
        <br>
        <label>Verify new password:</label>
        <input class="form-control" type="password" name="verifyNewPassword">
        <br>
        <button class="btn btn-default" type="submit">Change password</button>
    </form>
</div>