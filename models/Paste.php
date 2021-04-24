<?php


namespace app\models;


use app\core\Validator;

class Paste extends DbModel
{

    public string $code = '';
    public string $title = '';
    public string $slug = '';
    public string $id_syntax = '';
    public int $exposure = 0;
    public string $id_user = '';
    public string $expiration_date = '';
    public string $burn_after_read = '';
    public string $password = '';
    public int $nr_of_views = 0;


    public function tableName(): string
    {
        return "pastes";
    }

    public function attributes(): array
    {
        return [
            "code",
            "title",
            "slug",
            "password",
            'id_syntax',
            "burn_after_read",
            "exposure",
            "expiration_date",
            "nr_of_views"
        ];
    }

    public static function getPrimaryKey(): string
    {
        return 'id';
    }

    public function rules()
    {
        return [
            "code" => [Validator::RULE_REQUIRED],
            "title" => [Validator::RULE_REQUIRED]
        ];
    }


    public function save()
    {
        if ($this->password !== ''){
            $this->password = sha1($this->password);
        }
        return parent::save();
    }
}