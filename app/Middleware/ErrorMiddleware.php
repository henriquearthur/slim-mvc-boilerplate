<?php

namespace App\Middleware;

class ErrorMiddleware
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
     * Check for HTTP errors on processed response and render respective view
     * @param  \Psr\Http\Message\ServerRequestInterface $request   PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response  PSR7 response
     * @param  callable                                 $next      Next middleware
     * @return array
     */
    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);

        if ($response->getBody()->getSize() == 0) {
            if ($response->getStatusCode() === 403) {
                return $this->container->twig->render($response, 'errors/403.html.twig');
            } else if ($response->getStatusCode() === 404) {
                return $this->container->twig->render($response, 'errors/404.html.twig');
            }
        }

        return $response;
    }
}
