<?php


namespace app\models;


class Syntax extends DbModel
{
    public string $name;

    public function tableName(): string
    {
        return 'highlights';
    }

    public function attributes(): array
    {
        return ['name'];
    }

    public static function getPrimaryKey(): string
    {
        return 'id';
    }

    public function rules()
    {
        return [];
    }
}