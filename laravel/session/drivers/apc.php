<?php

namespace Laravel\Session\Drivers;

class APC implements Driver
{

    /**
     * The APC cache driver instance.
     *
     * @var Cache\Drivers\APC
     */
    private $apc;

    /**
     * Create a new APC session driver instance.
     *
     * @param $apc Cache\Drivers\APC           
     * @return void
     */
    public function __construct (\Laravel\Cache\Drivers\APC $apc)
    {
        $this->apc = $apc;
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
        return $this->apc->get($id);
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
        $this->apc->put($session['id'], $session, $config['lifetime']);
    }

    /**
     * Delete a session from storage by a given ID.
     *
     * @param $id string           
     * @return void
     */
    public function delete ($id)
    {
        $this->apc->forget($id);
    }

}