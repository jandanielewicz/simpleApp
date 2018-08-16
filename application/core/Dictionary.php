<?php

class Dictionary
{
    private static $dictionary;

    public static function get($key, $data = null)
    {
        if (!$key) {
            return null;
        }

        if ($data) {
            foreach ($data as $var => $value) {
                ${$var} = $value;
            }
        }

        if (!self::$dictionary) {
            self::$dictionary = require('../application/config/texts.php');
        }

        if (!array_key_exists($key, self::$dictionary)) {
            return null;
        }

        return self::$dictionary[$key];
    }
}
