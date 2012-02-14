<?php

namespace Laravel\Session\Drivers;

class Memcached implements Driver
{

    /**
     * The Memcache cache driver instance.
     *
     * @var Cache\Drivers\Memcached
     */
    private $memcached;

    /**
     * Create a new Memcached session driver instance.
     *
     * @param $memcached Memcached           
     * @return void
     */
    public function __construct (\Laravel\Cache\Drivers\Memcached $memcached)
    {
        $this->memcached = $memcached;
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
        return $this->memcached->get($id);
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
        $this->memcached->put($session['id'], $session, $config['lifetime']);
    }

    /**
     * Delete a session from storage by a given ID.
     *
     * @param $id string           
     * @return void
     */
    public function delete ($id)
    {
        $this->memcached->forget($id);
    }

}