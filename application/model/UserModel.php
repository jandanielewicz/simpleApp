<?php

/**
 * UserModel
 * Handles all the PUBLIC profile stuff. This is not for getting data of the logged in user, it's more for handling
 * data of all the other users. Useful for display profile information, creating user lists etc.
 */
class UserModel
{
    /**
     * Gets an array that contains all the users in the database. The array's keys are the user ids.
     * Each array element is an object, containing a specific user's data.
     * The avatar line is built using Ternary Operators, have a look here for more:
     * @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
     *
     * @return array The profiles of all users
     */
    public static function getPublicProfilesOfAllUsers()
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT user_id, user_name, user_email  FROM users";
        $query = $database->prepare($sql);
        $query->execute();

        $all_users_profiles = array();

        foreach ($query->fetchAll() as $user) {
            $all_users_profiles[$user->user_id] = new stdClass();
            $all_users_profiles[$user->user_id]->user_id = $user->user_id;
            $all_users_profiles[$user->user_id]->user_name = $user->user_name;
            $all_users_profiles[$user->user_id]->user_email = $user->user_email;
        }

        return $all_users_profiles;
    }

    /**
     * Gets a user's profile data, according to the given $user_id
     * @param int $user_id The user's id
     * @return mixed The selected user's profile
     */
    public static function getProfileOfUser($user_id)
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT user_id, user_name, user_email, wallet
                FROM users WHERE user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        $user = $query->fetch();

        if ($query->rowCount() != 1) {
            Session::add('feedback_fail', Dictionary::get('FEEDBACK_USER_DOES_NOT_EXIST'));
        }

        return $user;
    }

    /**
     * Gets a user's wallet
     * @return mixed The selected user's profile
     */
    public static function getUserWallet()
    {
        $user_id = Session::get('user_id');

        $database = Db::getFactory()->getConnection();

        $sql = "SELECT wallet
                FROM users WHERE user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        $user = $query->fetch();

        if ($query->rowCount() != 1) {
            Session::add('feedback_fail', Dictionary::get('FEEDBACK_USER_DOES_NOT_EXIST'));
        }

        return $user;
    }

    /**
     * Gets user data
     * @param $user_name
     * @return mixed
     */
    public static function getUserDataByUsername($user_name)
    {
        $database = Db::getFactory()->getConnection();

        $sql = "SELECT user_id, user_name, user_email, user_password_hash
                FROM users
                WHERE (user_name = :user_name OR user_email = :user_name)
                LIMIT 1";

        $query = $database->prepare($sql);

        $query->execute(array(':user_name' => $user_name));

        return $query->fetch();
    }
}
