<?php $user = $data->user; ?>
<h4>Register a new user</h4>
<div class="col-md-3">
    <form class="form" method="post" action="register.php">
        <label>Username:</label>
        <input class="form-control" type="text" name="username" value="<?php echo $user->getUsername() ?>">
        <br>
        <label>Password:</label>
        <input class="form-control" type="password" name="password">
        <br>
        <label>Verify password:</label>
        <input class="form-control" type="password" name="verifyPassword">
        <br>
        <button class="btn btn-default" type="submit">Register</button>
    </form>
</div>