<?php

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * /index/index
     */
    public function index()
    {
        $this->View->render('index/index');
    }
}
