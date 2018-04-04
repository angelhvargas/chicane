<?php
namespace Chicane\IoC;

class Container {
    protected static $registry = [];

    public static function register($instance, \Closure $resolve)
    {
        static::$registry[$name] = $resolve;
    }

    public static function resolve($name)
    {
        if ( static::registered($name) ) {
            $name = static::$registry[$name];
            return $name();
        }

        throw new Exception("Instance not found. You sure has been registered?");
    }

    public static function registered()
    {
        return array_key_exists($name,  static::$registry);
    }
}