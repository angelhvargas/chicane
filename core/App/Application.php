<?php
namespace Chicane;
use Chicane\Contracts\ApplicationInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use App\Controller\BlogController;

class Application implements ApplicationInterface{
    protected $path;
    protected $instances;

    public function __construct(string $path) 
    {
        $this->path = $path;
    }

    public function path()
    {
        return $this->path;
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