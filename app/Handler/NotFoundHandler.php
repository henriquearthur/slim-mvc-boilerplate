<?php

namespace App\Handler;

use Slim\Handlers\NotFound;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class NotFoundHandler extends NotFound
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
     * Renders 404 error template
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request   PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response  PSR7 response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        parent::__invoke($request, $response);

        $this->ci->view->render($response, 'error/404.html.twig', $viewData);
        return $response->withStatus(404);
    }
}
