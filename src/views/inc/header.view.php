<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.classless.min.css">
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
                    <a href="/">Bonjour <?= $_SESSION['user']['nickname'] ?> </a>
                </li>
            <li>
                <a href="logout">Logout</a>
            </li>
            <?php endif; ?>

        </ul>
    </nav>
</header>
<main>

