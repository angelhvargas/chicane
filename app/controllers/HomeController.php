<?php

namespace Chicane\Controllers;

class HomeController extends Controller {

    public function __construct()
    {

    }

    public function index() {
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
    }
}