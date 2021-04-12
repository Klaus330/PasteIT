<?php


namespace app\forms;


class Button
{
    protected $text;
    protected $divClasses;
    protected $buttonClasses;

    /**
     * Button constructor.
     * @param $text
     * @param $divClasses
     * @param $buttonClasses
     */
    public function __construct($text, $divClasses = "", $buttonClasses = "")
    {
        $this->text = $text;
        $this->divClasses = $divClasses;
        $this->buttonClasses = $buttonClasses;
    }

    public function __toString()
    {
        return sprintf(
            '  <div class="%s">
                        <button type="submit" class="%s">
                            %s
                        </button>
                    </div>',
        $this->divClasses, $this->buttonClasses, $this->text);
    }
}