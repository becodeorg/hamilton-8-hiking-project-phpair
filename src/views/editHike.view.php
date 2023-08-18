<h1>crud page</h1>

<h2 style="color:<?= $_GET['color'] ?> "> <?= $_GET['m'] ?> </h2>

<form action="/profile" method="post">

    <div>
        <label for="hikeName">Name</label>
        <input type="text" id="hikeName" name="hikeName" value="<?= htmlspecialchars($hike['name']) ?>" required/>
    </div>
    <div>
        <label for="distance">Distance</label>
        <input type="text" id="distance" name="distance" value= "<?=htmlspecialchars($hike['distance'])?>" required/>
    </div>
    <div>
        <label for="duration">duration</label>
        <input type="text" id="duration" name="duration" value= "<?=htmlspecialchars($hike['duration'])?>" required/>
    </div>
    <div>
        <label for="elevation_gain">Elevation Gain</label>
        <input type="text" id="elevation_gain" name="elevation_gain" value= "<?=htmlspecialchars($hike['elevation_gain'])?>"required/>
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description" value= "<?=htmlspecialchars($hike['description'])?>"required/>
    </div>
    <button type="submit" name="action" value="Update">Save Changes</button>
    <button style="background-color: red" type="submit" name="action" value="Delete" >Delete</button>
</form>