<?php

namespace app\core;

use app\controllers\Controller;
use app\core\database\Database;
use app\core\exceptions\HttpException;
use app\core\exceptions\NotFoundHttpException;
use app\core\exceptions\PageNotFoundException;
use app\models\DbModel;
use app\models\User;

class Application
{

    public string $layout = 'main';
    public string $userClass;
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static $config;
    public Database $db;
    public Session $session;
    public static Application $app;
    public ?Controller $controller = null;
    public ?DbModel $user;
    public View $view;

    protected static $registry = [];

    /**
     * Application constructor.
     * @param $router
     */

    public function __construct($rootPath, $config)
    {

        $this->userClass = $config['user_class'];
        self::$ROOT_DIR = $rootPath;
        self::$config = $config;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->controller = new Controller();
        $this->db = Database::getConnection();
        $this->session = new Session();
        $this->view = new View();

        if ($this->session->has('user')) {
            $this->user = $this->userClass::findOne([
                $this->userClass::getPrimaryKey() => $this->session->get('user')
            ]);
        } else {
            $this->user = null;
        }

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
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', ['exception' => $e]);
        }

    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }


    public function prepare($sql)
    {
        return $this->db->getPdo()->prepare($sql);
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->getPrimaryKey();

        $primaryValue = $user->$primaryKey;
        $this->session->set('user', $primaryValue);
        return true;
    }


    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->session->has('user');
    }

    public function abort($code, mixed $message, array $headers)
    {
        if ($code == 404) {
            throw new PageNotFoundException($message);
        }

        throw new HttpException($code, $message, $headers);
    }
}