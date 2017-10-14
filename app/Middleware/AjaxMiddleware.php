<?php

namespace App\Middleware;

class AjaxMiddleware
{
    /**
     * Slim DI Container
     * @var \Slim\Container
     */
    protected $ci;

    /**
     * Constructor
     *
     * @param \Slim\Container $ci Slim DI Container
     */
    public function __construct($ci) {
        $this->ci = $ci;
    }

    /**
     * Forbid access if request is a XMLHttpRequest
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        if (!$request->isXhr()) {
            return $response->withStatus(403);
        }

        $response = $next($request, $response);
        return $response;
    }
}
