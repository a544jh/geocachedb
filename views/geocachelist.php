<?php if (!isset($data->showForm) || $data->showForm === true): ?>
<form class="form-inline" role="form" action="geocachelist.php" method="get">
    <input type="hidden" name="search" value="name">
            <div class="form-group">
                <label for="searchField">Search:</label>
                <input type="text" class="form-control" id="searchField" placeholder="Geocahe name" name="name">
                <label><input type="checkbox" name="published" <?php if(empty($_GET) || $_GET['published'] === 'on'): ?>checked<?php endif; ?>>Published</label>
                <label><input type="checkbox" name="archived">Archived</label>
                <button class="btn btn-sm" type="submit">Search</button>
            </div>
        </form>
<form class="form-inline" role="form" action="geocachelist.php" method="get">
    <input type="hidden" name="search" value="coords">
    <div class="form-group">
        <label>By distance:</label>
        <input type="text" class="form-control" placeholder="Latitude" name="lat">
        <input type="text" class="form-control" placeholder="Longitude" name="lon">
        <button class="btn btn-sm" type="submit">Search</button>
    </div>
</form>
<?php endif; ?>
<h4><?php echo $data->geocachelistHeader ?></h4>
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
                    <td><?php echo $geocache->getLink(); ?></td>
                    <td><?php echo $geocache->getDifficulty(); ?></td>
                    <td><?php echo $geocache->getTerrain(); ?></td>
                    <td><?php echo $geocache->visittypeCount('found'); ?></td>
                    <td><?php if (isset($geocache->distance)): echo(round($geocache->distance,1) . ' km'); else:?>--<?php endif;?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>