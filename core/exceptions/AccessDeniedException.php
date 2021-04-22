<?php


namespace app\core\exceptions;



class AccessDeniedException extends \Exception
{
    protected $code = 403;
    protected $message = 'Access Denied';
}