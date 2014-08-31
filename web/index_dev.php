<?php

use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;

require_once __DIR__.'/../vendor/autoload.php';

error_reporting(-1);
ErrorHandler::register();
if ('cli' !== php_sapi_name()) {
    ExceptionHandler::register();
}

$app = require __DIR__.'/../src/bootstrap.php';
require __DIR__.'/../src/controllers.php';

$app['debug'] = true;


$app->run();
