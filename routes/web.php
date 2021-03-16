<?php
$app->router->get('/', function(){
    return 'Hello World';
});

$app->router->get('/contact', "ContactController@index");

$app->router->get('/login', "AuthController@index");
$app->router->post('/login', "AuthController@login");
$app->router->get('/register', "AuthController@register");