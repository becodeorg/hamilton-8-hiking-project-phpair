<h2><?=$hike['name']?> </h2>
<table>
    <tr>
        <td><?= $hike['distance'] ?></td>
        <td><?= $hike['duration'] ?></td>
        <td><?= $hike['elevation_gain'] ?></td>
        <td><?= $hike['created_at'] ?></td>
        <td><?= $hike['updated_at'] ?></td>
    </tr>
</table>
<p><?= $hike['description'] ?></p>
