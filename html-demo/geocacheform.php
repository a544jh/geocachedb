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
                        <form class="form" role="form">
                            <div class="form-group">
                                <label for="cacheType">Cache type</label>
                                <select class="form-control" id="logType">
                                    <option>Traditional</option>
                                    <option>Multi</option>
                                    <option>Puzzle</option>
                                </select><br>
                                [datehidden]<br>
                                <input type="text" class="form-control" id="coordinatesField" placeholder="Coordinates">
                            </div></form>
                    </div></div>
                    <div class="col-md-10">
                        <div class="panel panel-geocachedb">
                            <form class="form" role="form">
                                <div class="form-group">
                                    <div class="panel panel-geocachedb">
                                        <h3><input type="text" class="form-control" id="cacheNameField" placeholder="Cache name"></h3><br>
                                        by someuser
                                    </div>
                                </div>
                            </form>
                            <div class="panel panel-geocachedb">
                                <form class="form-inline" role="form">
                                    <div class="form-group">
                                        Difficulty:<select class="form-control" id="difficultySelector">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        Terrain:<select class="form-control" id="terrainSelector">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <font class="lead">129 Found</font>
                                    </div>
                                </form>
                            </div>
                            <div class="panel panel-geocachedb">
                                <h4>Description</h4>
                                <textarea class="form-control" id="description"></textarea>
                            </div>
                            <div class="panel panel-geocachedb">
                        <h4>Hint</h4>
                        <input type="text" class="form-control" id="hintField">
                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-default">Submit</button>
            <h4>Logs</h4>
            <?php include 'samplelog.php'; ?>
    </body>
</html>
