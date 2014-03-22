<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
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
                <label for="searchField">Search:</label> <input type="text" class="form-control" id="searchField">
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Star</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Difficulty</th>
                    <th>Terrain</th>
                    <th>Found</th>
                    <th>Distance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>Trad.</td>
                    <td><a href="geocacheview.php">Geocahe name</a></td>
                    <td>1</td>
                    <td>2</td>
                    <td>129</td>
                    <td>2km</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Multi</td>
                    <td>Geocahe name</td>
                    <td>5</td>
                    <td>2</td>
                    <td>12</td>
                    <td>2,2km</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
