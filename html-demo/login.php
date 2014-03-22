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
        <form class="form-inline" role="form">
            <div class="form-group">
                <label for="usernameField">Username:</label>
                <input type="text" class="form-control" id="usernameField">
                <br>
                <label for="passwordField">Password:</label>
                <input type="password" class="form-control" id="passwordField">
                <br>
                <button type="button" class="btn btn-default">Submit</button>
            </div>
        </form>
    </body>
</html>