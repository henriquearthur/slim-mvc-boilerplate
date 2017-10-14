<?php

use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Filesystem\Filesystem;

$container['translation'] = function ($c) {
    $loader = new FileLoader(new Filesystem(), __DIR__ . '/../../lang');

    $translation = new Translator($loader, false);
    return $translation;
};
