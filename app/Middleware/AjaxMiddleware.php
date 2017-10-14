<?php

namespace App\Middleware;

class AjaxMiddleware
{
    protected $ci;

    public function __construct($ci)
    {
        $this->ci = $ci;
    }

    public function __invoke($request, $response, $next)
    {
        if (!$request->isXhr()) {
            return $response->withStatus(403);
        }

        $response = $next($request, $response);
        return $response;
    }
}
