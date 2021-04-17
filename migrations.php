<?php
use app\core\Application;
use app\migrations\Migration;
require_once __DIR__."/vendor/autoload.php";
$config = require_once "config.php";

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();