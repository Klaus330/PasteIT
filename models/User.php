<?php

namespace app\models;

use app\core\Application;
use app\core\Validator;
use app\models\Model;

class User extends DbModel
{
    public string $username = '';
    public string $email = '';
    public string $confirm_password = '';
    public string $password = '';
    public $avatar = '';


    public function save()
    {
        $this->password = sha1($this->password);

        return parent::save();
    }

    public function rules()
    {
        return [
            'username' => [Validator::RULE_REQUIRED],
            'email' => [Validator::RULE_REQUIRED, Validator::RULE_EMAIL, [Validator::RULE_UNIQUE, 'class' => $this]],
            'password' => [Validator::RULE_REQUIRED, [Validator::RULE_MIN, 'min' => 6]],
            'confirm_password' => [Validator::RULE_REQUIRED, [Validator::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function tableName(): string
    {
        return "users";
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password', 'avatar'];
    }

    public function labels()
    {
        return [
            'username' => "Username",
            'email' => 'Email',
            'password' => 'Password',
            'confirm_password' => 'Confirm Pass'
        ];
    }


    public function login()
    {
        $user = User::findOne(['email' => $this->email]);

        if(!$user){
            Validator::addError('email', 'Please check your credentials and try again');
            return false;
        }

        if(sha1($this->password) != $user->password){
            Validator::addError('password', 'Please check your credentials and try again');
            return false;
        }

       return Application::$app->login($user);

    }

    public static function getPrimaryKey(): string
    {
        return 'id';
    }

    public function settings()
    {
        return $this->hasOne('id_user', Settings::class);
    }

}