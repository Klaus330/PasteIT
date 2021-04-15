<?php

namespace app\core;

use app\core\Application;

function view($name, $data = [])
{
    extract($data);
    return require "resources/views/{$name}.view.php";
}


function redirect($path)
{
    Application::$app->response->redirect($path);
    exit;
}

function dd($e){
    die(var_dump(e));
}