<?php

use app\core\Application;
require_once __DIR__."/../vendor/autoload.php";
$config = require_once "../config.php";

$app = new Application(dirname(__DIR__), $config);

require_once Application::$ROOT_DIR."/routes/web.php";
