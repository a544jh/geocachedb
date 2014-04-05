<form class="form-inline" role="form" action="geocachelist.php" method="get">
    <input type="hidden" name="search" value="name">
            <div class="form-group">
                <label for="searchField">Search:</label> <input type="text" class="form-control" id="searchField" placeholder="Geocahe name" name="name">
                <label><input type="checkbox" name="published">Published</label>
                <label><input type="checkbox" name="archived">Archived</label>
                <button class="btn btn-sm" type="submit">Search</button>
            </div>
        </form>
        <?php if(empty($data->geocachelist)): ?>
        No geocaches found.
        <?php else: ?>
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
                    <td><?php if ($geocache->getArchived()){echo '<del>';}?><a href="geocacheview.php?id=<?php echo $geocache->getId(); ?>"><?php echo $geocache->getName(); ?></a><?php if ($geocache->getArchived()){echo'</del>';} ?></td>
                    <td><?php echo $geocache->getDifficulty(); ?></td>
                    <td><?php echo $geocache->getTerrain(); ?></td>
                    <td>--</td>
                    <td>--</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>