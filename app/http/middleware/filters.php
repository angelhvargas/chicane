<?php

use Chicane\Events\RequestEvent;
use Symfony\Component\HttpFoundation\Response;

$app->on('auth', function(RequestEvent $event) use ($app){ 
    if ($app->auth()) { 
        return $app->getUser();
    } else {
        new Response("Invalid request. Not authorized", 303);
    }
});