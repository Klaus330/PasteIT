<?php


namespace app\models;


use app\core\Validator;
use Cassandra\Date;
use DateTime;

class Paste extends DbModel
{

    public string $code = '';
    public string $title = '';
    public string $slug = '';
    public string $id_syntax = '';
    public int $exposure = 0;
    public mixed $id_user = "";
    public string $expiration_date = '';
    public string $burn_after_read = '';
    public string $password = '';
    public $created_at;
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
            "nr_of_views",
            "created_at",
            "id_user"
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
        if ($this->password !== '') {
            $this->password = sha1($this->password);
        }

        $this->created_at = (new DateTime())->format('Y-m-d H:i:s');

        return parent::save();
    }


    public function user()
    {
        return $this->belongsTo('id_user', User::class);
    }

    public function syntax()
    {
        return $this->belongsTo('id_syntax', Syntax::class);
    }


    public function hasPassword()
    {
        return ($this->password !== "");
    }

    public function matchPassword($password)
    {
        return ($this->password === sha1($password));
    }


    public function isBurnAfterRead()
    {
        return $this->burn_after_read ?? false;
    }
}