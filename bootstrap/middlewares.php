<?php

/**
 * CSRF Middleware (from Slim)
 * Handle CSRF security
 */
$app->add($container->get('csrf'));

/**
 * Session middleware (from Slim)
 * Handle PHP Session
 */
$app->add(new Slim\Middleware\Session(['name' => 'user', 'autorefresh' => true, 'lifetime' => '1 month']));

/**
 * IP Address Middleware (from Slim)
 * Get the real IP address from user
 */
$app->add(new RKA\Middleware\IpAddress(true));

/**
 * Trailing '/'' in route patterns
 * Redirect/rewrite all URLs that end in a '/' to the non-trailing '/' equivalent,
 */
$app->add(new App\Middleware\TrailingSlashMiddleware($container));

/**
 * Error Middleware
 * Handle errors (404, 500, etc)
 */
$app->add(new App\Middleware\ErrorMiddleware($container));
