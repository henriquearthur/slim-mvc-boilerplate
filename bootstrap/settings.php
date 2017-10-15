<?php

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

$dotenv->required('ENVIRONMENT')->allowedValues(['development', 'production']);

$config['environment'] = getenv('ENVIRONMENT');

if ($config['environment'] == 'development') {
    $config['displayErrorDetails'] = true;

    ini_set("display_errors", 1);
    ini_set("html_errors", 1);
    error_reporting(E_ALL);
} elseif ($config['environment'] == 'production') {
    $config['displayErrorDetails'] = false;

    ini_set("display_errors", 0);
}

$config['determineRouteBeforeAppMiddleware'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['dbms']     = getenv('DB_DBMS');
$config['db']['host']     = getenv('DB_HOST');
$config['db']['username'] = getenv('DB_USERNAME');
$config['db']['password'] = getenv('DB_PASSWORD');
$config['db']['database'] = getenv('DB_DATABASE');

$config['mail']['smtp']['host']     = getenv('MAIL_SMTP_HOST');
$config['mail']['smtp']['user']     = getenv('MAIL_SMTP_USER');
$config['mail']['smtp']['password'] = getenv('MAIL_SMTP_PASSWORD');
$config['mail']['smtp']['protocol'] = getenv('MAIL_SMTP_PROTOCOL');
$config['mail']['smtp']['port']     = getenv('MAIL_SMTP_PORT');

$config['domain'] = getenv('DOMAIN');

$config['timezone']       = 'UTC';
$config['locale']         = 'en_US';
$config['fallbackLocale'] = 'en_US';

if (!empty($config['timezone'])) {
    date_default_timezone_set($config['timezone']);
}

if (empty($config['locale'])) {
    setlocale(LC_ALL, $config['fallbackLocale']);
} else {
    setlocale(LC_ALL, $config['locale']);
}
