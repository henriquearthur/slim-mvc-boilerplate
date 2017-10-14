<?php

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/bootstrap/settings.php';

return array(
    'paths' => array(
        'migrations' => __DIR__ . '/database/migrations',
        'seeds' => __DIR__ . '/database/seeds'
        ),
    'environments' => array(
     'default_database' => 'development',
     'development' => array(
        'adapter'   => $config['db']['dbms'],
        'host'      => $config['db']['host'],
        'name'      => $config['db']['database'],
        'user'      => $config['db']['username'],
        'pass'      => $config['db']['password'],
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci'
        ),
     'production' => array(
        'adapter'   => $config['db']['dbms'],
        'host'      => $config['db']['host'],
        'name'      => $config['db']['database'],
        'user'      => $config['db']['username'],
        'pass'      => $config['db']['password'],
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci'
        )
     )
    );
