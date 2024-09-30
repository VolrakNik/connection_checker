<?php

namespace Common\Error;

use Common\MonologFormatter\GrafanaFormatter;
use ErrorException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Throwable;

class ErrorHandler
{
    private Logger $logger;

    public function __construct(string $logPath)
    {
        //Set logger
        $this->logger = new Logger('logger');
        $streamHandler = new StreamHandler($logPath);
        $streamHandlerCli = new StreamHandler('php://stdout');
        $streamHandler->setFormatter(new GrafanaFormatter());
        $streamHandlerCli->setFormatter(new GrafanaFormatter());
        $this->logger
            ->pushHandler($streamHandler)
            ->pushHandler($streamHandlerCli);
    }

    /**
     * @param Throwable $e
     * @return void
     */
    public function exceptionHandler(Throwable $e): void
    {
        $this->logger->error(
            $e->getMessage(),
            ['type' => $e->getCode(), 'message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]
        );
    }

    /**
     * @param int $errno
     * @param string $errStr
     * @param string $errFile
     * @param int $errLine
     * @return bool
     */
    public function errorHandler(int $errno, string $errStr, string $errFile, int $errLine): bool
    {
        if (!(error_reporting() & $errno)) {
            return false;
        }

        $this->exceptionHandler(new ErrorException($errStr, 0, $errno, $errFile, $errLine));
        return true;
    }

    /**
     * @return void
     */
    public function shutdownHandler(): void
    {
        $error = error_get_last();
        if ($error === null) {
            return;
        }

        $this->logger->critical($error['message'], $error);
    }

}