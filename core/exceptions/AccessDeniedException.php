<?php


namespace app\core\exceptions;



class AccessDeniedException extends \Exception
{
    protected $code = 403;
    protected $message = 'You do not have permission to access this page';
}