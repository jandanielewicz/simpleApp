<?php


class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * /category/index
     */
    public function index()
    {
        $this->View->render('category/index', array(
            'categories' => CategoryModel::getAllCategories()
        ));
    }

    public function view($category_id)
    {
        $this->View->render('category/view', array(
            'articles' => ArticleModel::getArticlesByCategory($category_id)
        ));
    }

}
