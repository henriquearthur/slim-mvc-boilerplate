<?php

/**
 * Slim Framework MVC Boilerplate
 *
 * This file is the starting point of your application.
 *
 * It is responsible for bootstrapping the Slim application itself, dependencies on Dependency-Injection Container,
 * middlewares and routes.
 *
 * You can find more information on Bootstrap\Application class.
 */

require __DIR__ . '/../vendor/autoload.php';

$application = new Bootstrap\Application;

$app = $application->getAppInstance();
$app->run();
