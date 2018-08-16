<?php

class Authentication
{
    public static function checkAuthentication()
    {
        Session::init();

        if (!Session::userIsLogged()) {
            Session::destroy();
            header('location: ' . Config::get('URL') .
                'login?redirect=' . urlencode($_SERVER['REQUEST_URI']));

            exit();
        }
    }
}
