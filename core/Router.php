<?php

namespace app\core;

use app\core\exceptions\PageNotFoundException;

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
            throw new PageNotFoundException();
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

    /**
     * @var $controller Controller
    */
    public function callAction($controller, $action) {
        $controller = "App\\Controllers\\${controller}";
        $controller = new $controller;
        Application::$app->controller = $controller;
        $controller->setAction($action);

        foreach ($controller->getMiddlewares() as $middleware){
            $middleware->execute();
        }


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
        $layout = Application::$app->layout;
        if(Application::$app->controller){
            $layout = Application::$app->controller->getLayout();
        }

        ob_start();
        include Application::$ROOT_DIR."/resources/views/layouts/{$layout}.view.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params = []){

        foreach($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include Application::$ROOT_DIR."/resources/views/{$view}.view.php";
        return ob_get_clean();
    }

    public function renderPartial($partial, $params = []){
        return $this->renderOnlyView("/partials/{$partial}", $params);
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