<?php


use app\core\routing\Route;
use app\models\User;

Route::get('/', "HomeController@index");

Route::get('/contact', "ContactController@index");
Route::post('/contact', 'ContactController@store');

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
Route::get('/pastes', "PasteController@index");
Route::post('/pastes', "PasteController@store");
Route::post("/pastes/unlock-paste", "PasteController@unlockPaste");
Route::post("/pastes/burn","PasteController@validateBurnAfterRead");



Route::regex("/\/pastes\/locked-paste\/[a-zA-Z0-9]+/","PasteController@lockedPaste","get");
Route::regex("/\/pastes\/burn-after-read\/[a-zA-Z0-9]+/","PasteController@burnAfterRead","get");
Route::regex("/pastes\/update\/[a-zA-Z0-9]+/","PasteController@update","post");
Route::regex("/\/pastes\/edit\/[a-zA-Z0-9]+/","PasteController@edit","get");
Route::regex("/\/paste\/view\/[a-zA-Z0-9]+/","PasteController@show","get");
Route::regex("/paste\/delete\/[a-zA-Z0-9]+/","PasteController@delete","post");
Route::regex("/paste\/add-editor\/[0-9]+/","PasteController@addEditor","post");
Route::regex("/pastes\/update-views\/[a-zA-Z0-9]+/","PasteController@updateViews","post");
Route::regex("/paste\/raw\/[a-zA-Z0-9]+/","PasteController@getRawData","get");


// Versions
Route::regex("/paste\/versions\/[a-zA-Z0-9]+/","VersionsController@index","get");
Route::regex("/paste\/version\/[a-zA-Z0-9]+/","VersionsController@version","get");
Route::regex("/versions\/delete\/[a-zA-Z0-9]+/","VersionsController@destroy","post");
Route::regex("/versions\/promote\/[a-zA-Z0-9]+/","VersionsController@promote","post");
Route::regex("/paste\/add-version\/[a-zA-Z0-9]+/","VersionsController@addVersion","get");
Route::regex("/paste\/add-version\/[a-zA-Z0-9]+/","VersionsController@store","post");