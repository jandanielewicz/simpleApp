<?php

/**
 * Class Application
 * The heart of the application
 */
class Application
{
    /** @var string Just the name of the controller's method, useful for checks inside the view ("where am I ?") */
    private $actionName;

    /** @var mixed Instance of the controller */
    private $controller;

    /** @var string Just the name of the controller, useful for checks inside the view ("where am I ?") */
    private $controllerName;

    /** @var array URL parameters, will be passed to used controller-method */
    private $parameters = array();


    /**
     * Start the application, analyze URL elements, call according controller/method or relocate to fallback location
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->splitUrl();

        $this->createControllerAndActionNames();

        // check if a controller exist
        if (file_exists(Config::get('PATH_CONTROLLER') . $this->controllerName . '.php')) {

            // load file with controller
            require Config::get('PATH_CONTROLLER') . $this->controllerName . '.php';
            $this->controller = new $this->controllerName();

            // check if method exist in the controller
            if (method_exists($this->controller, $this->actionName)) {
                if (!empty($this->parameters)) {
                    // call the method and pass arguments to it
                    call_user_func_array(array($this->controller, $this->actionName), $this->parameters);
                } else {
                    // if no parameters are given, just call the method without parameters, like $this->index->index();
                    $this->controller->{$this->actionName}();
                }
            }
        }
    }

    /**
     * split the URL
     */
    private function splitUrl()
    {
        if (Request::get('url')) {

            $url = trim(Request::get('url'), '/');
            $url = explode('/', $url);

            // put URL parts into according properties
            $this->controllerName = isset($url[0]) ? $url[0] : null;
            $this->actionName = isset($url[1]) ? $url[1] : null;

            // remove controller name and action name from the split URL
            unset($url[0], $url[1]);

            // rebase array keys and store the URL parameters
            $this->parameters = array_values($url);
        }
    }

    private function createControllerAndActionNames()
    {
        // use default controller from config if not exist
        if (!$this->controllerName) {
            $this->controllerName = Config::get('DEFAULT_CONTROLLER');
        }

        // check for action: no action given
        if (!$this->actionName OR (strlen($this->actionName) == 0)) {
            $this->actionName = Config::get('DEFAULT_ACTION');
        }

        // change controller name to class controller name
        $this->controllerName = ucwords($this->controllerName) . 'Controller';
    }
}
