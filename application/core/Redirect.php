<?php

/**
 * Redirect class
 */
class Redirect
{
    /**
     * To the last visited page before user was logged
     *
     * @param $path string
     */
    public static function toPreviousViewedPageAfterLogin($path)
    {
        header('location: http://' . $_SERVER['HTTP_HOST'] . '/' . $path);
    }

    /**
     * home page
     */
    public static function home()
    {
        header("location: " . Config::get('URL'));
    }

    /**
     * Follows to the given page
     *
     * @param $path string
     */
    public static function to($path)
    {
        header("location: " . Config::get('URL') . $path);
    }
}
