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
                    <td><?php echo $trackable->getLink() ?></td>
                    <td><?php
                        $location = $trackable->getLocation();
                        if ($location instanceof Geocache):
                            ?>In geocache <?php
                            echo $location->getLink();
                        elseif ($location instanceof User) :
                            ?>At user <?php
                            echo $location->getLink();
                        endif;
                        ?></td>
                    <td>--</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>