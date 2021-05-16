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
        $this->routes['get'][] = $route;
    }

    public function post($route)
    {
        $route->setMethod("post");
        $this->routes['post'][] = $route;
    }

    public function put($route)
    {
        $route->setMethod("put");
        $this->routes['put'][] = $route;
    }

    public function delete($route)
    {
        $route->setMethod("delete");
        $this->routes['delete'][] = $route;
    }

    public function resolve()
    {

        $path = $this->request->getPath();
        $method = $this->request->method();
        $url = explode("/", $path);
        $matchedRoute = $this->match($path,$method);

        if($matchedRoute == null) {
            throw new PageNotFoundException();
        }

        if($this->hasRegEx($matchedRoute)){
            preg_match("/:./", $matchedRoute->getUrl(), $matches, PREG_OFFSET_CAPTURE);
            $pathParam = substr($path, $matches[0][1]);
        }

        $callback = $matchedRoute->getCallback();

        if ($callback === false) {
            throw new PageNotFoundException();
        }

        if (is_string($callback)) {
            if (strpos($callback, '@')) {
                [$controller, $action] = explode("@", $callback);

                return $this->callAction($controller, $action, $pathParam ?? null);
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

        if($pathParam){
            $this->request->setParams(['slug' => $pathParam]);
        }

        if(session()->hasFlash("captcha_path")){
            \unlink(session()->getFlash("captcha_path"));
        }

        return $controller->$action($this->request);
    }

    private function match(mixed $path, string $method)
    {

        $bestRoute = null;
        $bestCount = 0;
        foreach ($this->routes[$method] as $route){
            $count = 0;
            $routeUrl = $route->getUrl();

            if($path === $routeUrl){
                return $route;
            }

            $offset = strlen($path) < strlen($routeUrl) ? strlen($path) : strlen($routeUrl);

            for($i=0; $i < $offset; $i++){
                if($path[$i] !== $routeUrl[$i]){
                    if($bestCount < $count){
                        $bestCount = $count;
                        $bestRoute = $route;
                    }
                    break;
                }
                $count++;
            }

        }

        if($count <= 1){
            return null;
        }

        return $bestRoute;
    }

    private function hasRegEx(mixed $matchedRoute)
    {
        preg_match("/:\w+/", $matchedRoute->getUrl(), $matches);
        return (count($matches) > 0 );
    }

}