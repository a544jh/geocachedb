<?php require_once 'libs/models/geocache.php'; ?>
<h4><?php echo $data->trackablelistHeader ?></h4>
<?php
if (empty($data->trackablelist)):
    ?>
    No trackables found.
<?php else: ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Distance traveled</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->trackablelist as $trackable): ?>
                <tr>
                    <td><a href="trackableview.php?id=<?php echo $trackable->getId(); ?>"><?php echo $trackable->getName(); ?></a></td>
                    <td><?php
                        $location = $trackable->getLocation();
                        if ($location instanceof Geocache):
                            ?>In geocahe <a href="geocacheview.php?id=<?php echo $location->getId() ?>"><?php echo $location->getName() ?></a>
                        <?php elseif ($location instanceof User) : ?>At user <a href="userprofile.php?id=<?php echo $location->getId() ?>"><?php echo $location->getUsername() ?></a><br>
                        <?php endif; ?></td>
                    <td>--</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>