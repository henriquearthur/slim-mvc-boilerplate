<?php

namespace App\Twig\TwigFunction;

use App\Helper\Translator;

class TranslatorFunction extends Translator
{
    public function __construct($ci)
    {
        parent::__construct($ci);
    }

    public function index($key, $replace = array(), $lang = false)
    {
        return $this->translate($key, $replace, $lang);
    }
}
