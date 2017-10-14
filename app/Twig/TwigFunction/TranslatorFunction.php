<?php

namespace App\Twig\TwigFunction;

use App\Helper\Translator;

class TranslatorFunction extends Translator
{
    /**
     * Wrapper for translate method
     *
     * @param  string       $key     key to search for
     * @param  array        $replace placeholders replacement
     * @param  string       $lang    language to search for
     * @return string|null           value for given key in language
     */
    public function index($key, $replace = array(), $lang = false)
    {
        return $this->translate($key, $replace, $lang);
    }
}
