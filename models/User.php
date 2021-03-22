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

    public function rules()
    {
        return [
            'username' => [Validator::RULE_REQUIRED],
            'password' => [Validator::RULE_REQUIRED, [Validator::RULE_MIN, 'min' => 6]]
        ];
    }
}