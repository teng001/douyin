<?php


namespace Tengs\Douyin\Exceptions;

use Exception;
use Throwable;

class ClientException extends Exception
{
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param $message
     * @param $code
     * @throws ClientException
     */
    public static function throwError($message, $code = 0)
    {
        throw new ClientException($message, $code);
    }

}
