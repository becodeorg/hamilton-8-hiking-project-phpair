<h2>List of Hikes</h2>

<?php if (!empty($hikes)): ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Distance</th>
            <th>Duration</th>
            <th>Elevation gain</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>

        <?php foreach($hikes as $hike): ?>
            <tr>
                <td>
                    <a href="/hike?id=<?= $hike['id'] ?>">
                        <?= $hike['name'] ?>
                    </a>
                </td>
                    
                <td><?= $hike['distance'] ?></td>
                <td><?= $hike['duration'] ?></td>
                <td><?= $hike['elevation_gain'] ?></td>
                <td><?= $hike['created_at'] ?></td>
                <td><?= $hike['updated_at'] ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
<?php endif; ?>

