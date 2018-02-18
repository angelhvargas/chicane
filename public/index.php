<?php

/**
 * Chicane - A PHP Framework For Web Artisans
 *
 * @package  Chicane
 * @author   Angel Vargas <angelvargas@outlook.es>
 */

/*
|--------------------------------------------------------------------------
| Register bootstrapper
|--------------------------------------------------------------------------
|
|
*/

require_once __DIR__.'/../core/bootstrap.php';
echo "bootstrapped";




/*
|--------------------------------------------------------------------------
| Resolve Request and execute app action
|--------------------------------------------------------------------------
|
|
|
*/


require_once __DIR__.'/../app/routes.php';
