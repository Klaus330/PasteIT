<?php

use app\core\Application;
require_once dirname(__DIR__)."/vendor/autoload.php";
$config = require_once "../config.php";
require_once 'helpers.php';

$app = new Application(dirname(__DIR__), $config);

require_once Application::$ROOT_DIR."/routes/web.php";
