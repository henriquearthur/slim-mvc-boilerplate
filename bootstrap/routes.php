<?php

use App\Controller\MainPageController;

use App\Middleware\AjaxMiddleware;

/**
 * Site routes
 */
$app->get('/', MainPageController::class . ':index')->setName('index');

/**
 * Ajax requests
 */
$app->group('/a', function () {
    /**
     * Keep your ajax requests routes in here
     */
})->add(AjaxMiddleware::class);
