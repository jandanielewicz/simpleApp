<?php

class CollectionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Authentication::checkAuthentication();
    }

    /**
     * /collection/index
     */
    public function index()
    {
        $this->View->render('collection/index', array(
            'collections' => CollectionModel::getAllCollections()
        ));
    }


}
