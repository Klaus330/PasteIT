<?php


namespace app\models;


use app\core\DateFormatter;
use app\core\Validator;
use Cassandra\Date;
use DateTime;

class Paste extends DbModel
{

    public string $code = '';
    public string $title = '';
    public string $slug = '';
    public string $id_syntax = '';
    public $exposure = "";
    public $id_user = 1;
    public $expiration_date = "0000-00-00 00:00:00";
    public string $burn_after_read = '';
    public string $password = '';
    public $created_at;
    public $expired = '';
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
            "id_user",
             "expired"
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
        if ($this->expiration_date != "never") {
            $temp = new \DateTimeImmutable();
            $this->expiration_date = $temp->modify("+$this->expiration_date")->format('Y-m-d H:i:s');
        }



        parent::save();

        $currentPasteId = Paste::findOne(['slug'=>$this->slug])->id;


        $this->saveRelationship([
            'id_paste' => $currentPasteId,
            'id_user' => $this->id_user
        ],"pastes_users");
    }


    public function user()
    {
        return $this->belongsTo('id_user', User::class);
    }

    public function editors()
    {
        return $this->hasMany(User::class, "pastes_users");
    }


    public function versions($orderBy)
    {
        return $this->belongsToMany(Version::class, $orderBy);
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


    public function timeSinceCreation()
    {
        $now = new \DateTimeImmutable();
        $createdAt = new \DateTimeImmutable($this->created_at);
        $dateString = new DateFormatter($now->diff($createdAt));

        return $dateString->displayHumanFormat()." ago";
    }


    public function expirationTime()
    {
        if ($this->expires()) {
            $start = new \DateTimeImmutable();
            $end = new \DateTimeImmutable($this->expiration_date);

            $dateString = new DateFormatter($end->diff($start));
            return $dateString->displayHumanFormat();
        }
        return "never";
    }

    private function expires(){
        return ($this->expiration_date !== "0000-00-00 00:00:00");
    }

    public function expired()
    {
        if($this->expires()){
            $start = new \DateTimeImmutable();
            $end = new \DateTimeImmutable($this->expiration_date);
            return ($end->diff($start)->invert === 0 || $this->expired);
        }else{
            return false;
        }
    }

    public function isPrivate()
    {
       return ($this->exposure == 1);
    }

    public function isOwner(int $userId)
    {
        return ($this->id_user == $userId);
    }


    public function addEditor($editorId)
    {
        $this->saveRelationship([
            'id_user' => $editorId,
            'id_paste' => $this->id
        ], 'pastes_users');
    }


    public function canEdit($userId)
    {
        $editors = $this->editors();

        foreach ($editors as $editor){
            if($editor->id === $userId){
                return true;
            }
        }
        return false;
    }


}