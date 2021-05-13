<?php


namespace app\forms;


class Form
{

    public static function begin($action, $method, $classes = "")
    {
        echo sprintf("<form action='%s' method='%s' enctype='multipart/form-data' class='%s'>", $action, $method, $classes);
        return new Form();
    }


    public static function end()
    {
        echo '</form>';
    }

    public function inputField($model, $attribute, $options = "")
    {
        return new InputField($model, $attribute, $options);
    }


    public function textarea($model, $attribute, $options = "")
    {
        return new Textarea($model, $attribute, $options);
    }

    public function submitButton($text, $divClasses, $buttonClasses)
    {
        return new Button($text, $divClasses, $buttonClasses);
    }

}