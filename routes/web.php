<?php


use app\models\User;

router()->get('/', "HomeController@index");

router()->get('/contact', "ContactController@index");
router()->post('/contact', 'ContactController@store');
router()->get("/captcha-image", 'CaptchaController@getCaptchaImage');

// Auth
router()->get('/login', "AuthController@index");
router()->post('/login', "AuthController@login");
router()->get('/register', "AuthController@register");
router()->post('/register', "AuthController@register");
router()->get('/logout', "AuthController@logout");
router()->get("/forgot-password", "AuthController@forgotPassword");
router()->get("/reset-password", "AuthController@resetPassword");

// User
router()->get("/user/settings", "UserController@settings");
router()->get("/user/profile", "UserController@profile");
router()->get("/user/mypastes", "UserController@myPastes");
router()->post("/user/settings", "UserController@storeSettings");
router()->get("/user/delete", "UserController@destroy");


// Pastes
router()->get('/pastes', "PasteController@view");
//router()->get('/pastes', "PasteController@index");
router()->post('/pastes', "PasteController@store");
router()->get("/pastes/locked-paste", "PasteController@lockedPaste");
router()->get("/pastes/edit", "PasteController@edit");

