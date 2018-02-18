<?php
namespace Chicane;
use Chicane\Contracts\ApplicationInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use App\Controller\BlogController;

class Application implements ApplicationInterface{
    protected $path;

    public function __construct(string $path) 
    {
        $this->path = $path;
    }

    public function path()
    {
        return $this->path;
    }
}