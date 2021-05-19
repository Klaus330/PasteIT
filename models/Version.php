<?php


namespace app\models;


use app\core\Validator;
use DateTime;

class Version extends DbModel
{

    public $id_paste = '';
    public $id_user = '';
    public $code = '';
    public $slug = '';
    public $created_at = '';
    public $updated_at = '';

    public function tableName(): string
    {
        return "code_versions";
    }

    public function attributes(): array
    {
        return [
            'id_paste',
            'id_user',
            'code',
            "slug",
            "created_at",
            "updated_at"
        ];
    }

    public static function getPrimaryKey(): string
    {
        return 'id';
    }

    public function rules()
    {
        return [
            'code' => [Validator::RULE_REQUIRED],
            'id_paste' => [Validator::RULE_REQUIRED],
            'id_user' => [Validator::RULE_REQUIRED],
            'slug' => [Validator::RULE_REQUIRED]
        ];
    }


    public function save()
    {
        $this->created_at = (new DateTime())->format('Y-m-d H:i:s');
        $this->updated_at = (new DateTime())->format('Y-m-d H:i:s');
        parent::save();
    }


    public function origin()
    {
        return $this->belongsTo('id_paste', Paste::class);
    }

    public function editor()
    {
        return $this->belongsTo('id_user', User::class);
    }


}