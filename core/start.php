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
$real_path = realpath(__DIR__.'/../');
$app = new Chicane\Application(); 

/*
|--------------------------------------------------------------------------
| Application error handler beautifier for dev env
|--------------------------------------------------------------------------
|
*/

$app->register('Error', function() {
    $error_notificator = new \Whoops\Run;
    $error_notificator->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $error_notificator->register();
    return $error_notificator;
});

/*
|--------------------------------------------------------------------------
| Application error handler beautifier for dev env
|--------------------------------------------------------------------------
|
*/

$app->register('orm', function() {

    $paths = array(__DIR__.'/../app/entities');
    $isDevMode = false;

    // the connection configuration
    $dbParams = array(
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => '1234567890',
        'dbname'   => 'chicane',
    );

    $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    $entityManager = Doctrine\ORM\EntityManager::create($dbParams, $config);
    return $entityManager;
});

/*
|--------------------------------------------------------------------------
| View engine intialization
|--------------------------------------------------------------------------
|
|
*/
$app->register('view', function() { 
    $view_cache = new Twig_Loader_Filesystem(__DIR__.'/../app/views');
    $view_engine = new Twig_Environment($view_cache);
    $view_engine_options = [
        'cache' => __DIR__.'/../storage/compiled/views' 
    ];
    return $view_engine;
});


/*
|--------------------------------------------------------------------------
| Include Route collection
|--------------------------------------------------------------------------
|
|
*/
require_once __DIR__."/../app/http/routes.php";

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

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$response = $app->handle($request);
$response->send();
return $app;
