<h2>List of Hikes</h2>

<?php if (!empty($tags)):?>
    
    <h3>See hikes per tag</h3>

    <form method="POST" id="formTags" action="" >

        <select name="hikesPerTag" id="hikesPerTag">
            <option value="all">
                --- All Tags ---
            </option>
            <?php foreach($tags as $tag):  ?>
                <option value="<?=$tag['name']?>" <?php if($_POST['hikesPerTag'] == $tag['name']){echo("selected");}?>>
                    <?=$tag['name']?>
                </option>
            <?php endforeach?>
        </select>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('hikesPerTag').addEventListener('change', function() {
                document.getElementById('formTags').requestSubmit();
            });
        });
    </script>

    <?php 
        header("Cache-Control: no cache");

        session_cache_limiter("private_no_expire");
    ?>

<?php endif;?>


<?php if (!empty($hikes)): ?>
    <table>
        <tr>
            <?php if ($_SESSION['user']):?>
                <th>Favorite</th>
            <?php endif ?>
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
                <?php if ($_SESSION['user']):?>
                    <td>
                        
                        
                        <?php 
                            $check = false;
                            
                            foreach($favHike as $fav){
                                if($hike['id_Hike'] == $fav['HikeId']){
                                    $check = true;
                                }
                            }
                        ?>

                            
                            <?php if($check):?>
                                <input id='<?=$hike['id_Hike']?>' type='checkbox' onclick="location.href='/?hikeid=<?=$hike['id_Hike']?>'" checked>
                            <?php else :?>
                                <input id='<?=$hike['id_Hike']?>' type='checkbox' onclick="location.href='/?hikeid=<?=$hike['id_Hike']?>'">
                
                            <?php endif ?>

                            
                        
                        
                    </td>
                <?php endif ?>
                <td>
                    <a href="/hike?id=<?= $hike['id_Hike'];?>">
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
                        <?php if ($hike['id_Hike'] == $tagIndex["Hike"]):?>
                            <td><?=$tagIndex['name']?></td>
                        <?php endif ?>
                    <?php endforeach?>

                <?php endif?>             

            </tr>
        <?php endforeach; ?>

    </table>
<?php endif; ?>

