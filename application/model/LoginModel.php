<?php

/**
 * LoginModel
 */
class LoginModel
{
    public static function login($userName, $userPassword)
    {
        if (empty($userName) OR empty($userPassword)) {
            Session::add('feedback_fail', Dictionary::get('FEEDBACK_USERNAME_OR_PASSWORD_FIELD_EMPTY'));
            return false;
        }

        // checks if user exists
        $result = self::validateAndGetUser($userName, $userPassword);

        if (!$result) {
            return false;
        }

        // login success
        self::setSuccessfulLoginIntoSession(
            $result->user_id, $result->user_name, $result->user_email
        );

        return true;
    }

    /**
     * checks password
     *
     * @param $userName
     * @param $userPassword
     *
     * @return bool|mixed
     */
    private static function validateAndGetUser($userName, $userPassword)
    {
        // get data of user by login
        $result = UserModel::getUserDataByUsername($userName);

        // check if user exists
        if (!$result) {

            // user does not exist, but we won't to give a potential attacker this details, so we just use a basic feedback message
            Session::add('feedback_fail', Dictionary::get('FEEDBACK_USERNAME_OR_PASSWORD_WRONG'));
            return false;
        }

        // checks pass with hash from db
        if (!password_verify($userPassword, $result->user_password_hash)) {
            Session::add('feedback_fail', Dictionary::get('FEEDBACK_USERNAME_OR_PASSWORD_WRONG'));
            return false;
        }

        return $result;
    }


    /**
     * Log out process
     */
    public static function logout()
    {
        $userId = Session::get('user_id');

        Session::destroy();
        Session::updateSessionId($userId);
    }

    /**
     * Writing into session
     *
     * @param $userId
     * @param $userName
     * @param $userEmail
     */
    public static function setSuccessfulLoginIntoSession($userId, $userName, $userEmail)
    {
        Session::init();
        session_regenerate_id(true);
        $_SESSION = array();

        Session::set('user_id', $userId);
        Session::set('user_email', $userEmail);
        Session::set('user_name', $userName);

        Session::set('user_logged', true);

        // update session id in database
        Session::updateSessionId($userId, session_id());

        // set session cookie manually
        setcookie(session_name(),
            session_id(),
            time() + Config::get('SESSION_RUNTIME'),
            Config::get('COOKIE_PATH'),
            Config::get('COOKIE_DOMAIN'),
            Config::get('COOKIE_SECURE'),
            Config::get('COOKIE_HTTP')
        );

    }


    /**
     * checks login state
     *
     * @return bool
     */
    public static function isUserLoggedIn()
    {
        return Session::userIsLogged();
    }
}
