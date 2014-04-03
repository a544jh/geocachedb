<form class="form-inline" role="form">
            <div class="form-group">
                <label for="searchField">Search:</label> <input type="text" class="form-control" id="searchField">
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Difficulty</th>
                    <th>Terrain</th>
                    <th>Found</th>
                    <th>Distance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->geocachelist as $geocache): ?>
                <tr>
                    <td><?php echo $geocache->getType(); ?></td>
                    <td><a href="geocacheview.php?id=<?php echo $geocache->getId(); ?>"><?php echo $geocache->getName(); ?></a></td>
                    <td><?php echo $geocache->getDifficulty(); ?></td>
                    <td><?php echo $geocache->getTerrain(); ?></td>
                    <td>--</td>
                    <td>--</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>