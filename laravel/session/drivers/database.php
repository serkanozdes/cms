<?php

namespace Laravel\Session\Drivers;

use Laravel\Config;
use Laravel\Database\Connection;

class Database implements Driver, Sweeper
{

    /**
     * The database connection.
     *
     * @var Connection
     */
    private $connection;

    /**
     * Create a new database session driver.
     *
     * @param $connection Connection           
     * @return void
     */
    public function __construct (Connection $connection)
    {
        $this->connection = $connection;
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
        $session = $this->table()->find($id);
        
        if (! is_null($session)) {
            return array('id' => $session->id, 
                    'last_activity' => $session->last_activity, 
                    'data' => unserialize($session->data));
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
        if ($exists) {
            $this->table()
                ->where('id', '=', $session['id'])
                ->update(
                    array('last_activity' => $session['last_activity'], 
                            'data' => serialize($session['data'])));
        } else {
            $this->table()->insert(
                    array('id' => $session['id'], 
                            'last_activity' => $session['last_activity'], 
                            'data' => serialize($session['data'])));
        }
    }

    /**
     * Delete a session from storage by a given ID.
     *
     * @param $id string           
     * @return void
     */
    public function delete ($id)
    {
        $this->table()->delete($id);
    }

    /**
     * Delete all expired sessions from persistant storage.
     *
     * @param $expiration int           
     * @return void
     */
    public function sweep ($expiration)
    {
        $this->table()
            ->where('last_activity', '<', $expiration)
            ->delete();
    }

    /**
     * Get a session database query.
     *
     * @return Query
     */
    private function table ()
    {
        return $this->connection->table(Config::$items['session']['table']);
    }

}