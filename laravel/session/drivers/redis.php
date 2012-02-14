<?php

namespace Laravel\Session\Drivers;

class Redis implements Driver
{

    /**
     * The Redis cache driver instance.
     *
     * @var Cache\Drivers\Redis
     */
    protected $redis;

    /**
     * Create a new Redis session driver.
     *
     * @param $redis Cache\Drivers\Redis           
     * @return void
     */
    public function __construct (\Laravel\Cache\Drivers\Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Load a session from storage by a given ID.
     *
     * If no session is found for the ID, null will be returned.
     *
     * @param $id string           
     * @return array
     */
    public function load ($id)
    {
        return $this->redis->get($id);
    }

    /**
     * Save a given session to storage.
     *
     * @param $session array           
     * @param $config array           
     * @param $exists bool           
     * @return void
     */
    public function save ($session, $config, $exists)
    {
        $this->redis->put($session['id'], $session, $config['lifetime']);
    }

    /**
     * Delete a session from storage by a given ID.
     *
     * @param $id string           
     * @return void
     */
    public function delete ($id)
    {
        $this->redis->forget($id);
    }

}