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
    public static Application $app;

    protected $instances = [];
    protected $bindings = [];

    public static function getInstance()
    {
        if (empty(self::$app)) {
            self::$app = new Application();
            self::$ROOT_DIR = dirname(__DIR__);
            return self::$app;
        }

        return self::$app;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function instance($key, $value)
    {
        $this->instances[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function bind($key, $value)
    {
        $this->bindings[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @return false|mixed
     * @throws \Exception
     */
    public function make($key)
    {

        if (array_key_exists($key, $this->instances)) {
            return $this->instances[$key];
        }

        if (array_key_exists($key, $this->bindings)) {
            $resolver = $this->bindings[$key];
            $reflectionClass = new \ReflectionClass($resolver);

            if (!$reflectionClass->getConstructor() || $reflectionClass->getConstructor()->getNumberOfParameters() === 0) {
                return $resolver();
            } else {
                $params = $reflectionClass->getConstructor()->getParameters();
                $args = [];

                try {
                    foreach ($params as $param) {
                        $paramClass = $param->getClass()->getName();
                        $args[] = $this->make($paramClass);
                    }
                } catch (\Exception $e) {
                    throw new \Exception('Unable to resolve complex dependencies.');
                }

                $instance = $reflectionClass->newInstanceArgs($args);
                $this->instances[$key] = $instance;
                return $this->instances[$key];
            }

        }

        if ($instance = $this->autoResolve($key)) {
            return $instance;
        }

        throw new \Exception("Unable to resolve {$key} from container");
    }

    /**
     * @param $key
     * @return false|mixed
     */
    public function autoResolve($key)
    {
        if (!class_exists($key)) {
            return false;
        }

        $reflectionClass = new \ReflectionClass($key);

        if (!$reflectionClass->isInstantiable()) {
            return false;
        }

        if (!$constructor = $reflectionClass->getConstructor()) {
            return new $key;
        }

        $params = $constructor->getParameters();
        $args = [];

        try {
            foreach ($params as $param) {
                $paramClass = $param->getClass()->getName();
                $args[] = $this->make($paramClass);
            }
        } catch (\Exception $e) {
            throw new \Exception('Unable to resolve complex dependencies.');
        }

        return $reflectionClass->newInstanceArgs($args);
    }

    public function __construct()
    {
    }

    public function run()
    {
        try {
            echo $this->make('router')->resolve();
        } catch (\Exception $e) {
            $this->make('response')->setStatusCode($e->getCode());
            echo $this->make('view')->renderView('_error', ['exception' => $e]);
        }
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->instance('controller', $controller);
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->getPrimaryKey();

        $primaryValue = $user->$primaryKey;
        $this->make('session')->set('user', $primaryValue);
        $this->instance('user', function () use ($user) {
            return $user;
        });
        return true;
    }


    public function logout()
    {
        $this->user = null;
        $this->make('session')->remove('user');
    }

    public static function isGuest()
    {
        return !session()->has('user');
    }

    public function abort($code, mixed $message, array $headers)
    {
        if ($code == 404) {
            throw new PageNotFoundException($message);
        }

        throw new HttpException($code, $message, $headers);
    }
}