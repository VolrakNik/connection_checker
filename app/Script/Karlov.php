<?php

namespace Script;

require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', "1");

$errorHandler = new ErrorHandler(dirname(__DIR__) . '/logs/Script.log');
set_error_handler([$errorHandler, 'errorHandler']);
set_exception_handler([$errorHandler, 'exceptionHandler']);
register_shutdown_function([$errorHandler, 'shutdownHandler']);
use Common\Error\ErrorHandler;

sleep(10);
exit();