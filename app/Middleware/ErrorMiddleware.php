<?php

namespace App\Middleware;

class ErrorMiddleware
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
     * Check for HTTP errors on processed response and render respective view
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);

        if ($response->getBody()->getSize() == 0) {
            if ($response->getStatusCode() === 403) {
                return $this->ci->view->render($response, 'errors/403.html.twig');
            } else if ($response->getStatusCode() === 404) {
                return $this->ci->view->render($response, 'errors/404.html.twig');
            }
        }

        return $response;
    }
}
