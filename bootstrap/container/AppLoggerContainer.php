<?php

$container['appLogger'] = function ($c) {
    $appLogger = new Monolog\Logger('application');
    $fileHandler = new Monolog\Handler\StreamHandler(__DIR__ . "/../../storage/logs/app.log");

    $appLogger->pushHandler($fileHandler);
    $appLogger->pushProcessor(new Monolog\Processor\WebProcessor);
    $appLogger->pushProcessor(new Monolog\Processor\IntrospectionProcessor);

    return $appLogger;
};
