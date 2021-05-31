<?php


namespace app\core\routing;


class Route
{
    protected string $url;
    protected $callback;
    protected $method;

    protected $regex;

    /**
     * Route constructor.
     * @param string $url
     * @param $callback
     */
    public function __construct(string $url, $callback)
    {
        $this->url = $url;
        $this->callback = $callback;
    }


    public static function get($url, $callback)
    {
        router()->get(new Route($url, $callback));
    }

    public static function post($url, $callback)
    {
        router()->post(new Route($url, $callback));
    }

    public static function put($url, $callback)
    {
        router()->put(new Route($url, $callback));
    }

    public static function delete($url, $callback)
    {
        router()->delete(new Route($url, $callback));
    }


    public static function regex($url, $callback, $method)
    {
        $route = new Route($url, $callback);
        $route->setMethod($method);
        router()->regex($route);
    }


    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param mixed $callback
     */
    public function setCallback($callback): void
    {
        $this->callback = $callback;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method): void
    {
        $this->method = $method;
    }

    public function isRegex()
    {
        return $this->method === "regex";
    }


}