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

<?php if (!empty($tagsIndex)):?>
    <?php foreach($tagsIndex as $tagIndex):?>
        <?php if ($hike['id']== $tagIndex["Hike"]):?>
            <td><?=$tagIndex['name']?></td>
        <?php endif ?>
    <?php endforeach?>
<?php endif?>
