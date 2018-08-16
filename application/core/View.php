<?php

/**
 * Class View
 */
class View
{
    /**
     * renders the view
     * $this->view->render('index/action')
     *
     * @param string $filename
     * @param array $data
     */
    public function render($filename, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        require Config::get('PATH_VIEW') . '_templates/header.php';
        require Config::get('PATH_VIEW') . $filename . '.php';
        require Config::get('PATH_VIEW') . '_templates/footer.php';
    }


    /**
     * renders the feedback messages
     */
    public function renderMessages()
    {
        // echo out the feedback messages
        // $_SESSION["feedback_ok"] and $_SESSION["feedback_fail"]
        require Config::get('PATH_VIEW') . '_templates/feedback.php';

        // delete these outdated messages
        Session::set('feedback_ok', null);
        Session::set('feedback_fail', null);
    }

    /**
     * Checks if the passed string is the active controller.
     *
     * @param string $filename
     * @param string $navigationController
     *
     * @return bool
     */
    public static function checkForActiveController($filename, $navigationController)
    {
        $splitFilename = explode("/", $filename);
        $activeController = $splitFilename[0];

        if ($activeController == $navigationController) {
            return true;
        }

        return false;
    }

    /**
     * Checks if the passed string is the currently active controller/action
     *
     * @param string $filename
     * @param string $navigationAction
     *
     * @return bool
     */
    public static function checkForActiveAction($filename, $navigationAction)
    {
        $splitFilename = explode("/", $filename);
        $active_action = $splitFilename[1];

        if ($active_action == $navigationAction) {
            return true;
        }

        return false;
    }

    /**
     * Checks if the passed string is the currently active controller and controller/action
     *
     * @param string $filename
     * @param string $navigationControllerAndAction
     *
     * @return bool
     */
    public static function checkForActiveControllerAndAction($filename, $navigationControllerAndAction)
    {
        $splitFilename = explode("/", $filename);
        $activeController = $splitFilename[0];
        $active_action = $splitFilename[1];

        $splitFilename = explode("/", $navigationControllerAndAction);
        $navigationController = $splitFilename[0];
        $navigationAction = $splitFilename[1];

        if ($activeController == $navigationController
            AND $active_action == $navigationAction
        ) {
            return true;
        }

        return false;
    }

    /**
     * Converts characters to HTML entities
     * This is important to avoid XSS attacks, and attempts to inject malicious code in your page.
     *
     * @param  string $str The string.
     * @return string
     */
    public function encodeHTML($str)
    {
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }
}
