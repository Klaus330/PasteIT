<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class UserController extends Controller
{
    public function settings()
    {
        return $this->render('/user/settings');
    }

}