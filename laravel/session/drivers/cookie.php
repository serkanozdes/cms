<?php

namespace Laravel\Session\Drivers;

use Laravel\Crypter;

class Cookie implements Driver
{

    /**
     * The name of the cookie used to store the session payload.
     *
     * @var string
     */
    const payload = 'session_payload';

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
        if (\Laravel\Cookie::has(Cookie::payload)) {
            $cookie = Crypter::decrypt(\Laravel\Cookie::get(Cookie::payload));
            
            return unserialize($cookie);
        }
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
        extract($config, EXTR_SKIP);
        
        $payload = Crypter::encrypt(serialize($session));
        
        \Laravel\Cookie::put(Cookie::payload, $payload, $lifetime, $path, 
                $domain);
    }

    /**
     * Delete a session from storage by a given ID.
     *
     * @param $id string           
     * @return void
     */
    public function delete ($id)
    {
        \Laravel\Cookie::forget(Cookie::payload);
    }

}