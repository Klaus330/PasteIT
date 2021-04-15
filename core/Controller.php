<?php


namespace app\core;


use app\middlewares\Middleware;

class Controller
{
    protected string $layout = 'main';
    protected $action = '';


    /**
     * @var $middlewares \app\middleware\Middleware[]
    */
    protected array $middlewares = [];

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

    public function redirect($path){
        Application::$app->response->redirect($path);
        exit;
    }

    public function flash($key, $message){
        Application::$app->session->setFlash($key, $message);
    }


    public function registerMiddleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return Middleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }
}