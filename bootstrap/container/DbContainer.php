<?php

use App\Model\Core\Database;

$container['db'] = function ($c) {
    $db = $c['settings']['db'];

    $pdo = new Database(
        $c,
        "{$db['dbms']}:host={$db['host']};dbname={$db['database']}",
        $db['username'],
        $db['password']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec("set names utf8");

    return $pdo;
};
