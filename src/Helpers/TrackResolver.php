<?php

namespace Edsp\Mvc\Helpers;

use Edsp\Mvc\ExpandedObject;
use Exception;

class TrackResolver extends ExpandedObject
{
    public static function path(string $pathTrace = '/'): string
    {
        throw new Exception('O método ' . __METHOD__ . ' não foi implementado!');
    }
}