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
        <h4>Logging [geocacheid]</h4>
        <form class="form-inline" role="form">
            <div class="form-group">
                <label for="logType">Log type</label>
                <select class="form-control" id="logType">
                    <option>Found</option>
                    <option>Didn't find</option>
                    <option>Leave comment</option>
                </select>
                <br>
                <label for="logComment">Comment</label>
                <textarea class="form-control" id="logComment"></textarea>
                <br>
                Trackables in cache
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
                    </tbody></table>
                <button type="button" class="btn btn-default">Submit</button>
            </div>
        </form>
    </body>
</html>