<?php

namespace App\Core;

class Router
{
    protected array $routes = [];
    protected $request;
    protected $response;

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($uri, $controller)
    {
        $this->routes['get'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['post'][$uri] = $controller;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false){
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }

        if(is_string($callback)){
            [$controller, $action] = explode("@",$callback);
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent  = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);

    }

    public function layoutContent()
    {
        ob_start();
        include Application::$ROOT_DIR."/resources/views/layouts/main.view.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view){
        ob_start();
        include Application::$ROOT_DIR."/resources/views/{$view}.view.php";
        return ob_get_clean();
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);

    }
}