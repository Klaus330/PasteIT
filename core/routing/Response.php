<?php


namespace app\core\routing;


class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect($path){
        header("Location:$path");
        return $this;
    }

    public function withErrors(array $errors = [])
    {
        session()->setFlash("errors", $errors);
        return $this;
    }
}