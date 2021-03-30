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

    public function profile(){
        return $this->render('/user/profile');
    }

    public  function myPastes(){
        return $this->render('/user/mypastes');
    }

}