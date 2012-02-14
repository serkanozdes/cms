<?php

namespace Laravel\Session\Drivers;

class File implements Driver, Sweeper
{

    /**
     * The path to which the session files should be written.
     *
     * @var string
     */
    private $path;

    /**
     * Create a new File session driver instance.
     *
     * @param $path string           
     * @return void
     */
    public function __construct ($path)
    {
        $this->path = $path;
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
        if (file_exists($path = $this->path . $id)) {
            return unserialize(file_get_contents($path));
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
        file_put_contents($this->path . $session['id'], serialize($session), 
                LOCK_EX);
    }

    /**
     * Delete a session from storage by a given ID.
     *
     * @param $id string           
     * @return void
     */
    public function delete ($id)
    {
        if (file_exists($this->path . $id)) {
            @unlink($this->path . $id);
        }
    }

    /**
     * Delete all expired sessions from persistant storage.
     *
     * @param $expiration int           
     * @return void
     */
    public function sweep ($expiration)
    {
        foreach (glob($this->path . '*') as $file) {
            if (filetype($file) == 'file' and filemtime($file) < $expiration) {
                @unlink($file);
            }
        }
    }

}