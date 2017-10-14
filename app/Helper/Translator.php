<?php

namespace App\Helper;

class Translator
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
     * Wrapper for translate method
     *
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
     *
     * @param  string       $key     key to search for
     * @param  array        $replace placeholders replacement
     * @param  string       $lang    language to search for
     * @return string|null           value for given key in language
     */
    public function translate($key, $replace = array(), $lang = false)
    {
        if ($lang === false) {
            $lang = $this->ci->get('settings')['locale'];
        }

        $fallbackLang = $this->ci->get('settings')['fallbackLocale'];

        if ($this->ci->translation->has($key, $lang)) {
            return $this->ci->translation->get($key, $replace, $lang);
        } elseif ($this->ci->translation->has($key, $fallbackLang)) {
            $this->ci->appLogger->warning("The key [$key] provided to translator [$lang] was not found. Default to fallback [$fallbackLang]");

            return $this->ci->translation->get($key, $replace, $fallbackLang);
        } else {
            throw new \Exception("The key provided to translator [$lang] doesn't exist.");
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
        if ($lang === false) {
            $lang = $this->ci->get('settings')['locale'];

            if (empty($lang)) {
                $lang = $this->ci->get('settings')['fallbackLocale'];
            }
        }

        if ($this->ci->translation->has($key, $lang)) {
            return true;
        }

        return false;
    }
}
