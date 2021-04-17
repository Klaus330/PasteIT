<?php

use app\core\Application;
use app\migrations\Migration;

require_once __DIR__ . "/vendor/autoload.php";
$config = require_once "config.php";

$app = new Application(__DIR__, $config);


if ($argv[1] == "-up") {
    $app->db->applyMigrations();
}else if($argv[1] == "-down"){
    $app->db->downMigrations();
}else{
    echo 'I do not know this command. The available commands are:'.PHP_EOL;
    echo 'php migrations.php -up - Creates all the tables specified in migrations'.PHP_EOL;
    echo 'php migrations.php -down - Deletes all the migrations and tables from the db.';
}