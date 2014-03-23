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
        <h4>Logging [trackableid]</h4>
        <form class="form-inline" role="form">
            <div class="form-group">
                <label for="logType">Action</label>
                <select class="form-control" id="logType">
                    <option>Do nothing(leave comment)</option>
                    <option>Grab it</option>
                </select>
                <label for="trackableidCode">Tracking code</label>
                <input type="text" class="form-control" id="trackableidCode">
                <br>
                <label for="logComment">Comment</label>
                <textarea class="form-control" id="logComment"></textarea>
                <br>
                <button type="button" class="btn btn-default">Submit</button>
            </div>
        </form>
    </body>
</html>