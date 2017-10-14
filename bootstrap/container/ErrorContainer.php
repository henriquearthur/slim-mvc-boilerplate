<?php

use App\Handler\NotFoundHandler;

$container['notFoundHandler'] = function ($c) {
    return new NotFoundHandler($c, function ($request, $response) use ($c) {
        return $c['response']->withStatus(404);
    });
};
