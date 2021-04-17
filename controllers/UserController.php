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
        return $this->render('/user/settings');
    }

    public function profile()
    {
        $isInputChecked = false;
        if (array_key_exists('theme', $_COOKIE)) {
            $isInputChecked = $_COOKIE['theme'] === 'dark';
        }

        return $this->render('/user/profile', ['isInputChecked' => $isInputChecked]);
    }

    public function myPastes()
    {
        return $this->render('/user/mypastes');
    }

}