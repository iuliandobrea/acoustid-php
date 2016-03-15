<?php namespace AcoustId;

use GuzzleHttp\Exception\ClientException;

/**
 * Class Exception
 *
 * @package AcoustId
 */
class Exception extends \Exception
{

    /**
     * Generic exception handler
     */
    public static function setExceptionHandler()
    {
        \set_exception_handler([__CLASS__, 'handle']);
    }

    /**
     * Handles exceptions
     *
     * @param Exception|ClientException $exception
     */
    public static function handle($exception)
    {

        switch (get_class($exception)) {
            case Exception::class :

                echo $exception->getMessage();
                echo $exception->getTraceAsString();

                break;

            case ClientException::class:

                echo $exception->getMessage();

                break;
        }
    }
}