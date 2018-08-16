<?php

/**
 * Parent controller class
 */
class Controller
{
    public $View;

    public function __construct()
    {
        // initialize a session
        Session::init();

        // create view
        $this->View = new View();
    }
}
