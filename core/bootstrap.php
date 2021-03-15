<?php

require_once __DIR__."/../vendor/autoload.php";

use App\Core\Application;

$app = new Application(dirname(__DIR__));

require_once Application::$ROOT_DIR."/routes/web.php";
