<?php $geocache = $data->geocache; ?>
<form action="<?php echo $data->action; ?>" method="POST">
    <div class="panel panel-geocachedb">
        <div class ="row">
            <div class="col-md-2">
                <div class="panel panel-geocachedb">
                    <div class="form" role="form">
                        <div class="form-group">
                            <label for="cacheType">Cache type</label>
                            <select class="form-control" id="cacheType" name="type">
                                <option value="Trad." <?php if($geocache->getType() == 'Trad.'): echo ' selected'; endif; ?>>Trad.</option>
                                <option value="Multi" <?php if($geocache->getType() == 'Multi'): echo ' selected'; endif; ?>>Multi</option>
                                <option value="Puzzle" <?php if($geocache->getType() == 'Puzzle'): echo ' selected'; endif; ?>>Puzzle</option>
                            </select><br>
                            Hidden <?php echo $geocache->getDateadded(); ?><br>
                            <input type="text" class="form-control" id="latitudeField" placeholder="Latitude" name="latitude" value="<?php echo $geocache->getLatitude(); ?>">
                            <input type="text" class="form-control" id="longitudeField" placeholder="Longitude" name="longitude" value="<?php echo $geocache->getLongitude(); ?>">
                        </div></div>
                </div></div>
            <div class="col-md-10">
                <div class="panel panel-geocachedb">
                    <div class="form" role="form">
                        <div class="form-group">
                            <div class="panel panel-geocachedb">
                                <h3><input type="text" class="form-control" id="cacheNameField" placeholder="Cache name" name="name" value="<?php echo $geocache->getName(); ?>"></h3><br>
                                by <?php echo $_SESSION['user']->getLink() ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-geocachedb">
                        <div class="form-inline" role="form">
                            <div class="form-group">
                                Difficulty:<select class="form-control" id="difficultySelector" name="difficulty">
                                    <option<?php if($geocache->getDifficulty() == 1): echo ' selected'; endif; ?>>1</option>
                                    <option<?php if($geocache->getDifficulty() == 2): echo ' selected'; endif; ?>>2</option>
                                    <option<?php if($geocache->getDifficulty() == 3): echo ' selected'; endif; ?>>3</option>
                                    <option<?php if($geocache->getDifficulty() == 4): echo ' selected'; endif; ?>>4</option>
                                    <option<?php if($geocache->getDifficulty() == 5): echo ' selected'; endif; ?>>5</option>
                                </select>
                                Terrain:<select class="form-control" id="terrainSelector" name="terrain">
                                    <option<?php if($geocache->getTerrain() == 1): echo ' selected'; endif; ?>>1</option>
                                    <option<?php if($geocache->getTerrain() == 2): echo ' selected'; endif; ?>>2</option>
                                    <option<?php if($geocache->getTerrain() == 3): echo ' selected'; endif; ?>>3</option>
                                    <option<?php if($geocache->getTerrain() == 4): echo ' selected'; endif; ?>>4</option>
                                    <option<?php if($geocache->getTerrain() == 5): echo ' selected'; endif; ?>>5</option>
                                </select>
                                <font class="lead">-- Found</font>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-geocachedb">
                        <h4>Description</h4>
                        <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($geocache->getDescription()); ?></textarea>
                    </div>
                    <div class="panel panel-geocachedb">
                        <h4>Hint</h4>
                        <input type="text" class="form-control" id="hintField" name="hint" value="<?php echo $geocache->getHint() ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<h4>Logs</h4>