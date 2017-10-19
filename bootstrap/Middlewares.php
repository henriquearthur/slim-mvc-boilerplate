<?php

namespace Bootstrap;

class Middlewares
{
    /**
     * Slim application
     * @var \Slim\App
     */
    private $app;

    /**
     * Dependency container provided by Slim
     * @var \Slim\Container
     */
    private $container;

    /**
     * Save \Slim\App instance and dependency container
     * @param \Slim\App $app slim application
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();
    }

    /**
     * Register all middlewares
     * @return void
     */
    public function registerMiddlewares()
    {
        $this->registerCsrf();
        $this->registerSession();
        $this->registerIpAddress();
        $this->registerTrailingSlash();
        $this->registerErrorMiddleware();
    }

    /**
     * Register CSRF middleware (provided by Slim-CSRF)
     * Provides CSRF protection
     * @return void
     */
    public function registerCsrf()
    {
        $this->app->add($this->container->get('csrf'));
    }

    /**
     * Register Session middleware (provided by Slim-Session)
     * Provides an easy way to manage sessions
     * @return void
     */
    public function registerSession()
    {
        $this->app->add(new \Slim\Middleware\Session([
            'name' => 'CmsUser',
            'autorefresh' => true,
            'lifetime' => '1 month'
        ]));
    }

    /**
     * Register IP Address middleware
     * @return void
     */
    public function registerIpAddress()
    {
        $this->app->add(new \RKA\Middleware\IpAddress(true));
    }

    /**
     * Register Trailing Slash middleware
     * Redirect/rewrite all URLs that end in a / to the non-trailing / equivalent
     * @return void
     */
    public function registerTrailingSlash()
    {
        $this->app->add(new \App\Middleware\TrailingSlashMiddleware($this->container));
    }

    /**
     * Register Error middleware
     * Check for HTTP errors on the response and render respective view
     * @return void
     */
    public function registerErrorMiddleware()
    {
        $this->app->add(new \App\Middleware\ErrorMiddleware($this->container));
    }
}
