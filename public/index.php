<?php

use App\Controllers\ContactController;

require_once __DIR__."/../core/bootstrap.php";

$app->router->get('/', function(){
    return 'Hello World';
});

$app->router->get('/contact', "ContactController@index");

$app->run();