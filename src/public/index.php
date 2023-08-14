<?php
declare(strict_types=1);

require 'vendor/autoload.php';

use models\Database;

echo 'It works !';

$db = new Database();

$result = $db->fetch("Select * FROM Users");

?>

<h1><?=$result ?></h1>
