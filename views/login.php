<div class="row">
    <div class="col-md-2">
        <form class="form" role="form" action="login.php" method="POST">
            <div class="form-group">
                <label for="usernameField">Username:</label>
                <input type="text" class="form-control" id="usernameField" name="username"
                       value="<?php
                       if (isset($data->username)) {
                           echo $data->username;
                       }
                       ?>">
                <br>
                <label for="passwordField">Password:</label>
                <input type="password" class="form-control" id="passwordField" name="password">
                <br>
                <button type="submit" class="btn btn-default">Login</button>
            </div>
        </form>
    </div>
</div>
