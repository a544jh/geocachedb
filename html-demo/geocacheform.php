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
                <div class="panel panel-geocachedb">
                    <div class ="row">
                        <div class="col-md-5">
                            <div class="panel panel-geocachedb">
                                <label for="cacheType">Cache type</label>
                                <select class="form-control" id="logType">
                                    <option>Traditional</option>
                                    <option>Multi</option>
                                    <option>Puzzle</option>
                                </select><br>
                                [datehidden]<br>
                                <input type="text" class="form-control" id="coordinatesField" placeholder="Coordinates">
                            </div>
                            

                        </div>
                        <div class="col-md-10">
                            <div class="panel panel-geocachedb">
                                <h3><input type="text" class="form-control" id="coordinatesField" placeholder="Cache name"></h3><br>
                                by someuser
                            </div>



                            <div class="panel panel-geocachedb">
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
                            <div class="panel panel-geocachedb">
                                <h4>Description</h4>
                                <textarea class="form-control" id="description"></textarea>
                            </div>

                        </div></div></div>
                <h4>Logs</h4>
                <div class="panel panel-geocachedb">
                    <div class="row">
                        <div class="col-md-2">
                            [timestamp]
                            <span class="glyphicon glyphicon-remove"></span>
                            <div class="panel panel-geocachedb">
                                Username<br>
                                250 found
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="panel panel-geocachedb">
                                User found cache!
                            </div>
                            <div class="panel panel-geocachedb">
                                [Comment] Kiva kätkö! KK!
                            </div>
                            <div class="panel panel-geocachedb">
                                Dropped off trackable
                            </div>
                        </div>
                    </div></div>
            </div></form>
    </body>
</html>
