<?php

$container['session'] = function ($c) {
    $session = new SlimSession\Helper;

    return $session;
};
