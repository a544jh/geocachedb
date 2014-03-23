<!DOCTYPE html>
<html>
    <head>
        <title>Trackable name - geocachedb</title>
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
                        [Trackable type]<br>
                        [datemade]<br>
                        [current location]
                    </div>
                    <a href="posttrackablelog.php" role="button" class="btn btn-default btn-block">Grab it / comment</a>

                </div>
                <div class="col-md-10">
                    <div class="panel panel-geocachedb">
                        <h3><h3><input type="text" class="form-control" id="trackableNameField" placeholder="Trackable name"></h3></h3><br>
                        by someuser
                    </div>



                    <div class="panel panel-geocachedb">
                        <font class="lead">Travelled 87km Been at 12 users and 15 geocaches</font>
                    </div>
                    <div class="panel panel-geocachedb">
                        <h4>Description</h4>
                        <textarea class="form-control" id="description"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-default">Submit</button>
        <h4>Logs</h4>
        <?php include 'samplelog.php'; ?>
    </body>
</html>
