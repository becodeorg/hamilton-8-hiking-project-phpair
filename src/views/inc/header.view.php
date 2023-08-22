<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.classless.min.css">
    <script src="https://kit.fontawesome.com/81858c777b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>

    <nav>
        <ul>
            <li>
                <a href="/">Hikes</a>
            </li>
            <?php  if (empty($_SESSION)): ?>
                <li>
                    <a href="register">Register</a>
                </li>
                <li>
                    <a href="login">Login</a>
                </li>
            <?php else: ?>
                <li>
                    <a href="./profile">Bonjour <?= $_SESSION['user']['nickname'] ?> </a>
                </li>
                <li>
                    <a href="editHike">Create a new Hike</a>
                </li>
            <li>
                <a href="logout">Logout</a>
            </li>
            <?php endif; ?>

        </ul>
    </nav>
</header>
<main>

