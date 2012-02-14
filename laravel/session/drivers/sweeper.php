<?php

namespace Laravel\Session\Drivers;

interface Sweeper
{

    /**
     * Delete all expired sessions from persistant storage.
     *
     * @param $expiration int           
     * @return void
     */
    public function sweep ($expiration);

}