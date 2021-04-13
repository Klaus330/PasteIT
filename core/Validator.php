<?php


namespace app\core;

class Validator
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_UNIQUE = 'unique';
    public const RULE_MATCH = 'match';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'min';

    protected static $errors = [];



    public static function validate($data, $rulesArray)
    {
        if($rulesArray === [] || $data === [])
        {
            var_dump($rulesArray);
            throw new \InvalidArgumentException('No Rules Provided.');
        }

        foreach ($rulesArray as $attribute => $rules) {
            $value = $data[$attribute] ?? null;
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (is_array($ruleName)) {
                    $ruleName = $rule[0];
                }

                switch ($ruleName) {
                    case Validator::RULE_REQUIRED:
                        if (empty($value)) {
                            self::addError($attribute, self::RULE_REQUIRED);
                        }
                        break;
                    case Validator::RULE_EMAIL:
                        if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                            self::addError($attribute, self::RULE_EMAIL);
                        }
                        break;
                    case Validator::RULE_MIN:
                        if(strlen($value) < $rule['min']){
                            self::addError($attribute, self::RULE_MIN, $rule);
                        }
                        break;
                    case Validator::RULE_MAX:
                        if(strlen($value) < $rule['max']){
                            self::addError($attribute, self::RULE_MAX, $rule);
                        }
                        break;
                    case Validator::RULE_MATCH:
                            if($value !== $data[$rule['match']]){
                                self::addError($attribute, self::RULE_MATCH, $rule);
                            }
                        break;
                    case Validator::RULE_UNIQUE:
                        $tableName = $rule['class']->tableName();
                        $className = $rule['class']::class;
                        $uniqueAttribute = $rule['attribute'] ?? $attribute;


                        $sql="SELECT * FROM $tableName WHERE $uniqueAttribute=:$uniqueAttribute";

                        $statement = Application::$app->prepare($sql);
                        $statement->bindValue(":$uniqueAttribute", $value);
                        $statement->execute();
                        $record = $statement->fetchObject();

                        if($record) {
                            self::addError($attribute, self::RULE_UNIQUE);
                        }
                        break;
                }
            }
        }
        return self::$errors;
    }

    protected static function addError($attribute, $rule, $params = []){
        $message =  Validator::getErrorMessages()[$rule] ?? '';

        if(!empty($params)){
            foreach ($params as $key => $value){
                $message = str_replace("{{$key}}", $value, $message);
            }
        }

        self::$errors[$attribute][] = $message;

    }

    public static function getErrorMessages(){
        return[
            Validator::RULE_REQUIRED => "This field is required",
            Validator::RULE_EMAIL => "This field must be a valid email adress",
            Validator::RULE_MAX => "Max length of this field must be {max}",
            Validator::RULE_MIN => "Min length of this field must be {min}",
            Validator::RULE_MATCH => "This field must be the same as {match}",
            Validator::RULE_UNIQUE => "The value of this field must be unique"
        ];
    }

    public static function hasError($attribute)
    {
        return self::$errors[$attribute] ?? false;
    }

    public static function getError($attribute)
    {
        return self::$errors[$attribute][0] ?? '';
    }

}