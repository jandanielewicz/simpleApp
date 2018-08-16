<?php

class ArticleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * /article/index
     */
    public function index()
    {
        $this->View->render('article/index', array(
            'articles' => ArticleModel::getAllArticles()
        ));
    }

    public function view($article_id)
    {
        $user_id = Session::get('user_id');

        $article = ArticleModel::getArticle($article_id); // without content
        // checking if price = 0 or already in collection (bought)
        if ((int)$article->price == 0 || ArticleModel::checkIfArticleInUserCollectionByUserId($article_id, $user_id)) {
            $article = ArticleModel::getArticle($article_id, true);
        }

        $this->View->render('article/view', array(
            'article' => $article
        ));
    }


    /**
     * /article/buy
     */
    public function buy()
    {
        $user_id = Session::get('user_id');

        $checkIfAlreadyBought = ArticleModel::checkIfArticleInUserCollectionByUserId(Request::post('article_id'), $user_id);
        if ($checkIfAlreadyBought) {
            Redirect::to('article');
            exit;
        }

        $user = UserModel::getProfileOfUser($user_id);
        $wallet = $user->wallet;
        $articlePrice = ArticleModel::getArticlePrice(Request::post('article_id'));

        // if there is no cash in wallet, notify
        if ($wallet < $articlePrice) {
            Session::add('feedback_fail', Dictionary::get('FEEDBACK_ARTICLE_INSUFFICIENT_FUNDS'));
            Redirect::to('article');
            exit;
        }

        // decrease wallet
        $newWalletAmount = $wallet - $articlePrice;

        ArticleModel::buyArticle(Request::post('article_id'), $user_id, $newWalletAmount);

        Redirect::to('article');
    }


}
