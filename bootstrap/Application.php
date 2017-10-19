<?php

namespace Bootstrap;

class Application
{
    /**
     * Slim application
     * @var \Slim\App
     */
    private $app;

    /**
     * Bootstrap application
     *
     * - Create \Slim\App instance
     * - Register container services
     * - Register middlewares
     * - Register routes
     */
    public function __construct()
    {
        session_start();

        $this->createAppInstance();

        $this->registerContainerServices();
        $this->registerMiddlewares();
        $this->registerRoutes();
    }

    /**
     * Get \Slim\App instance
     * @return \Slim\App
     */
    public function getAppInstance()
    {
        return $this->app;
    }

    /**
     * Create \Slim\App instance using application settings
     * @return void
     */
    public function createAppInstance()
    {
        $settings = new Settings();
        $config = $settings->getConfig();

        $this->app = new \Slim\App([
            "settings" => $config
        ]);
    }

    /**
     * Register services on dependency container
     * @return void
     */
    public function registerContainerServices()
    {
        $containerServices = new ContainerServices($this->getAppInstance());
        $containerServices->registerAllServices();
    }

    /**
     * Register middlewares
     * @return void
     */
    public function registerMiddlewares()
    {
        $middlewares = new Middlewares($this->getAppInstance());
        $middlewares->registerMiddlewares();
    }

    /**
     * Register routes
     * @return void
     */
    public function registerRoutes()
    {
        $router = new Router($this->getAppInstance());
        $router->registerRoutes();
    }
}
