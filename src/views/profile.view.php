

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
