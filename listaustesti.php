<?php
require 'libs/models/user.php';
$list = User::getUsersList();
?>
<!DOCTYPE HTML>
<html>
    <head>

    </head>
    <body>
        <h1>List test</h1>
        <ul>
            <?php foreach ($list as $user): ?>
                <li><?php echo $user->getUsername(); ?></li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>