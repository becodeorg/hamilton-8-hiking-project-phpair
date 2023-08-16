<h1>Login</h1>
<h2 style="color:<?= $_GET['color'] ?> "> <?= $_GET['m'] ?> </h2>
<h2>Salut <?= $_SESSION['user']['nickname'] ?> !</h2>
<form action="#" method="post">
    <div>
        <label for="nickname">nickname</label>
        <input type="text" id="nickname" name="nickname" required/>
    </div>
    <div>
        <label for="password">password</label>
        <input type="password" id="password" name="password" required/>
    </div>
    <button type="submit">Login</button>
</form>