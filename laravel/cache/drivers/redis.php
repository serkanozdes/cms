<?php

namespace Laravel\Cache\Drivers;

class Redis extends Driver
{

    /**
     * The Redis database instance.
     *
     * @var Redis
     */
    protected $redis;

    /**
     * Create a new Redis cache driver instance.
     *
     * @param $redis Redis           
     * @return void
     */
    public function __construct (\Laravel\Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Determine if an item exists in the cache.
     *
     * @param $key string           
     * @return bool
     */
    public function has ($key)
    {
        return (! is_null($this->redis->get($key)));
    }

    /**
     * Retrieve an item from the cache driver.
     *
     * @param $key string           
     * @return mixed
     */
    protected function retrieve ($key)
    {
        if (! is_null($cache = $this->redis->get($key))) {
            return unserialize($cache);
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
        $this->redis->set($key, serialize($value));
        
        $this->redis->expire($key, $minutes * 60);
    }

    /**
     * Delete an item from the cache.
     *
     * @param $key string           
     * @return void
     */
    public function forget ($key)
    {
        $this->redis->del($key);
    }

}