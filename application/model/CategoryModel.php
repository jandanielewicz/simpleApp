<?php

/**
 * CategoryModel
 */
class CategoryModel
{
    /**
     * Get all categories (categories are just example data that the user has created)
     * @return array an array with several objects (the results)
     */
    public static function getAllCategories()
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT category_id, category_name  FROM categories";
        $query = $database->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }

    /**
     * Get a single category
     * @param int $category_id id of the specific category
     * @return object a single object (the result)
     */
    public static function getCategory($category_id)
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT category_id, category_name from categories WHERE category_id =
         :category_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':category_id' => $category_id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }


}
