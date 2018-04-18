<?php


/**
 * Routes
 */

$app->map('/welcome/{name}', function ($name) {
    return new \Symfony\Component\HttpFoundation\Response("hello ".$name. " welcome to the Chicane Framework");
});

$app->map('/', function() use ($app) {
    
    return new \Symfony\Component\HttpFoundation\Response(
        $app
        ->getInstance('view')
        ->render(
            'index.twig', 
            [
                'hello' => 'This is a message send from the back-end, you can see me at routes.php'
            ]
        )
    );   
});