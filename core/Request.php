<?php


namespace App\Core;


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
}