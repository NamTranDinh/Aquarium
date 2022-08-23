<?php
class App {
    protected $controller = 'DashboardController';
    protected $action     = 'index';
    protected $param      = [];

    public function __construct() {
        if(isset($_REQUEST['controller'])){
            $controllerName = ucfirst(strtolower($_REQUEST['controller'])) . 'Controller';
            if(file_exists("../../controllers/${controllerName}.php")){
                $this->controller = $controllerName;
            }
        }
        require_once "../../controllers/".$this->controller.".php";
        if(isset($_REQUEST['action'])){
            if(method_exists($this->controller, $_REQUEST['action'])){
                $this->action = $_REQUEST['action'];
            }
        }
        call_user_func_array([new $this->controller, $this->action], $this->param);
    }
}