<?php


namespace app\middlewares;


use app\core\exceptions\AccessDeniedException;
use app\core\exceptions\PageNotFoundException;

class CheckIfAdmin extends Middleware
{

    public function execute()
    {
        if(!auth()->isAdmin()){
            throw new PageNotFoundException();
        }
    }
}