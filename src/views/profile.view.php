
<h2>My Hikes</h2><button>Create a new Hike</button>
<table>
    <tr>
        <th>Name</th>
        <th>Distance</th>
        <th>Duration</th>
        <th>Elevation gain</th>
        <th>Edit</th>
        
    </tr>

    <?php foreach($hikesCreated as $hike):  ?>
        <tr>
            <td>
                <a href="/hike?id=<?= $hike['hikeID'] ?>">
                    <?= $hike['name'] ?>
                </a>
            </td>
            <td><?= $hike['distance'] ?></td>
            <td><?= $hike['duration'] ?></td>
            <td><?= $hike['elevation_gain'] ?></td>

            <td><a href="/editHike?id=<?=$hike['hikeID']?>">Edit</a></td>
            

            <?php if (!empty($tagsIndex)):?>
                <?php foreach($tagsIndex as $tagIndex):?>
                    <?php if ($hike['hikeID']== $tagIndex["Hike"]):?>
                        <td><?=$tagIndex['name']?></td>
                    <?php endif ?>
                <?php endforeach?>
            <?php endif?>

        </tr>


    <?php endforeach?>
</table>

<?php if($_SESSION['user']['isAdmin']): ?>

<h2>Users</h2>
<table>
    <tr>
        <th></th>
        <th>firstname</th>
        <th>lastname</th>
        <th>nickname</th>
        <th>email</th>
    </tr>
    <?php foreach($users as $user):  ?>

        <tr>
            <td><a href="/profile?supUser=<?= $user['id'] ?>"><i class="fa-regular fa-trash-can" style="color: #ff0000;"></i></a></td>
            <td><?= $user['firstname'] ?></td>
            <td><?= $user['lastname'] ?></td>
            <td><?= $user['nickname'] ?></td>
            <td><?= $user['email'] ?></td>

        </tr>

    <?php endforeach; ?>
</table>

    <h2>Tags</h2>
    <table>
        <tr>
            <th></th>
            <th>name</th>
        </tr>
        <?php foreach($tags as $tag):  ?>

            <tr>
                <td><a href="/profile?supTag=<?= $tag['id'] ?>"><i class="fa-regular fa-trash-can" style="color: #ff0000;"></i></a></td>
                <td><?= $tag['name'] ?></td>

            </tr>

        <?php endforeach; ?>
    </table>




<?php endif; ?>

<?php if(!$_SESSION['user']['isAdmin']): ?>
<h2>Favori</h2>
<table>
    <tr>

        <th>Name</th>
        <th>Distance</th>
        <th>Duration</th>
        <th>Elevation gain</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Creator</th>
        <th>Tags</th>
    </tr>

    <?php foreach($favHikes as $hikeFav):  ?>
        <tr>
            <td>
                <a href="/hike?id=<?= $hikeFav['HikeId'] ?>">
                    <?= $hikeFav['name'] ?>
                </a>
            </td>
            <td><?= $hikeFav['distance'] ?></td>
            <td><?= $hikeFav['duration'] ?></td>
            <td><?= $hikeFav['elevation_gain'] ?></td>
            <td><?= $hikeFav['created_at'] ?></td>
            <td><?= $hikeFav['updated_at'] ?></td>
            <td><?= $hikeFav['nickname'] ?></td>

            <?php if (!empty($tagsIndex)):?>
                <?php foreach($tagsIndex as $tagIndex):?>
                    <?php if ($hikeFav['HikeId']== $tagIndex["Hike"]):?>
                        <td><?=$tagIndex['name']?></td>
                    <?php endif ?>
                <?php endforeach?>
            <?php endif?>

        </tr>


    <?php endforeach?>
</table>
<?php endif; ?>

<h2>Profile</h2>
<form action="/profile" method="post">
    <label for="firstname">firstname</label>
    <input id="firstname" name="firstname" type="text" value="<?=$_SESSION['user']['firstname'] ?>" required>
    <label for="lastname">lastname</label>
    <input id="lastname" name="lastname" type="text" value="<?=$_SESSION['user']['lastname'] ?>" required>
    <label for="nickname">nickname</label>
    <input id="nickname" name="nickname" type="text" value="<?=$_SESSION['user']['nickname'] ?>" required>
    <label for="email">email</label>
    <input id="email" name="email" type="email" value="<?=$_SESSION['user']['email'] ?>" required>
    <label for="password">password</label>
    <input id="password" name="password" type="password" value="" placeholder="**********" >
    <button type="submit" name="action" value="Update" >Modify</button><button style="background-color: red" type="submit" name="action" value="Delete" >Delete</button>
</form>


