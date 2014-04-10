<?php $logentry = $data->logentry;
$geocache = $data->geocache; ?>
<h4>Logging <?php echo $geocache->getName(); ?></h4>
<form class="form-inline" role="form" method="POST" action="logcache.php">
    <input type="hidden" name="id" value="<?php echo $geocache->getId(); ?>">
    <div class="form-group">
        <label for="logType">Log type</label>
        <select class="form-control" id="logType" name="visittype">
            <option value="found">Found</option>
            <option value="dnf">Didn't find</option>
            <option value="comment">Leave comment</option>
        </select>
        <br>
        <label for="logComment">Comment</label>
        <textarea class="form-control" id="logComment" name="comment"></textarea>
        <br>
        <!--                Trackables in cache
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Trackable</th>
                                    <th>Action</th>
                                    <th>Tracking Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Trackable name</td>
                                    <td><select class="form-control" id="trackableidAction">
                                            <option>Do nothing</option>
                                            <option>Grab it</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" id="trackableidCode"></td>
                                </tr>
                            </tbody></table>
                        
                        Inventory
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Trackable</th>
                                    <th>Action</th>
                                    <th>Tracking Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Trackable name</td>
                                    <td><select class="form-control" id="trackableidAction">
                                            <option>Do nothing</option>
                                            <option>Visit</option>
                                            <option>Drop it</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" id="trackableidCode"></td>
                                </tr>
                            </tbody></table>-->
        <button type="submit" class="btn btn-default">Submit</button>
    </div>
</form>