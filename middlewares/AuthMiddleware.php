<?php


namespace app\middlewares;


use app\core\Application;
use app\core\exceptions\AccessDeniedException;

class AuthMiddleware extends Middleware
{
    public function execute()
    {
        if(Application::isGuest()){
            if(empty($this->actions) || in_array(app('controller')->getAction(), $this->actions)){
                throw new AccessDeniedException();
            }
        }
    }
}