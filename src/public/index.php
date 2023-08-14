<?php
declare(strict_types=1);

require 'vendor/autoload.php';

use models\Database;

echo 'It works !';

$db = new Database();

$result = $db->fetchAll("Select * FROM Users");

?>

<h1><?=$result[0] ?></h1>
