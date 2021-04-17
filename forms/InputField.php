<?php


namespace app\forms;

use app\models\Model;

class InputField extends BaseField
{
    protected const TYPE_TEXT = 'text';
    protected const TYPE_PASS = 'password';
    protected const TYPE_EMAIL = 'email';
    protected const OPTIONS = "";

    protected string $type;
    public function __construct(Model $model, $attribute, $options = self::OPTIONS)
    {
        parent::__construct($model, $attribute, $options);
        $this->type = self::TYPE_TEXT;
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASS;
        return $this;
    }

    public function emailField()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function render(): string
    {
        return sprintf('<input type="%s" name="%s" placeholder="%s" value="%s" class="form-control %s" id="%s"/>',
            $this->type, // type
            $this->attribute, // name
            ucfirst($this->attribute), // placeholder
            $this->model->{$this->attribute}, // value
            $this->options, // options
            $this->attribute, // id
        );
    }
}