<?php

namespace app\models;

use app\core\Model;
use app\core\Validator;

class User extends Model
{
    public string $username;
    public string $password;


    public function register()
    {
        echo "register";
    }

}