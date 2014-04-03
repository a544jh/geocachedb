<form action="addcache.php" method="POST">
    <div class="panel panel-geocachedb">
        <div class ="row">
            <div class="col-md-2">
                <div class="panel panel-geocachedb">
                    <div class="form" role="form">
                        <div class="form-group">
                            <label for="cacheType">Cache type</label>
                            <select class="form-control" id="cacheType" name="type">
                                <option value="Trad.">Trad.</option>
                                <option value="Multi">Multi</option>
                                <option value="Puzzle">Puzzle</option>
                            </select><br>
                            [datehidden]<br>
                            <input type="text" class="form-control" id="latitudeField" placeholder="Latitude" name="latitude">
                            <input type="text" class="form-control" id="longitudeField" placeholder="Longitude" name="longitude">
                        </div></div>
                </div></div>
            <div class="col-md-10">
                <div class="panel panel-geocachedb">
                    <div class="form" role="form">
                        <div class="form-group">
                            <div class="panel panel-geocachedb">
                                <h3><input type="text" class="form-control" id="cacheNameField" placeholder="Cache name" name="name" value="<?php echo $data->geocache->getName(); ?>"></h3><br>
                                by someuser
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-geocachedb">
                        <div class="form-inline" role="form">
                            <div class="form-group">
                                Difficulty:<select class="form-control" id="difficultySelector" name="difficulty">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                Terrain:<select class="form-control" id="terrainSelector" name="terrain">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                <font class="lead">-- Found</font>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-geocachedb">
                        <h4>Description</h4>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="panel panel-geocachedb">
                        <h4>Hint</h4>
                        <input type="text" class="form-control" id="hintField" name="hint">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<h4>Logs</h4>