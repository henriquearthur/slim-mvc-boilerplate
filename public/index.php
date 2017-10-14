<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../bootstrap/settings.php';

$app = new Slim\App(["settings" => $config]);

require __DIR__ . '/../bootstrap/container.php';
require __DIR__ . '/../bootstrap/middlewares.php';
require __DIR__ . '/../bootstrap/routes.php';

$app->run();
