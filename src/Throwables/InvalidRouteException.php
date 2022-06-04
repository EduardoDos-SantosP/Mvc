<?php

namespace Edsp\Mvc\Throwables;

use Exception;
use Throwable;

class InvalidRouteException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}