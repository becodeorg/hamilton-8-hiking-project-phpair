<h1></h1>

<h2 style="color:red"> <?= $_GET['m'] ?> </h2>

<form action="" method="post">
    <div>
        <label for="hikeName">Name</label>
        <input type="text" id="hikeName" name="hikeName" value="<?= !empty($hike)? htmlspecialchars($hike['name']): ' '?>" required/>
    </div>
    <div>
        <label for="distance">Distance</label>
        <input type="text" id="distance" name="distance" value= "<?= !empty($hike)?htmlspecialchars($hike['distance']): ''?>" required/>
    </div>
    <div>
        <label for="duration">duration</label>
        <input type="text" id="duration" name="duration" value= "<?= !empty($hike)?htmlspecialchars($hike['duration']):''?>" required/>
    </div>
    <div>
        <label for="elevation_gain">Elevation Gain</label>
        <input type="text" id="elevation_gain" name="elevation_gain" value= "<?=htmlspecialchars($hike['elevation_gain'])?>"required/>
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description" value= "<?=htmlspecialchars($hike['description'])?>"required/>
    </div>

    <div>
        <label for="tags">Tags</label>
        <?php if( !empty($hike)):?>
            
            <?php foreach($tagsFromHike as $tagFromHike):  ?>
                
                <input type="text" id="inputId" list="tagList" name="tagInput[]" value= "<?=$tagFromHike['name']?>"/>
            <?php endforeach?>
        <?php endif ?>
    </div>
    
    
    <!-- tags -->
    

    

    <label >Add a tag</label>
    <div id="containerTag"><input id="inputId" list="tagList" name="tagInput[]" /></div>

    <datalist id="tagList">
        <?php foreach($tags as $tag):  ?>
            <option value="<?=$tag['name']?>">
            </option>
        <?php endforeach?>
    </datalist>
    <button id="addTag" type="button" name="action" value="Addtag">Add tag</button>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('addTag').addEventListener('click', function(){
           let input =document.getElementById('inputId').cloneNode();
           input.value= "";
           let insert = document.getElementById('containerTag').appendChild(input);
        });
    });
    
</script>

    <?php if(!empty($hike)) : ?>
    <button type="submit" name="action" value="Update">Save Changes</button>

    <button style="background-color: red" type="submit" name="action" value="Delete" >Delete</button>
    <?php else :?>
        <button type="submit" name="action" value="Create">Add new hike</button>
    <?php endif ?>
    <?php 
    header("Cache-Control: no cache");

    session_cache_limiter("private_no_expire"); ?>
</form>