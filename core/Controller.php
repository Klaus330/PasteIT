<?php


namespace App\Core;


class Controller
{
    protected string $layout = 'main';

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layoutName)
    {
        $this->layout = $layoutName;
    }

    /**
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }
}