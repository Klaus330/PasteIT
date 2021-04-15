<?php


namespace app\forms;


use app\core\Model;
use app\core\Validator;

class Field
{
    protected const TYPE_TEXT = 'text';
    protected const TYPE_PASS = 'password';
    protected const TYPE_EMAIL = 'email';
    protected const OPTIONS = "";


    protected $model;
    protected $attribute;
    protected $type;
    protected $options;

    /**
     * Field constructor.
     * @param $model
     * @param $attribute
     * @param $type
     * @param $options
     */
    public function __construct($model, $attribute, $options = self::OPTIONS)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;
        $this->options = $options == "" ?
            Validator::hasError($this->attribute) ? ' is-invalid' : ''
            : ($options . Validator::hasError($this->attribute) ? ' is-invalid' : '')
        ;
    }

    public function __toString()
    {
        return sprintf(
            ' <div class="grid">
                <div class="col-md-3 col-3">
                    <label for="%s" class="form-label">
                        %s:
                    </label>
                </div>
                <div class="col-md-9 col-12">
                <div class="col-md-9 col-12 flex align-center">
                    <input type="%s" name="%s" placeholder="%s" value="%s" class="form-control %s" id="%s"/>
                </div>
                <div class="col-12 flex align-start">
                    <span class="text-danger"">
                        %s
                    </span>
                </div>
                </div>
            </div>',
        $this->attribute, //for
        $this->model->labels()[$this->attribute] ?? ucfirst($this->attribute), // label text
        $this->type, // type
        $this->attribute, // name
        ucfirst($this->attribute), // placeholder
        $this->model->{$this->attribute}, // value
        $this->options, // options
        $this->attribute, // id
        Validator::getError($this->attribute) // error message
        );
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
}