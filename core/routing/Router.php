<?php

namespace app\core\routing;

use app\core\exceptions\PageNotFoundException;
use app\core\exceptions\RouteNotFoundException;

class Router
{
    protected array $routes = [];
    protected Request $request;
    protected Response $response;
    protected $matcher;
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

    public function get($route)
    {
        $route->setMethod("get");
        $this->routes['get'][$route->getUrl()] = $route;
    }

    public function post($route)
    {
        $route->setMethod("post");
        $this->routes['post'][$route->getUrl()] = $route;
    }

    public function put($route)
    {
        $route->setMethod("put");
        $this->routes['put'][$route->getUrl()] = $route;
    }

    public function delete($route)
    {
        $route->setMethod("delete");
        $this->routes['delete'][$route->getUrl()] = $route;
    }

    public function regex($route)
    {
        $this->routes['regex'][$route->getMethod()][] = $route;
    }


    public function resolve()
    {

        $path = $this->request->getPath();
        $method = $this->request->method();
        $url = explode("/", $path);
        $matchedRoute = $this->match($path,$method);


        $callback = $matchedRoute->getCallback();

        if ($callback === false) {
            throw new PageNotFoundException();
        }

        if (is_string($callback)) {
            if (strpos($callback, '@')) {
                [$controller, $action] = explode("@", $callback);

                return $this->callAction($controller, $action);
            }
            return app('view')->renderView($callback);
        }

        return call_user_func($callback);
    }

    /**
     * @var $controller Controller
     */
    public function callAction($controller, $action, $pathParam = null)
    {
        $controller = "App\\Controllers\\${controller}";
        $controller = new $controller;
        app()->instance('controller', $controller);
        $controller->setAction($action);

        foreach ($controller->getMiddlewares() as $middleware) {
            $middleware->execute();
        }

        app()->setController($controller);
        if (!method_exists($controller, $action)) {
            throw new \Exception("{$controller} doesn not to respond to the action {$action}");
        }

        if(session()->hasFlash("captcha_path")){
            \unlink(session()->getFlash("captcha_path"));
        }

        return $controller->$action($this->request);
    }

    private function match(mixed $path, string $method)
    {

        $selectedRoute = $this->routes[$method][$path] ?? false;

        if($selectedRoute === false){
            foreach ($this->routes['regex'][$method] as $route){
                if(preg_match($route->getUrl(),$path)){
                    $selectedRoute = $route;
                    break;
                }
            }
        }

        if($selectedRoute === false){
            throw new PageNotFoundException();
        }

        return $selectedRoute;
    }

}