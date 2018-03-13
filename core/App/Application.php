<?php
namespace Chicane;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Application implements HttpKernelInterface {
    
    protected $app_path;
    protected $instances;
    protected $routes;

    public function __construct(string $app_path) 
    {
        $this->path = $app_path;
    }

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true) {
        
        $path = $request->getPathInfo();
			
        // Does this URL match a route?
        if (array_key_exists($path, $this->routes)) {
            // execute the callback
            $controller = $routes[$path];
            $response = $controller();
        } else {
            // no route matched, this is a not found.
            $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    // Associates an URL with a callback function
	public function map($path, $controller) {
		$this->routes[$path] = $controller;
	}

    public function appPath()
    {
        return $this->app_path;
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