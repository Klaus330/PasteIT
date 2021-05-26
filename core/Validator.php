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
        if ($rulesArray === [] || $data === []) {
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
                            self::addErrorForRule($attribute, self::RULE_REQUIRED);
                        }
                        break;
                    case Validator::RULE_EMAIL:
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            self::addErrorForRule($attribute, self::RULE_EMAIL);
                        }
                        break;
                    case Validator::RULE_MIN:
                        if (strlen($value) < $rule['min']) {
                            self::addErrorForRule($attribute, self::RULE_MIN, $rule);
                        }
                        break;
                    case Validator::RULE_MAX:
                        if (strlen($value) < $rule['max']) {
                            self::addErrorForRule($attribute, self::RULE_MAX, $rule);
                        }
                        break;
                    case Validator::RULE_MATCH:
                        if ($value !== $data[$rule['match']]) {
                            self::addErrorForRule($attribute, self::RULE_MATCH, $rule);
                        }
                        break;
                    case Validator::RULE_UNIQUE:
                        $uniqueAttribute = $rule['attribute'] ?? $attribute;

                       $isUnique = $rule['class']->checkIfUnique($uniqueAttribute, $value);

                        if (!$isUnique) {
                            self::addErrorForRule($attribute, self::RULE_UNIQUE);
                        }
                        break;
                }
            }
        }
        return self::$errors;
    }

    protected static function addErrorForRule($attribute, $rule, $params = [])
    {
        $message = Validator::getErrorMessages()[$rule] ?? '';

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $message = str_replace("{{$key}}", $value, $message);
            }
        }

        self::$errors[$attribute][] = $message;

    }


    public static function addError($attribute, $message)
    {
        self::$errors[$attribute][] = $message;
    }

    public static function getErrorMessages()
    {
        return [
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

    public static function getErrors()
    {
        return self::$errors;
    }
}