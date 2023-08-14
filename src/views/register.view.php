<h1>Register</h1>

<h2 style="color:<?= $_GET['color'] ?> "> <?= $_GET['m'] ?> </h2>
<form action="#" method="post">

    <div>
        <label for="firstname">firstname</label>
        <input type="text" id="firstname" name="firstname" required/>
    </div>
    <div>
        <label for="lastname">lastname</label>
        <input type="text" id="lastname" name="lastname" required/>
    </div>
    <div>
        <label for="nickname">nickname</label>
        <input type="text" id="nickname" name="nickname" required/>
    </div>
    <div>
        <label for="email">email</label>
        <input type="email" id="email" name="email" required/>
    </div>
    <div>
        <label for="password">password</label>
        <input type="password" id="password" name="password" required/>
    </div>
    <button type="submit">Register</button>
</form>