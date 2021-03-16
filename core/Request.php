<?php


namespace app\core;


class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $questionMarkPosition = strpos($path, '?');

        if($questionMarkPosition === false){
            return $path;
        }
        $path = substr($path, 0, $questionMarkPosition);

        return $path;
    }

    public function method()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function isPatch()
    {
        return $this->method() === 'patch';
    }

    public function isDelete()
    {
        return $this->method() === 'delete';
    }

    public function getBody()
    {
        $body = [];

        if($this->method() === 'get'){
            foreach ($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        if($this->method() === 'post'){
            foreach ($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return $body;
    }

}