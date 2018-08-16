<?php

/**
 * Session class
 *
 * create session if not set, closes session, etc
 */
class Session
{
    /**
     * starts the session
     */
    public static function init()
    {
        // if session empty, begin new session
        if (session_id() == '') {
            session_start();
        }
    }

    /**
     * sets value to a key
     *
     * @param mixed $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * gets value of a key of the session
     *
     * @param mixed $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];

            return $value;
        }
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public static function add($key, $value)
    {
        $_SESSION[$key][] = $value;
    }

    /**
     * delete session
     */
    public static function destroy()
    {
        session_destroy();
    }

    /**
     * update session_id in db
     *
     * @param  string $userId
     * @param  string $sessionId
     */
    public static function updateSessionId($userId, $sessionId = null)
    {
        $database = Db::getFactory()->getConnection();

        $sql = "UPDATE users
                SET session_id = :session_id
                WHERE user_id = :user_id";

        $query = $database->prepare($sql);
        $query->execute(array(':session_id' => $sessionId, ":user_id" => $userId));
    }

    /**
     * Checks if user is logged
     *
     * @return bool
     */
    public static function userIsLogged()
    {
        return self::get('user_logged') ? true : false;
    }
}
