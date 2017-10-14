<?php

use App\Twig\TwigFunction\TranslatorFunction;

$container['view'] = function ($c) {
    $templatesPath = __DIR__ . "/../../web/templates";

    $view = new Slim\Views\Twig($templatesPath, [
        'cache' => ($c->settings['environment'] == 'production') ? __DIR__ . '/../../storage/cache' : false,
        'debug' => ($c->settings['environment'] == 'production') ? false : true
    ]);

    /**
     * Twig Extensions
     */
    $view->addExtension(new Twig_Extension_Debug());

    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    $view->addExtension(new Cocur\Slugify\Bridge\Twig\SlugifyExtension(Cocur\Slugify\Slugify::create()));

    /**
     * Twig Globals
     */
    $url = $c->get('request')->getUri();

    if (substr($url, -1) == '/') {
        $url = substr($url, 0, -1);
    }

    $view->getEnvironment()->addGlobal('currentUrl', $url);
    $view->getEnvironment()->addGlobal('currentUri', $c->get('request')->getUri()->getPath());

    $view->getEnvironment()->addGlobal('domain', $c->get('settings')['domain']);

    $csrf                  = array();
    $csrf['keys']['name']  = $c->csrf->getTokenNameKey();
    $csrf['keys']['value'] = $c->csrf->getTokenValueKey();
    $csrf['name']          = $c->csrf->getTokenName();
    $csrf['value']         = $c->csrf->getTokenValue();

    $view->getEnvironment()->addGlobal('csrf', $csrf);

    /**
     * Twig Functions
     */
    $translatorFunction = new Twig_Function('translator', array(new TranslatorFunction($c), 'index'));
    $view->getEnvironment()->addFunction($translatorFunction);

    return $view;
};
