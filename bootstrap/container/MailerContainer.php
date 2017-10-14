<?php

use App\Model\Core\Mailer;

$container['mailer'] = function ($c) {
    $mailer = new Mailer($c);

    return $mailer;
};
