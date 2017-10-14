<?php

use App\Controller\HomeController;

use App\Middleware\AjaxMiddleware;

/**
 * Site routes
 */
$app->get('/', HomeController::class . ':index')->setName('index');

/**
 * Ajax requests
 */
$app->group('/a', function () {
    /**
     * Keep your ajax requests routes in here
     */
})->add(AjaxMiddleware::class);
