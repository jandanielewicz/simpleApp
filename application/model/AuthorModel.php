<?php

/**
 * AuthorModel
 */
class AuthorModel
{
    /**
     * Get all authors (authors are just example data that the user has created)
     * @return array an array with several objects (the results)
     */
    public static function getAllAuthors()
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT author_id, author_name FROM authors";
        $query = $database->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }

    /**
     * Get a single author
     * @param int $author_id id of the specific author
     * @return object a single object (the result)
     */
    public static function getAuthor($author_id)
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT author_id, author_name from authors WHERE author_id =
         :author_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':author_id' => $author_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }


}
