<?php


/*
 *Routes file ----
 * Add any routes to this file.
 * Please check documentation
 *
 */
$app->map('/hello/{name}', function ($name) {
    return new \Symfony\Component\HttpFoundation\Response(phpinfo());
});
