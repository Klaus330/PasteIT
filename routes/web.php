<?php


use app\core\routing\Route;
use app\models\User;

Route::get('/', "HomeController@index");

Route::get('/contact', "ContactController@index");
Route::post('/contact', 'ContactController@store');
Route::get("/captcha-image", 'CaptchaController@getCaptchaImage');

// Auth
Route::get('/login', "AuthController@index");
Route::post('/login', "AuthController@login");
Route::get('/register', "AuthController@register");
Route::post('/register', "AuthController@register");
Route::get('/logout', "AuthController@logout");
Route::get("/forgot-password", "AuthController@forgotPassword");
Route::get("/reset-password", "AuthController@resetPassword");

// User
Route::get("/user/settings", "UserController@settings");
Route::get("/user/profile", "UserController@profile");
Route::post("/user/profile","UserController@profileUpdate");
Route::get("/user/mypastes", "UserController@myPastes");
Route::post("/user/settings", "UserController@storeSettings");
Route::get("/user/delete", "UserController@destroy");


// Pastes
//Route::get('/pastes', "PasteController@view");
Route::get('/pastes', "PasteController@index");
Route::post('/pastes', "PasteController@store");
Route::get("/pastes/locked-paste/:slug", "PasteController@lockedPaste");
Route::post("/pastes/unlock-paste", "PasteController@unlockPaste");
Route::get("/pastes/burn-after-read/:slug","PasteController@burnAfterRead");
Route::post("/pastes/burn","PasteController@validateBurnAfterRead");

Route::get('/paste/view/:slug', "PasteController@show");
Route::get('/pastes/edit/:slug', "PasteController@edit");

Route::post('/paste/delete/:slug', "PasteController@delete");