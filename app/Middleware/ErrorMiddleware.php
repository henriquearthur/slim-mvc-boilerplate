<?php

namespace App\Middleware;

class ErrorMiddleware
{
    protected $ci;

    public function __construct($ci)
    {
        $this->ci = $ci;
    }

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
