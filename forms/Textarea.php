<?php


namespace app\forms;


class Textarea extends BaseField
{

    public function render(): string
    {
        return sprintf(  '<textarea name="%s" placeholder="%s" value="%s" class="form-control %s" id="%s"></textarea>',
            $this->attribute, // name
            ucfirst($this->attribute), // placeholder
            $this->model->{$this->attribute}, // value
            $this->options, // options
            $this->attribute, // id
        );
    }
}