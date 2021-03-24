<?php


namespace app\core;


class Controller
{
    protected string $layout = 'main';

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function renderPartial($partial, $params = [])
    {
        return Application::$app->router->renderPartial($partial,$params);
    }

    public function renderWithPartial($searchKey, $partialName, $viewName, $params = []){
        $view = $this->render($viewName, $params);
        $partial = $this->renderPartial($partialName, $params);

        return str_replace($searchKey, $partial, $view);
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