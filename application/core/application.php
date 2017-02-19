<?php

class application {

    private $url_controller = null;
    private $controller = null;
    private $url_params = array();
    private $url_action = 'indexAction';
    private $action = null;

    public function __construct() {
        set_exception_handler(array('ErrorController', "getException"));
    }

    public function run() {
	
        $this->splitUrl();
        if (!$this->url_controller) {
            $page = new IndexController();
            $page->indexAction();
        } elseif ($this->url_controller == "EmployesController") {
            $arr = ( $this->action ) ? array_merge(array($this->action), $this->url_params) : $this->url_params;
            $this->controller = new $this->url_controller();
            call_user_func_array(array($this->controller, 'indexAction'), $arr);
        } elseif (file_exists(APP . 'controller/' . $this->url_controller . '.php')) {
            $this->controller = new $this->url_controller();
            if (method_exists($this->controller, $this->url_action)) {
                if (!empty($this->url_params)) {
                    call_user_func_array(array($this->controller, $this->url_action), $this->url_params);
                } else {
                    $this->controller->{$this->url_action}();
                }
            } else {
                if (strlen($this->url_action) == 0) {
                    $this->controller->indexAction();
                } else {
                    throw new Exception("Page not found", 404);
                }
            }
        } else {
            throw new Exception("Page not found", 404);
        }
    }

    private function splitUrl() {
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->url_controller = isset($url[0]) ? ucwords($url[0]) . 'Controller' : null;
            if (isset($url[1])) {
                $this->action = $url[1];
                $this->url_action = $url[1] . 'Action';
            }
            unset($url[0], $url[1]);
            $this->url_params = array_values($url);
        }
    }

}
