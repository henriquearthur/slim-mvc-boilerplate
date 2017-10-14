<?php

/**
 * Include all files in `bootstrap/container` folder
 */

$container = $app->getContainer();

require __DIR__ . "/container/AppLoggerContainer.php";
require __DIR__ . "/container/CacheContainer.php";
require __DIR__ . "/container/CsrfContainer.php";
require __DIR__ . "/container/DbContainer.php";
require __DIR__ . "/container/ErrorContainer.php";
require __DIR__ . "/container/FakerContainer.php";
require __DIR__ . "/container/MailerContainer.php";
require __DIR__ . "/container/SessionContainer.php";
require __DIR__ . "/container/SlugifyContainer.php";
require __DIR__ . "/container/TranslationContainer.php";
require __DIR__ . "/container/TranslatorContainer.php";
require __DIR__ . "/container/UtilContainer.php";
require __DIR__ . "/container/ViewContainer.php";


