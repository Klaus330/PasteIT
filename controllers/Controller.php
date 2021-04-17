<?php


namespace app\controllers;


use app\core\Application;
use app\middlewares\Middleware;

class Controller
{
    protected string $layout = 'main';
    protected string $action = '';

    /**
     * @var $middlewares Middleware[]
     */
    protected array $middlewares = [];


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