<?php

$container['csrf'] = function ($c) {
    $csrf = new Slim\Csrf\Guard();
    $csrf->setPersistentTokenMode(false);

    return $csrf;
};
