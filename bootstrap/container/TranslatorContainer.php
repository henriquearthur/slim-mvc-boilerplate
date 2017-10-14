<?php

use App\Helper\Translator;

$container['translator'] = function ($c) {
    $translator = new Translator($c);

    return $translator;
};
