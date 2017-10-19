<?php

namespace App\Helper;

use Illuminate\Translation\FileLoader as IlluminateFileLoader;
use Illuminate\Translation\Translator as IlluminateTranslator;
use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;

class Translator
{
    /**
     * Dependency container provided by Slim
     * @var \Slim\Container
     */
    protected $container;

    /**
     * Translator instance from Illuminate (Laravel)
     * @var \Illuminate\Translation\Translator
     */
    protected $translator;

    /**
     * Save dependency container and instantiate \Illuminate\Translation\Translator
     * @param \Slim\App $app slim application
     */
    public function __construct($container)
    {
        $this->container = $container;

        $langDir    = __DIR__ . "/../../lang";
        $loader     = new IlluminateFileLoader(new IlluminateFilesystem(), $langDir);
        $translator = new IlluminateTranslator($loader, false);
        $this->translator = $translator;
    }

    /**
     * Wrapper for translate method
     * @param  string       $key     key to search for
     * @param  array        $replace placeholders replacement
     * @param  string       $lang    language to search for
     * @return string|null           value for given key in language
     */
    public function get($key, $replace = array(), $lang = false)
    {
        return $this->translate($key, $replace, $lang);
    }

    /**
     * Get value for given key on respective language
     * @param  string       $key     key to search for
     * @param  array        $replace placeholders replacement
     * @param  string       $lang    language to search for
     * @return string|null           value for given key in language
     */
    public function translate($key, $replace = array(), $lang = false)
    {
        $locale         = $this->container->get('settings')['locale'];
        $localeFallback = $this->container->get('settings')['localeFallback'];

        if ($lang === false) {
            $lang = (!empty($locale)) ? $locale : $localeFallback;
        }

        if ($this->exists($key, $lang)) {
            return $this->translator->get($key, $replace, $lang);
        } else if ($this->exists($key, $localeFallback)) {
            $this->container->monolog->warning("The key '{$key}' provided to translator using lang '{$lang}' does not exist. Fallback to locale '{$localeFallback}'");

            return $this->translator->get($key, $replace, $lang);
        } else {
            throw new \Exception("The key '{$key}' provided to translator using lang '{$lang}' does not exist.");
        }
    }

    /**
     * Check if key exists on given language. If it doesn't exists, check on fallback language
     * @param  string  $key  key to search for
     * @param  string  $lang language to search for
     * @return boolean       key-value pair exists or not
     */
    public function exists($key, $lang = false)
    {
        $locale         = $this->container->get('settings')['locale'];
        $localeFallback = $this->container->get('settings')['localeFallback'];

        if ($lang === false) {
            $lang = (!empty($locale)) ? $locale : $localeFallback;
        }

        if ($this->translator->has($key, $lang)) {
            return true;
        }

        return false;
    }
}
