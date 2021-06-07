<?php


namespace app\models;


use app\core\Validator;

class Contact extends DbModel
{
    public string $fromUsername = '';
    public string $fromEmail = '';
    public string $toUsername = '';
    public string $toPaste = '';
    public string $message = '';

    public function tableName(): string
    {
        return 'contact';
    }

    public function attributes(): array
    {
        return ['fromUsername', 'fromEmail','toUsername','toPaste', 'message'];
    }

    public static function getPrimaryKey(): string
    {
        return 'id';
    }

    public function rules()
    {
        return [
            'fromEmail' => [Validator::RULE_REQUIRED, Validator::RULE_EMAIL],
            'fromUsername' => [Validator::RULE_REQUIRED],
            'toUsername' => [Validator::RULE_REQUIRED],
            'toPaste' => [Validator::RULE_REQUIRED],
            'message' => [Validator::RULE_REQUIRED]
        ];
    }

    public function labels()
    {
        return [
            'fromEmail' => 'Your Email',
            'fromUsername' => 'Your Name',
            'toUsername' => 'The owner',
            'toPaste' => 'The paste URL',
            'message' => 'Reason'
        ];
    }

    public function send()
    {
        return parent::save();
    }
}