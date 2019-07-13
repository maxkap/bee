<?php

class Router {

    private $routes;
    
    private $config;

    public function __construct() {
        global $config;
        
        $this->config = $config;
        
        $this->routes = include ROOT . '/application/config/routes.php';
    }

    private function getURI() {
        $url = str_replace($this->config['base_path'], "", trim($_SERVER['REQUEST_URI']));
        
        $url = preg_replace('/\?.*?(?=#|\z)/', '', $url);
        
        return explode('/', $url);
    }

    public function run() {

        $segments = $this->getURI();

        $controller_name = $this->config['main_controller'];
        $action_name = $this->config['main_action'];

        if (!empty($segments[0])) {
            $controller_name = $segments[0];
        }

        if (!empty($segments[1])) {
            $action_name = $segments[1];
        }
        
        $controller_name = 'Controller_'. $controller_name;
        $action_name = 'Action_'. $action_name;
        

        if (file_exists(ROOT . '/application/controllers/' . $controller_name . '.php')) {
            include ROOT . '/application/controllers/' . $controller_name . '.php';
        } else {
            $this->run404();            
        }
        $controller = new $controller_name();
        
        if (method_exists($controller_name, $action_name)){
            $controller->$action_name();            
        }
        else{
            
            $this->run404();
        }
        

        
    }
    
    public function run404() {
        header('Location: ' . $this->config['base_path'] . '404');
        exit;
        
    }

}
