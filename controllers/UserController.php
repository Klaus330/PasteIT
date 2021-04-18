<?php

namespace app\controllers;

use app\core\Request;
use app\middlewares\AuthMiddleware;

class UserController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function settings()
    {
        return view('/user/settings');
    }

    public function profile()
    {
        $isInputChecked = false;
        if (array_key_exists('theme', $_COOKIE)) {
            $isInputChecked = $_COOKIE['theme'] === 'dark';
        }

        return view('/user/profile', ['isInputChecked' => $isInputChecked]);
    }

    public function myPastes()
    {
        return view('/user/mypastes');
    }

}