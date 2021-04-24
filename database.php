<?php

use app\core\Application;
use app\migrations\Migration;

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/core/helpers.php";


$app = Application::getInstance();
$app->bind('config', function () {
    return new \app\core\Config;
});
$app->instance('db', \app\core\database\Database::getConnection());

if(isset($argv[1])){
    echo 'The available commands are:' . PHP_EOL;
    echo 'php database.php -migrate - Creates all the tables specified in migrations' . PHP_EOL;
    echo 'php database.php -down - Deletes all the migrations and tables from the db.' . PHP_EOL;
    echo 'php database.php -refresh - setup a new db migration with seeds.' . PHP_EOL;
    echo 'php database.php -seed - Apply seeds.' . PHP_EOL;
    echo 'php database.php -reset - Resets the migrations.';
    exit;
}

if ($argv[1] == "-migrate") {
    app('db')->applyMigrations();
} else if ($argv[1] == "-down") {
    app('db')->downMigrations();
} else if ($argv[1] == '-reset') {
    app('db')->downMigrations();
    app('db')->applyMigrations();
} else if ($argv[1] == "-seed") {
    app('db')->applySeeds();
}else if($argv[1] == '-refresh'){
    app('db')->downMigrations();
    app('db')->applyMigrations();
    app('db')->applySeeds();
} else {
    echo 'I do not know this command. The available commands are:' . PHP_EOL;
    echo 'php database.php -migrate - Creates all the tables specified in migrations' . PHP_EOL;
    echo 'php database.php -down - Deletes all the migrations and tables from the db.' . PHP_EOL;
    echo 'php database.php -refresh - setup a new db migration with seeds.' . PHP_EOL;
    echo 'php database.php -seed - Apply seeds.' . PHP_EOL;
    echo 'php database.php -reset - Resets the migrations.';
}