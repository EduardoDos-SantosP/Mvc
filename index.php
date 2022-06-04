<?php

use Edsp\Mvc\Http\Router;

include_once __DIR__ . "/vendor/autoload.php";
include_once __DIR__ . "/static/constants.php";
include_once __DIR__ . "/static/functions.php";

try {
    $r = new Router();
    $r->run();
} catch (Throwable $e) {
    \Edsp\Mvc\Helpers\ErrHandler::renderHtml($e);
}
