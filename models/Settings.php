<?php


namespace app\models;


use app\core\Validator;

class Settings extends DbModel
{
    public int $id_user=-1;
    public int $id_syntax=-1;
    public string $expiration="";
    public int $exposure=-1;

    public function tableName(): string
    {
        return "settings";
    }

    public function attributes(): array
    {
        return ["id_user", "id_syntax", "expiration", "exposure"];
    }

    public static function getPrimaryKey(): string
    {
        return "id";
    }

    public function rules()
    {
        return [
//            "id_user"=>[Validator::RULE_REQUIRED],
            "id_syntax"=>[Validator::RULE_REQUIRED],
            "expiration"=>[Validator::RULE_REQUIRED],
            "exposure"=>[Validator::RULE_REQUIRED]
        ];
    }

}