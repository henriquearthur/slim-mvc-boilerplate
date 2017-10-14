<?php

use App\Model\Core\Cache;

$container['cache'] = function ($c) {
    $cache = new Cache($c);

    return $cache;
};
