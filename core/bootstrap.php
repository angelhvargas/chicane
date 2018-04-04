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

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__.'/../app/entities');
$isDevMode = false;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '1234567890',
    'dbname'   => 'chicane',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
/*
|--------------------------------------------------------------------------
| Start Application
|--------------------------------------------------------------------------
|
*/
require_once __DIR__.'/../core/start.php';
