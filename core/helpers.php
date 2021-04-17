<?php

use app\core\Application;
use JetBrains\PhpStorm\NoReturn;

if (!function_exists('view')) {
    /**
     * @param $view
     * @param array $data
     * @return array|string
     */
    function view($view, $data = []): array|string
    {
      return app()->view->renderView($view, $data);
    }
}
if (!function_exists('redirect')) {
    /**
     * @param $path
     */
    #[NoReturn] function redirect($path)
    {
        app()->response->redirect($path);
        exit;
    }
}

if (!function_exists('app')) {

    /**
     * @param null $abstract
     * @param array $parameters
     * @return Application
     */
    function app($abstract = null, array $parameters = []): Application
    {
        return Application::$app;
    }
}

if (!function_exists('abort')) {
    /**
     * @param $e
     */
    #[NoReturn] function abort($code, $message = '', array $headers = [])
    {
        app()->abort($code, $message, $headers);
    }
}


if (!function_exists('dd')) {
    /**
     * @param $e
     */
    #[NoReturn] function dd($e)
    {
        die(var_dump($e));
    }
}


if (!function_exists('config')) {
    /**
     * @param null $key
     * @param null $default
     */
    function config($key = null)
    {
        if(is_null($key)){
            return Application::$config;
        }

        return Application::$config[$key];

    }
}

if (!function_exists('session')) {
    /**
     * @return \app\core\Session
     */
    function session()
    {
        return app()->session;
    }
}

if (!function_exists('auth')) {
    /**
     * @return \app\models\DbModel|null
     */
    function auth()
    {
        return app()->user;
    }
}
