<?php
namespace Chicane;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Routing\RequestContext;

class Application extends IoC\Container implements HttpKernelInterface {
    
    protected $app_path;
    protected $instances;
    protected $routes;
    protected $dispatcher;
    protected $matcher;
    protected $controller_resolver;
    protected $argument_resolver;

    public function __construct() 
    {
        $this->routes = new RouteCollection();
        $this->controler_resolver = new ControllerResolver();
        $this->argument_resolver = new ArgumentResolver();
        $this->dispatcher = new EventDispatcher();
        $this->matcher = new UrlMatcher($this->routes, new RequestContext());
    }

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true) 
    {
        $event = new \Chicane\Events\RequestEvent();
        $event->setRequest($request);   
        $this->dispatcher->dispatch('request', $event);
        $context = new RequestContext();
        $context->fromRequest($request);
        $this->matcher->setContext($context);  

        try {
            $attributes = $this->matcher->match($request->getPathInfo());
            $controller = $attributes['controller'];
            $response = call_user_func($controller, $attributes);
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

    public function getAppPath()
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

    public function __call($name, $args){
        $closure = $this->$name;
        call_user_func_array( $closure, $args );
    }
}