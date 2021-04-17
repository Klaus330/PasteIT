<?php


namespace app\forms;


use app\core\Validator;

abstract class BaseField
{
    abstract public function render(): string;

    protected $model;
    protected $attribute;
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
        $this->options = $options;
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
                    %s
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
            $this->render(),
            Validator::getError($this->attribute) // error message
        );
    }
}