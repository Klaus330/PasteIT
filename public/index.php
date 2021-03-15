<?php

require_once __DIR__."/../core/bootstrap.php";

$app->router->get('/', function(){
    return 'Hello World';
});

$app->router->get('/contact', 'contact');

$app->run();