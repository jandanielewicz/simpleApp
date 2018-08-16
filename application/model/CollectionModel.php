<?php

/**
 * CollectionModel
 * This is basically a simple CRUD (Create/Read/Update/Delete) demonstration.
 */
class CollectionModel
{
    /**
     * Get all collections (collections are just example data that the user has created)
     * @return array an array with several objects (the results)
     */
    public static function getAllCollections()
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT collection_id, article_id, user_id FROM collections WHERE user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }

    /**
     * Get a single collection
     * @param int $collection_id id of the specific collection
     * @return object a single object (the result)
     */
    public static function getCollection($collection_id)
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT collection_id, article_id, user_id FROM collections WHERE user_id = :user_id AND collection_id = :collection_id
        LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id'), ':collection_id' => $collection_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

}
