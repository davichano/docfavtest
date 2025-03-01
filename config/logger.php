<?php

use Dotenv\Dotenv;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * @return Logger
 */
function getLogger(): Logger
{
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    static $logger = null;
    if ($logger) {
        return $logger;
    }

    $logFile = __DIR__ . '/../logs/app.log';

    if (!file_exists(dirname($logFile))) {
        mkdir(dirname($logFile), 0777, true);
    }

    $loggerLevel = ($_ENV['APP_ENV'] ?? 'prod') === 'dev' ? Logger::DEBUG : Logger::INFO;
    $logger = new Logger('app');
    $logger->pushHandler(new StreamHandler($logFile, $loggerLevel));

    return $logger;
}
