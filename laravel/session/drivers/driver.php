<?php

namespace Laravel\Session\Drivers;

interface Driver
{

    /**
     * Load a session from storage by a given ID.
     *
     * If no session is found for the ID, null will be returned.
     *
     * @param $id string           
     * @return array
     */
    public function load ($id);

    /**
     * Save a given session to storage.
     *
     * @param $session array           
     * @param $config array           
     * @param $exists bool           
     * @return void
     */
    public function save ($session, $config, $exists);

    /**
     * Delete a session from storage by a given ID.
     *
     * @param $id string           
     * @return void
     */
    public function delete ($id);

}