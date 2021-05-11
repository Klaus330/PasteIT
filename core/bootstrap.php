<?php

use app\core\Application;

require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once 'helpers.php';
$app = Application::getInstance();

$app->bind('config', function () {
    return new \app\core\Config;
});
$app->bind('request', function () {
    return new \app\core\routing\Request;
});
$app->bind('response', function () {
    return new \app\core\routing\Response;
});
$app->bind('router', \app\core\routing\Router::class);
$app->bind('view', function () {
    return new \app\core\View;
});
$app->instance('session', \app\core\Session::getInstance());
$app->bind('controller', function () {
    return new \app\controllers\Controller;
});
$app->instance('db', \app\core\database\Database::getConnection());

if (session()->has('user')) {
    $app->bind('user', function () {
        return \app\models\User::findOne([
            'id' => session()->get('user')
        ]);
    });
} else {
    $app->bind('user', null);
}


require_once dirname(__DIR__) . "/routes/web.php";


