<?php
namespace Chicane;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Application implements HttpKernelInterface {
    
    protected $app_path;
    protected $instances;
    protected $routes;
    protected $dispatcher;

    public function __construct(string $app_path) 
    {
        $this->path = $app_path;
        $this->routes = new RouteCollection();
        $this->dispatcher = new EventDispatcher();
    }

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true) 
    {
        $event = new \Chicane\Events\RequestEvent();
        $event->setRequest($request);   
        $this->dispatcher->dispatch('request', $event);
        $context = new \Symfony\Component\Routing\RequestContext();
        $context->fromRequest($request);
        $matcher = new \Symfony\Component\Routing\Matcher\UrlMatcher($this->routes, $context);  

        try {
            $attributes = $matcher->match($request->getPathInfo());
            $controller = $attributes['controller'];
            unset ($attributes['controller']);
            $response = call_user_func($controller, $attributes);

            $response = $controller;
        } catch(\Symfony\Component\Routing\Exception\ResourceNotFoundException $e) {
            $response = new Response('Not found!!!', Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
    //add new route maps to the framework
    public function map($path, $controller)
    {
        $this->routes->add($path, new \Symfony\Component\Routing\Route(
            $path,
            ['controller' => $controller]
        ));
    }

    // Associates an URL with a callback function

    public function appPath()
    {
        return $this->app_path;
    }

    public function on($event, $callback)
    {
        $this->dispatcher->addListener($event, $callback);
    }

    public function fire($event) 
    {
        return $this->dispatcher->dispatch($event);
    }

    public function registerInstance($instance) {
        if (isset($this->instances)) { 
            $this->instances = [];
        }
        if (is_object($instance))
            $this->instances[get_class($instance)] = $instance;
        else
            throw new \Exception("Can not register an instance as is not an object");
        return $this;
    }
}