<?php


namespace app\middlewares;


use app\core\Application;
use app\core\exceptions\AccessDeniedException;

class GuestMiddleware extends Middleware
{

    public function execute()
    {
        $currentAction = app('controller')->getAction();
        if (empty($this->actions) || in_array($currentAction, $this->actions)) {
            if (!Application::isGuest()) {
                throw new AccessDeniedException();
            }
        }
    }
}