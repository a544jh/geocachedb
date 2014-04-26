<!DOCTYPE html>
<html>
    <head>
        <title>Geocache name - geocachedb</title>
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
                        [Geocache type]<br>
                        [dateadded]<br>
                        [coordinates]<br>
                    </div>
                    <div class="panel panel-geocachedb">
                        Trackables in cache<br>
                        <a href="trackableview.php">Trackable</a>
                    </div>
                    <a href="postlog.php" role="button" class="btn btn-default btn-block">Post log 
                        <span class="glyphicon glyphicon-comment"></span></a>
                    <a href="geocacheform.php" role="button" class="btn btn-default btn-block">Edit 
                        <span class="glyphicon glyphicon-edit"></span></a>
                    <a href="#" role="button" class="btn btn-default btn-block">Archive 
                        <span class="glyphicon glyphicon-remove"></span></a>

                </div>
                <div class="col-md-10">
                    <div class="panel panel-geocachedb">
                        <h3>Geocahe name</h3>
                        by <a href="userprofile.php">someuser</a>
                    </div>



                    <div class="panel panel-geocachedb">
                        Difficulty:1 Terrain:2 <font class="lead">129 Found - 12 Didn't find</font>
                    </div>
                    <div class="panel panel-geocachedb">
                        <h4>Description</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                    <div class="panel panel-geocachedb">
                        <h4>Hint</h4>
                        Kiven alla
                    </div>
                </div>
            </div>
        </div>
        <h4>Logs</h4>
        <?php include 'samplelog.php'; ?>
        <div class="panel panel-geocachedb">
            <div class="row">
                <div class="col-md-2">
                    [timestamp]
                    <div class="panel panel-geocachedb">
                        Admin
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="panel panel-geocachedb">
                        Cache was published [dateadded]
                    </div>
                    <div class="panel panel-geocachedb">
                        [Comment]
                    </div>
                </div>
            </div></div>
    </body>
</html>
