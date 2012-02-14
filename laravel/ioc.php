<?php

namespace Laravel;

class IoC
{

    /**
     * The registered dependencies.
     *
     * @var array
     */
    protected static $registry = array();

    /**
     * The resolved singleton instances.
     *
     * @var array
     */
    protected static $singletons = array();

    /**
     * Bootstrap the application IoC container.
     *
     * This method is called automatically the first time the class is loaded.
     *
     * @param $registry array           
     * @return void
     */
    public static function bootstrap ($registry = array())
    {
        if (Config::load('container')) {
            static::$registry = Config::$items['container'];
        }
    }

    /**
     * Register an object and its resolver.
     *
     * The IoC container instance is always passed to the resolver, allowing the
     * nested resolution of other objects from the container.
     *
     * <code>
     * // Register an object and its resolver
     * IoC::register('mailer', function($c) {return new Mailer;});
     * </code>
     *
     * @param $name string           
     * @param $resolver Closure           
     * @return void
     */
    public static function register ($name, $resolver, $singleton = false)
    {
        static::$registry[$name] = array('resolver' => $resolver, 
                'singleton' => $singleton);
    }

    /**
     * Determine if an object has been registered in the container.
     *
     * @param $name string           
     * @return bool
     */
    public static function registered ($name)
    {
        return array_key_exists($name, static::$registry);
    }

    /**
     * Register an object as a singleton.
     *
     * Singletons will only be instantiated the first time they are resolved.
     * The same instance will be returned on subsequent requests.
     *
     * @param $name string           
     * @param $resolver Closure           
     * @return void
     */
    public static function singleton ($name, $resolver)
    {
        static::register($name, $resolver, true);
    }

    /**
     * Register an instance as a singleton.
     *
     * This method allows you to register an already existing object instance
     * with the container to be managed as a singleton instance.
     *
     * <code>
     * // Register an instance as a singleton in the container
     * IoC::instance('mailer', new Mailer);
     * </code>
     *
     * @param $name string           
     * @param $instance mixed           
     * @return void
     */
    public static function instance ($name, $instance)
    {
        static::$singletons[$name] = $instance;
    }

    /**
     * Resolve a core Laravel class from the container.
     *
     * <code>
     * // Resolve the "laravel.router" class from the container
     * $input = IoC::core('router');
     *
     * // Equivalent resolution using the "resolve" method
     * $input = IoC::resolve('laravel.router');
     *
     * // Pass an array of parameters to the resolver
     * $input = IoC::core('router', array('test'));
     * </code>
     *
     * @param $name string           
     * @param $parameters array           
     * @return mixed
     */
    public static function core ($name, $parameters = array())
    {
        return static::resolve("laravel.{$name}", $parameters);
    }

    /**
     * Resolve an object instance from the container.
     *
     * <code>
     * // Get an instance of the "mailer" object registered in the container
     * $mailer = IoC::resolve('mailer');
     *
     * // Pass an array of parameters to the resolver
     * $mailer = IoC::resolve('mailer', array('test'));
     * </code>
     *
     * @param $name string           
     * @param $parameters array           
     * @return mixed
     */
    public static function resolve ($name, $parameters = array())
    {
        if (array_key_exists($name, static::$singletons)) {
            return static::$singletons[$name];
        }
        
        if (! static::registered($name)) {
            throw new \OutOfBoundsException(
                    "Error resolving [$name]. No resolver has been registered.");
        }
        
        $object = call_user_func(static::$registry[$name]['resolver'], 
                $parameters);
        
        if (isset(static::$registry[$name]['singleton']) and
                 static::$registry[$name]['singleton']) {
                    return static::$singletons[$name] = $object;
                }
                
                return $object;
            }
        
        }
        
        /**
         * We only bootstrap the IoC container once the class has been
         * loaded since there isn't any reason to load the container
         * configuration until the class is first requested.
         */
        IoC::bootstrap();