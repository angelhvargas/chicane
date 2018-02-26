<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/
$error_notificator = new \Whoops\Run;
$error_notificator->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$error_notificator->register();

$view_cache = new Twig_Loader_Filesystem(__DIR__.'/../storage/cache');
$view_engine = new Twig_Environment($view_cache);
$view_engine_options = [
    'cache' => __DIR__.'/../storage/compiled/views' 
];
$app = new Chicane\Application(
     realpath(__DIR__.'/../')
);

$app->registerInstance($error_notificator);
/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

// $app->singleton(
//     Illuminate\Contracts\Http\Kernel::class,
//     App\Http\Kernel::class
// );

// $app->singleton(
//     Illuminate\Contracts\Console\Kernel::class,
//     App\Console\Kernel::class
// );

// $app->singleton(
//     Illuminate\Contracts\Debug\ExceptionHandler::class,
//     App\Exceptions\Handler::class
// );

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
