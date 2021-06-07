<?php


namespace app\forms;


class Textarea extends BaseField
{

    public function render(): string
    {
        return sprintf(  '<textarea name="%s" placeholder="%s" class="form-control %s" id="%s"></textarea>',
            $this->attribute, // name
            ucfirst($this->attribute), // placeholder
            $this->options, // options
            $this->attribute // id
        );
    }
}