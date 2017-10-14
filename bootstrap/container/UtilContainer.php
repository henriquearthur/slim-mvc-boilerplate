<?php

use App\Helper\Util;

$container['util'] = function ($c) {
    $util = new Util();

    return $util;
};
