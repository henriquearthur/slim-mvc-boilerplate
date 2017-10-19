<?php

namespace App\Middleware;

class AjaxMiddleware
{
    /**
     * Dependency container provided by Slim
     * @var \Slim\Container
     */
    protected $container;

    /**
     * Save dependency container
     * @param \Slim\App $app slim application
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Middleware processing
     * Only allow XMLHttpRequest
     * @param  \Psr\Http\Message\ServerRequestInterface $request   PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response  PSR7 response
     * @param  callable                                 $next      Next middleware
     * @return array
     */
    public function __invoke($request, $response, $next)
    {
        if (!$request->isXhr()) {
            return $response->withStatus(404);
        }

        $response = $next($request, $response);
        return $response;
    }
}
