<?php


namespace app\models;


use app\core\Validator;

class Contact extends DbModel
{
    public string $name = '';
    public string $email = '';
    public string $message = '';

    public function tableName(): string
    {
        return 'contact';
    }

    public function attributes(): array
    {
        return ['name', 'email', 'message'];
    }

    public static function getPrimaryKey(): string
    {
        return 'id';
    }

    public function rules()
    {
        return [
            'email' => [Validator::RULE_REQUIRED, Validator::RULE_EMAIL],
            'name' => [Validator::RULE_REQUIRED],
            'message' => [Validator::RULE_REQUIRED]
        ];
    }

    public function labels()
    {
        return [
            'email' => 'Your Email',
            'name' => 'Your Name',
            'message' => 'Message'
        ];
    }

    public function send()
    {
        return true;
    }
}