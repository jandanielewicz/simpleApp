<?php

/**
 * ArticleModel
 */
class ArticleModel
{
    /**
     * Gets all articles
     * @return array
     */
    public static function getAllArticles()
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT
                article_id, content, shortDescription, price, category_id,
                author_id, category_id
                FROM articles
                ";
        $query = $database->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }


    /**
     * Get a single article
     * @param int $article_id id of article
     * @param bool $withContent
     * @return object a single object (the result)
     */
    public static function getArticle($article_id, $withContent = false)
    {
        $database = Db::getFactory()->getConnection();

        $contentString = '';
        if ($withContent == true) $contentString = 'content,';

        $sql = "SELECT article_id, $contentString shortDescription, price, category_id, author_id, category_id FROM articles WHERE article_id =
         :article_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':article_id' => $article_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }


    /**
     * Get a single article
     * @param int $author_id
     * @return object a single object (the result)
     */
    public static function getArticlesByAuthor($author_id)
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT article_id, content, shortDescription, price,
                    category_id, author_id, category_id
                FROM articles
                WHERE author_id = :author_id";
        $query = $database->prepare($sql);
        $query->execute(array(':author_id' => $author_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetchAll();
    }


    /**
     * Get a single article
     * @param int $category_id
     * @return object a single object (the result)
     */
    public static function getArticlesByCategory($category_id)
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT * FROM articles WHERE category_id = :category_id";
        $query = $database->prepare($sql);
        $query->execute(array(':category_id' => $category_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetchAll();
    }


    /**
     * @param int $article_id
     * @param int $user_id
     * @return object a single object (the result)
     */
    public static function checkIfArticleInUserCollectionByUserId($article_id, $user_id)
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT * FROM collections WHERE user_id = :user_id AND article_id = :article_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':article_id' => $article_id));

        if ($query->rowCount() == 1) {
            Session::add('feedback_ok', Dictionary::get('FEEDBACK_ARTICLE_ALREADY_BOUGHT'));
            return true;
        }

        return false;
    }


    /**
     * Set a collection (create a new one)
     * @param int $article_id article_id
     * @return bool feedback (was the collection created properly ?)
     */
    public static function getArticlePrice($article_id)
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT price FROM articles WHERE article_id = :article_id";
        $query = $database->prepare($sql);
        $query->execute(array(':article_id' => $article_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch()->price;
    }


    /**
     * Set a collection (create a new one)
     * @param int $article_id article_id
     * @param int $user_id
     * @param int $newWalletAmount
     * @return bool feedback (was the collection created properly ?)
     */
    public static function buyArticle($article_id, $user_id, $newWalletAmount)
    {
        if (!$article_id) {
            Session::add('feedback_fail', Dictionary::get('FEEDBACK_NO_SUCH_ARTICLE_ID'));
            return false;
        }

        $database = Db::getFactory()->getConnection();


        $sql = "UPDATE users SET wallet = :wallet WHERE user_id = :user_id";

        $query = $database->prepare($sql);
        $query->execute(array(':wallet' => $newWalletAmount, ":user_id" => $user_id));


        // insert into collection
        $database = Db::getFactory()->getConnection();

        $sql = "INSERT INTO collections (article_id, user_id) VALUES (:article_id, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':article_id' => $article_id, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            Session::add('feedback_ok', Dictionary::get('FEEDBACK_ARTICLE_BOUGHT'));
            return true;
        }

        // default return
        Session::add('feedback_fail', Dictionary::get('FEEDBACK_ARTICLE_BUY_FAILED'));
        return false;
    }

}
