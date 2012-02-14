<?php

namespace Laravel\Cache\Drivers;

class APC extends Driver
{

    /**
     * The cache key from the cache configuration file.
     *
     * @var string
     */
    protected $key;

    /**
     * Create a new APC cache driver instance.
     *
     * @param $key string           
     * @return void
     */
    public function __construct ($key)
    {
        $this->key = $key;
    }

    /**
     * Determine if an item exists in the cache.
     *
     * @param $key string           
     * @return bool
     */
    public function has ($key)
    {
        return (! is_null($this->get($key)));
    }

    /**
     * Retrieve an item from the cache driver.
     *
     * @param $key string           
     * @return mixed
     */
    protected function retrieve ($key)
    {
        if (! is_null($cache = apc_fetch($this->key . $key))) {
            return $cache;
        }
    }

    /**
     * Write an item to the cache for a given number of minutes.
     *
     * <code>
     * // Put an item in the cache for 15 minutes
     * Cache::put('name', 'Taylor', 15);
     * </code>
     *
     * @param $key string           
     * @param $value mixed           
     * @param $minutes int           
     * @return void
     */
    public function put ($key, $value, $minutes)
    {
        apc_store($this->key . $key, $value, $minutes * 60);
    }

    /**
     * Delete an item from the cache.
     *
     * @param $key string           
     * @return void
     */
    public function forget ($key)
    {
        apc_delete($this->key . $key);
    }

}