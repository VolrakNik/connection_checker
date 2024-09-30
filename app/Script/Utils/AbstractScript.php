<?php

namespace Script\Utils;

use Common\MonologFormatter\GrafanaFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use ReflectionClass;
use Script\Utils\Interfaces\Runnable;

abstract class AbstractScript implements Runnable
{
    public const LOGS_FOLDER_PATH = __DIR__ . '/../../logs/';

    private ReflectionClass $reflectionClass;
    protected Logger $logger;

    public function __construct()
    {
        $this->reflectionClass = new ReflectionClass(static::class);

        //Set logger
        $this->logger = new Logger('logger');
        $streamHandler = new StreamHandler(self::LOGS_FOLDER_PATH . $this->reflectionClass->getShortName() . '.log');
        $streamHandlerCli = new StreamHandler('php://stdout');
        $streamHandler->setFormatter(new GrafanaFormatter());
        $streamHandlerCli->setFormatter(new GrafanaFormatter());
        $this->logger
            ->pushHandler($streamHandler)
            ->pushHandler($streamHandlerCli);
    }

    /**
     * @return Logger
     */
    public function getLogger(): Logger
    {
        return $this->logger;
    }
}