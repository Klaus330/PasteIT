<?php
$app->router->get('/', "HomeController@index");

$app->router->get('/contact', "ContactController@index");

$app->router->get('/login', "AuthController@index");
$app->router->post('/login', "AuthController@login");
$app->router->get('/register', "AuthController@register");
$app->router->post('/register', "AuthController@register");
$app->router->get('/pastes', "PasteController@index");
$app->router->get("/forgot-password","AuthController@forgotPassword");
$app->router->get("/reset-password","AuthController@resetPassword");
$app->router->get("/user/settings","UserController@settings");
$app->router->get("/user/profile","UserController@profile");
$app->router->get("/user/mypastes","UserController@myPastes");
$app->router->get("/pastes/locked-paste","PasteController@lockedPaste");

$app->router->get("/captcha-image", 'CaptchaController@getCaptchaImage');