<?php

namespace Bootstrap\Twig\CustomFunction;

use App\Helper\Translator as TranslatorHelper;

class Translator
{
    /**
     * Dependency container provided by Slim
     * @var \Slim\Container
     */
    private $container;

    /**
     * Save dependency container
     * @param \Slim\App $app slim application
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Wrapper for TranslatorHelper->translate()
     * Get value for given key on respective language
     * @param  string       $key     key to search for
     * @param  array        $replace placeholders replacement
     * @param  string       $lang    language to search for
     * @return string|null           value for given key in language
     */
    public function index($key, $replace = array(), $lang = false)
    {
        $translator = new TranslatorHelper($this->container);

        return $translator->translate($key, $replace, $lang);
    }
}
