<?php $trackable = $data->trackable; ?>
<form action="<?php echo $data->action; ?>" method="POST">
    <div class="panel panel-geocachedb">
        <div class ="row">
            <div class="col-md-2">
                <div class="panel panel-geocachedb">
                    Created <?php echo $trackable->getDateadded(); ?><br>
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-geocachedb">
                    <h3><h3><input type="text" class="form-control" id="trackableNameField" placeholder="Trackable name" name="name" value="<?php echo $trackable->getName() ?>"></h3></h3><br>
                    by <?php echo $_SESSION['user']->getLink() ?>
                </div>
                <div class="panel panel-geocachedb">
                    <font class="lead">Travelled --km Been at -- users and -- geocaches</font>
                </div>
                <div class="panel panel-geocachedb">
                    <h4>Description</h4>
                    <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($trackable->getDescription()) ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<h4>Logs</h4>