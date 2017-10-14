<?php

use Cocur\Slugify\Slugify;

$container['slugify'] = function ($c) {
    $slugify = new Slugify();

    return $slugify;
};
