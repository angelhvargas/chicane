<?php

define('CHICANE_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
*/

require __DIR__.'/../vendor/autoload.php';

$error_notificator = new \Whoops\Run;
$error_notificator->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$error_notificator->register();

require_once __DIR__.'/../core/start.php';
