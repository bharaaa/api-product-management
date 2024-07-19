<?php

namespace App\Exceptions;

use Exception;

class ServiceException extends Exception
{
    protected $message;
    protected $code;

    public function __construct($message = 'Service error', $code = 500)
    {
        parent::__construct($message, $code);
    }
}