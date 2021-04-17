<?php


namespace app\core\exceptions;


class HttpException extends \Exception
{
    protected $code = 404;
    protected $message = 'Page not found';
    protected $headers;
    /**
     * HttpException constructor.
     * @param int $code
     * @param string $message
     */
    public function __construct(int $code, string $message, array $headers)
    {
        $this->code = $code;
        $this->message = $message;
        $this->headers = $headers;
    }


}