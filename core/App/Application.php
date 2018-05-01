<?php
namespace Chicane;

use Chicane\Base\Container;
use \Symfony\Component\Routing\RequestContext;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\RouteCollection;
use \Symfony\Component\Routing\Matcher\UrlMatcher;
use \Symfony\Component\HttpKernel\HttpKernelInterface;
use \Symfony\Component\EventDispatcher\EventDispatcher;
use Chicane\Support\Interfaces\ResponsePreparerInterface;
use \Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use \Symfony\Component\HttpKernel\Controller\ControllerResolver;
/**
 * Class Application
 * Core application class, handle the app foundations, bindings and service providers.
 * 
 */
class Application extends Container implements HttpKernelInterface, ResponsePreparerInterface {

    /**
	 * Chicane version.
	 *
	 * @var string
	 */
	const VERSION = 'alpha_0.0.1';
    
    protected $appPath;
    protected $instances;
    protected $routes;
    protected $dispatcher;
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;
    
    /**
	 * The request class used by the application.
	 *
	 * @var string
	 */
    protected static $httpClass = '\Symfony\Component\HttpFoundation\Request';

	/**
	 * Indicates if the application has "booted".
	 *
	 * @var bool
	 */
	protected $booted = false;

	/**
	 * The array of booting callbacks.
	 *
	 * @var array
	 */
	protected $bootingCallbacks = array();

	/**
	 * The array of booted callbacks.
	 *
	 * @var array
	 */
	protected $bootedCallbacks = array();

	/**
	 * The array of finish callbacks.
	 *
	 * @var array
	 */
	protected $finishCallbacks = array();

	/**
	 * The array of shutdown callbacks.
	 *
	 * @var array
	 */
	protected $shutdownCallbacks = array();

	/**
	 * All of the developer defined middlewares.
	 *
	 * @var array
	 */
	protected $middlewares = array();

	/**
	 * All of the registered service providers.
	 *
	 * @var array
	 */
	protected $serviceProviders = array();

	/**
	 * The names of the loaded service providers.
	 *
	 * @var array
	 */
	protected $loadedProviders = array();

	/**
	 * The deferred services and their providers.
	 *
	 * @var array
	 */
    protected $deferredServices = array();
    

	public function __construct(Request $request)
	{
		$this->registerBaseBindings($request ?: $this->createNewRequest());

		$this->registerBaseServiceProviders();

        $this->registerBaseMiddlewares();

        $this->routes = new RouteCollection();

        $this->controlerResolver = new ControllerResolver();

        $this->argumentResolver = new ArgumentResolver();

        $this->dispatcher = new EventDispatcher();

        $this->matcher = new UrlMatcher($this->routes, new RequestContext());
	}

    /**
	 * Register the basic bindings into the container.
	 *
	 * @param  \Symfony\Component\HttpFoundation\Request  $request
	 * @return void
	 */
	protected function registerBaseBindings($request)
	{
		$this->instance('request', $request);

		$this->instance('Chicane\Base\Container', $this);
    }
	/**
	 * Register all of the base service providers.
	 *
	 * @return void
	 */
	protected function registerBaseServiceProviders()
	{
		foreach (array('Event', 'Exception', 'Routing') as $name)
		{
			$this->{"register{$name}Provider"}();
		}
	}

	/**
	 * Register the exception service provider.
	 *
	 * @return void
	 */
	protected function registerExceptionProvider()
	{
		$this->register(new \Chicane\Exception\ExceptionServiceProvider($this));
	}

	/**
	 * Register the routing service provider.
	 *
	 * @return void
	 */
	protected function registerRoutingProvider()
	{
		$this->register(new \Chicane\Routing\RoutingServiceProvider($this));
	}

	/**
	 * Register the event service provider.
	 *
	 * @return void
	 */
	protected function registerEventProvider()
	{
		$this->register(new \Chicane\Events\EventServiceProvider($this));
    }
    
    /**
     * Function handle: this function handle any request comming to the front-end controller
     *
     * @param Request $request
     * @param string $type
     * @param boolean $catch
     * @return Symfony\Component\HttpFoundation\Response
     */
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
            unset($attributes['controller']);
			$response = call_user_func_array($controller, $attributes);
        } catch(\Symfony\Component\Routing\Exception\ResourceNotFoundException $e) {
            $response = new Response('Not found!!!', Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
    /**
     * Function map: map the routes to the framework.
     *
     * @param String $path
     * @param Closure|Array $controller
     * @return void
     */
    public function map($path, $controller)
    {
        $this->routes->add($path, new \Symfony\Component\Routing\Route(
            $path,
            ['controller' => $controller]
        ));
    }
    /**
     * On: Bind event listener to the framework core logic
     *
     * @param String $event
     * @param \Closure $callback
     * @return void
     */
    public function on($event, $callback)
    {
        $this->dispatcher->addListener($event, $callback);
    }
    
    /**
     * Fires event
     *
     * @param Chicane\Event $event
     * @return void
     */
    public function fire($event) 
    {
        return $this->dispatcher->dispatch($event);
    }
    
    /**
	 * Create a new request instance from the request class.
	 *
	 * @return \Symfony\Component\HttpFoundation\Request;
	 */
	protected function createNewRequest()
	{
		return forward_static_call(array(static::$requestClass, 'createFromGlobals'));
    }
    
    /**
	 * Bind the installation paths to the application.
	 *
	 * @param  array  $paths
	 * @return void
	 */
	public function bindInstallPaths(array $paths)
	{
		$this->instance('path', realpath($paths['app']));

		// Here we will bind the install paths into the container as strings that can be
		// accessed from any point in the system. Each path key is prefixed with path
		// so that they have the consistent naming convention inside the container.
		foreach (array_except($paths, array('app')) as $key => $value)
		{
			$this->instance("path.{$key}", realpath($value));
		}
    }
    
    /**
	 * Alias a type to a shorter name.
	 *
	 * @param  string  $abstract
	 * @param  string  $alias
	 * @return void
	 */
	public function alias($abstract, $alias)
	{
		$this->aliases[$alias] = $abstract;
    }
    
    /**
	 * Extract the type and alias from a given definition.
	 *
	 * @param  array  $definition
	 * @return array
	 */
	protected function extractAlias(array $definition)
	{
		return array(key($definition), current($definition));
    }
    
	/**
	 * Determine if the application has booted.
	 *
	 * @return bool
	 */
	public function isBooted()
	{
		return $this->booted;
	}

	/**
	 * Boot the application's service providers.
	 *
	 * @return void
	 */
	public function boot()
	{
		if ($this->booted) return;

		array_walk($this->serviceProviders, function($p) { $p->boot(); });

		$this->bootApplication();
	}

	/**
	 * Boot the application and fire app callbacks.
	 *
	 * @return void
	 */
	protected function bootApplication()
	{
		// Once the application has booted we will also fire some "booted" callbacks
		// for any listeners that need to do work after this initial booting gets
		// finished. This is useful when ordering the boot-up processes we run.
		$this->fireAppCallbacks($this->bootingCallbacks);

		$this->booted = true;

		$this->fireAppCallbacks($this->bootedCallbacks);
	}

	/**
	 * Register a new boot listener.
	 *
	 * @param  mixed  $callback
	 * @return void
	 */
	public function booting($callback)
	{
		$this->bootingCallbacks[] = $callback;
	}

	/**
	 * Register a new "booted" listener.
	 *
	 * @param  mixed  $callback
	 * @return void
	 */
	public function booted($callback)
	{
		$this->bootedCallbacks[] = $callback;

		if ($this->isBooted()) $this->fireAppCallbacks(array($callback));
	}

	/**
	 * Run the application and send the response.
	 *
	 * @param  \Symfony\Component\HttpFoundation\Request  $request
	 * @return void
	 */
	public function run(SymfonyRequest $request = null)
	{
		$request = $request ?: $this['request'];

		$response = with($stack = $this->getStackedClient())->handle($request);

		$response->send();

		$stack->terminate($request, $response);
	}
    /**
	 * Register a service provider with the application.
	 *
	 * @param  \Chicane\Base\ServiceProvider|string  $provider
	 * @param  array  $options
	 * @param  bool   $force
	 * @return \Chicane\Base\ServiceProvider
	 */
	public function register($provider, $options = array(), $force = false)
	{
		if ($registered = $this->getRegistered($provider) && ! $force)
                                     return $registered;

		// If the given "provider" is a string, we will resolve it, passing in the
		// application instance automatically for the developer. This is simply
		// a more convenient way of specifying your service provider classes.
		if (is_string($provider))
		{
			$provider = $this->resolveProviderClass($provider);
		}

		$provider->register();

		// Once we have registered the service we will iterate through the options
		// and set each of them on the application so they will be available on
		// the actual loading of the service objects and for developer usage.
		foreach ($options as $key => $value)
		{
			$this[$key] = $value;
		}

		$this->markAsRegistered($provider);

		// If the application has already booted, we will call this boot method on
		// the provider class so it has an opportunity to do its boot logic and
		// will be ready for any usage by the developer's application logics.
		if ($this->booted) $provider->boot();

		return $provider;
    }
    
    /**
	 * Get the registered service provider instance if it exists.
	 *
	 * @param  \Chicane\Base\ServiceProvider|string  $provider
	 * @return \Chicane\Base\ServiceProvider|null
	 */
	public function getRegistered($provider)
	{
		$name = is_string($provider) ? $provider : get_class($provider);

		if (array_key_exists($name, $this->loadedProviders))
		{
			return array_first($this->serviceProviders, function($key, $value) use ($name)
			{
				return get_class($value) == $name;
			});
		}
    }
    
    /**
	 * Mark the given provider as registered.
	 *
	 * @param  \Chicane\Base\ServiceProvider
	 * @return void
	 */
	protected function markAsRegistered($provider)
	{
		$this['events']->fire($class = get_class($provider), array($provider));

		$this->serviceProviders[] = $provider;

		$this->loadedProviders[$class] = true;
    }
    
    /**
	 * Determine if we are running in the console.
	 *
	 * @return bool
	 */
	public function runningInConsole()
	{
		return php_sapi_name() == 'cli';
    }
    
    /**
	 * Register the default, but optional middlewares.
	 *
	 * @return void
	 */
	protected function registerBaseMiddlewares()
	{
		//
    }
    
    /**
	 * Start the exception handling for the request.
	 *
	 * @return void
	 */
	public function startExceptionHandling()
	{
		$this['exception']->register('local');

		$this['exception']->setDebug(true);
    }
    
    	/**
	 * Get or check the current application environment.
	 *
	 * @param  mixed
	 * @return string
	 */
	public function environment()
	{
		if (count(func_get_args()) > 0)
		{
			return in_array($this['env'], func_get_args());
		}

		return $this['env'];
    }
    

	/**
	 * Determine if application is in local environment.
	 *
	 * @return bool
	 */
	public function isLocal()
	{
		return $this['env'] == 'local';
    }
    
	/**
	 * Prepare the given value as a Response object.
	 *
	 * @param  mixed  $value
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function prepareResponse($value)
	{
		if ( ! $value instanceof SymfonyResponse) $value = new Response($value);

		return $value->prepare($this['request']);
	}

	/**
	 * Determine if the application is ready for responses.
	 *
	 * @return bool
	 */
	public function readyForResponses()
	{
		return $this->booted;
	}
	/**
	 * Detect the application's current environment.
	 *
	 * @param  array|string  $envs
	 * @return string
	 */
	public function detectEnvironment($envs)
	{
		$args = isset($_SERVER['argv']) ? $_SERVER['argv'] : null;

		return $this['env'] = (new \Chicane\Base\EnvironmentDetector())->detect($envs, $args);
	}

    public function __call($name, $args){
        $closure = $this->$name;
        call_user_func_array( $closure, $args );
    }
}