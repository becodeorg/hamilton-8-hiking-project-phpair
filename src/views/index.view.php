<h2>List of Hikes</h2>

<?php if (!empty($tags)):?>
    
    <h3>See hikes per tag</h3>

    <form method="POST" action="" >

        <select name="hikesPerTag" id="hikesPerTag">
            <?php foreach($tags as $tag):  ?>
                <option value="<?=$tag['id']?>" <?php if($_POST['hikesPerTag'] == $tag['id']){echo("selected");}?>>
                    <?=$tag['name']?>
                </option>
            <?php endforeach?>
        </select>
        <input type="submit" name="submit">

    </form>
    <?php 
        header("Cache-Control: no cache");

        session_cache_limiter("private_no_expire");
    ?>

<?php endif;?>


<?php if (!empty($hikes)): ?>
    <table>
        <tr>
            <th>Favorite</th>
            <th>Name</th>
            <th>Distance</th>
            <th>Duration</th>
            <th>Elevation gain</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Creator</th>
            <th>Tags</th>


        </tr>

        <?php foreach($hikes as $hike): ?>
            <tr>
                <td>
                    <label><input type="checkbox"><span class="label"></span></label>
                    <!-- <form action="" method="post"> </form>   -->
                </td>
                <td>
                    <a href="/hike?id=<?php if(isset($_POST['hikesPerTag'])){echo $hike['id_Hike'];} else {echo $hike['id'];}?>">
                        <?= $hike['name'] ?>
                    </a>
                </td>
                <td><?= $hike['distance'] ?></td>
                <td><?= $hike['duration'] ?></td>
                <td><?= $hike['elevation_gain'] ?></td>
                <td><?= $hike['created_at'] ?></td>
                <td><?= $hike['updated_at'] ?></td>
                <td><?= $hike['nickname'] ?></td>  

                <?php if (!empty($tagsIndex)):?>
                        <?php foreach($tagsIndex as $tagIndex):?>
                            <?php if ($hike['id']== $tagIndex["Hike"]):?>
                                <td><?=$tagIndex['name']?></td>
                            <?php endif ?>
                        <?php endforeach?>
                <?php endif?>             

            </tr>
        <?php endforeach; ?>

    </table>
<?php endif; ?>

