<?php

class AuthorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * /author/index
     */
    public function index()
    {
        $this->View->render('author/index', array(
            'authors' => AuthorModel::getAllAuthors()
        ));
    }

    public function view()
    {
        $this->View->render('author/view', array(
            'authors' => AuthorModel::getAllAuthors()
        ));
    }

    public function articles($author_id)
    {
        $this->View->render('author/articles', array(
            'articles' => ArticleModel::getArticlesByAuthor($author_id)
        ));
    }


}
