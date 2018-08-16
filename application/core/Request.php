<?php

/**
 * Class Request
 * Allows the access to $_GET, $_POST and $_COOKIE
 */
class Request
{
    /**
     * Gets/returns the value of a specific key of the POST super-global.
     * Request::post('key') = $_POST['key']
     *
     * @param mixed $key key
     * @return mixed the key's value or nothing
     */
    public static function post($key)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
    }

    /**
     * gets value of a key from $_GET
     * @param mixed $key
     * @return mixed value
     */
    public static function get($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
    }

    /**
     * gets value of a key from $_COOKIE
     * @param mixed $key
     * @return mixed value or nothing
     */
    public static function cookie($key)
    {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }
    }
}
