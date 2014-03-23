<!DOCTYPE html>
<html>
    <head>
        <title>User profile - geocachedb</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">

        <script src="../js/jquery-1.11.0.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <div class="panel panel-geocachedb">
            <div class ="row">
                <div class="col-md-2">
                    <div class="panel panel-geocachedb">
                        <ul class="nav">
                            <li><a href="geocachelist.php">Hidden caches</a></li>
                            <li><a href="geocachelist.php">Found caches</a></li>
                            <li><a href="#">Owned trackables</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="panel panel-geocachedb">
                        <h3>Username</h3>
                        <font class="lead">250 caches found</font>
                        <p>
                            [bio]
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <h4>Logs by user</h4>
        <?php include 'samplelog.php'; ?>
    </body>
</html>