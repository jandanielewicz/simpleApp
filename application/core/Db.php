<?php

/**
 * Class Db
 *
 * Use it like this:
 * $database = Db::getFactory()->getConnection();
 *
 */
class Db
{
    private static $factory;

    private $database;

    public static function getFactory()
    {
        if (!self::$factory) {
            self::$factory = new Db();
        }
        return self::$factory;
    }

    public function getConnection()
    {
        if (!$this->database) {
            try {
                $config = array(
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                );

                $this->database = new PDO(
                    Config::get('DB_TYPE') . ':host=' . Config::get('DB_HOST') . ';dbname=' .
                    Config::get('DB_NAME') . ';port=' . Config::get('DB_PORT') . ';charset=' . Config::get('DB_CHARSET'),
                    Config::get('DB_USER'),
                    Config::get('DB_PASS'),
                    $config
                );
            } catch (PDOException $e) {
                echo 'Database connection problems' . '<br>';
                echo 'Error code: ' . $e->getCode();
                exit;
            }
        }

        return $this->database;
    }
}
