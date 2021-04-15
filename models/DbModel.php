<?php


namespace app\models;


use app\core\Application;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public static function getPrimaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $parameters = $this->parameterizeValues($attributes);

        $sql = sprintf("insert into %s(%s) values(%s)",
            $tableName,
            implode(', ', $attributes),
            implode(',', $parameters)
        );

        $statement = self::prepare($sql);

        try {
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $result = $statement->execute();

            return $result;
        } catch (\PDOException $e) {
//            die("Whoops! Something Went wrong.");
            die($e->getTrace());
        }
    }


    public static function prepare($sql)
    {
        return Application::$app->db->getPdo()->prepare($sql);
    }

    private function parameterizeValues($array)
    {
        return array_map(function ($param) {
            return ":{$param}";
        }, $array);
    }


    public static function findOne($where)
    {
        $tableName = (new static)->tableName();
        $attributes = array_keys($where);

        $parameters = implode(
            "AND",
            array_map(fn($attribute) => "$attribute  = :$attribute", $attributes)
        );
        $sql = "SELECT * FROM $tableName WHERE $parameters";

        $statement = self::prepare($sql);

        foreach ($where as $key => $value){
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

}