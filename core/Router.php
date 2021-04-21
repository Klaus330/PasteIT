<?php

namespace app\core;

use app\core\exceptions\PageNotFoundException;

class Router
{
    protected array $routes = [];
    protected Request $request;
    protected Response $response;

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
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false){
            throw new PageNotFoundException();
        }

        if(is_string($callback)){
            if(strpos($callback, '@')){
                [$controller, $action] = explode("@",$callback);

                return $this->callAction($controller, $action);
            }
            return app('view')->renderView($callback);
        }

        return call_user_func($callback);
    }

    /**
     * @var $controller Controller
    */
    public function callAction($controller, $action) {
        $controller = "App\\Controllers\\${controller}";
        $controller = new $controller;
        app()->instance('controller', $controller);
        $controller->setAction($action);

        foreach ($controller->getMiddlewares() as $middleware){
            $middleware->execute();
        }

        app()->setController($controller);
        if(! method_exists($controller,$action)){
            throw new \Exception("{$controller} doesn not to respond to the action {$action}");
        }
        return $controller->$action($this->request);
    }
}