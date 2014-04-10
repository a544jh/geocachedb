<?php if (empty($data->trackablelist)): ?>
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
                    <td>--</td>
                    <td>--</td>
                </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>