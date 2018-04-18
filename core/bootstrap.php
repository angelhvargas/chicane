<?php

define('CHICANE_START', microtime(true));
define('app', null);

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
*/

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->register();

/*
|--------------------------------------------------------------------------
| Start Application
|--------------------------------------------------------------------------
|
*/
require_once __DIR__.'/../core/start.php';
