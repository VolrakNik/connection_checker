<?php

namespace Script\Utils;

error_reporting(E_ALL);
ini_set('display_errors', "0");

use Common\Error\ErrorHandler;
use Script\Utils\Interfaces\Runnable;
use Throwable;

$errorHandler = new ErrorHandler(dirname(__DIR__, 2) . '/logs/Script.log');
set_error_handler([$errorHandler, 'errorHandler']);
set_exception_handler([$errorHandler, 'exceptionHandler']);
register_shutdown_function([$errorHandler, 'shutdownHandler']);

class Runner
{
    /** @var Runnable */
    private static $script;

    /**
     * @param string $class
     * @param array $params
     * @return void
     */
    public static function run(string $class, array $params = []): void
    {
        self::execScript($class, $params);
    }

    /**
     * @param string $class
     * @param array $params
     * @return void
     */
    private static function execScript(string $class, array $params): void
    {
        $interfaces = [Runnable::class];
        $classInterfaces = class_exists($class) ? class_implements($class) : [];
        $notImplementedInterfaces = array_diff($interfaces, $classInterfaces);

        if (!class_exists($class)) {
            throw new ("Class $class does not exist");
        }

        if (!empty($notImplementedInterfaces)) {
            throw new (
                "Class $class does not implement " . implode(', ', $notImplementedInterfaces) . ' interface(s)'
            );
        }

        static::$script = empty($params)
            ? new $class()
            : new $class(...$params);

        try {
            static::$script->getLogger()->info('Script has been started');
            static::$script->run();
        } catch (Throwable $e) {
            static::$script->getLogger()->critical($e->getMessage());
        }
    }
}
