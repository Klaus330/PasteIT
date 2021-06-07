<?php


namespace app\core\exceptions;


class BannedException extends \Exception
{

    protected $code = 403;
    protected $message = 'You have been banned';
}