<?php

namespace app\core;

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
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false){
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }

        if(is_string($callback)){
            if(strpos($callback, '@')){
                [$controller, $action] = explode("@",$callback);

                return $this->callAction($controller, $action);
            }
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }


    public function callAction($controller, $action) {
        $controller = "App\\Controllers\\${controller}";
        $controller = new $controller;
        Application::$app->setController($controller);
        if(! method_exists($controller,$action)){
            throw new Exception("{$controller} doesn not to respond to the action {$action}");
        }
        return $controller->$action($this->request);
    }


    public function renderView($view, $params = [])
    {
        $viewContent  = $this->renderOnlyView($view, $params);

        return $this->renderContent($viewContent);
    }

    public function layoutContent()
    {
        $layout = Application::$app->controller->getLayout();
        ob_start();
        include Application::$ROOT_DIR."/resources/views/layouts/{$layout}.view.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, $params = []){

        foreach($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include Application::$ROOT_DIR."/resources/views/{$view}.view.php";
        return ob_get_clean();
    }
    protected function renderPartial($partial){
        ob_start();
        include Application::$ROOT_DIR."/resources/views/partials/{$partial}.view.php";
        return ob_get_clean();
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        $nav = $this->renderPartial('nav');
        $footer = $this->renderPartial('footer');
        $layoutContent = str_replace('{{content}}', $viewContent, $layoutContent);
        $layoutContent = str_replace('{{nav}}', $nav, $layoutContent);

        return str_replace('{{footer}}', $footer, $layoutContent);
    }
}