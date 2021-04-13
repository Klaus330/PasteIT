<?php

namespace app\core;

use app\core\database\Database;

class Application
{

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static $config;
    public Database $db;
    public static Application $app;
    public Controller $controller;


    protected static $registry = [];

    /**
     * Application constructor.
     * @param $router
     */

    public function __construct($rootPath, $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$config = $config;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->controller = new Controller();
        $this->db = Database::getConnection();
    }

    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }

    public static function get($key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new \Exception("No {$key} is bound in the container.");
        }

        return static::$registry[$key];
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}