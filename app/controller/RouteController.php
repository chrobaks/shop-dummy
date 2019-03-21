<?php

class RouteController
{
    private static $instance;
    private $route;
    private $request;
    private $config;

    public function __construct ($config) 
    {
        $this->config = $config;
        $this->route = '';
        $this->request = '';
    }

    public static function get_instance($config)
    {
        if( ! isset(self::$instance)){
            self::$instance = new RouteController($config);
        }

        return self::$instance;
    }

    public function setRoute ()
    {
        $route = (isset($_GET['rt']) && !empty(trim($_GET['rt']))) ? trim($_GET['rt']) : $this->config['route']['fallback'];

        if ($route !== $this->config['route']['fallback']) {
            if (in_array($route, $this->config['route']['public'])) {
                if (AppSession::isUsersession() && $route === 'login') {
                    $route = $this->config['route']['fallback'];
                }
            } elseif (in_array($route, $this->config['route']['private'])) {
                if (!AppSession::isUsersession()) {
                    if (isset($this->config['route']['redirect'][$route])) {
                        AppSession::setValues([
                            'redirect' => $route, 
                            'redirectMsg' => 'Bitte melden Sie sich an, um den Vorgang abzuschließen!'
                        ]);
                        $route = $this->config['route']['redirect'][$route];
                    } else {
                        $route = $this->config['route']['fallback'];
                    }
                } 
            } elseif (in_array($route, $this->config['route']['admin'])) {
                if (!AppSession::isUsersession() || AppSession::isUsersession() && $_SESSION['role'] !== '1') {
                    $route = $this->config['route']['fallback'];
                }
            } else {
                $route = $this->config['route']['fallback'];
            }
        }

        $this->route = $route;
    }

    public function setRequest ()
    {
        $this->request = (isset($_GET['rq']) && !empty(trim($_GET['rq']))) ? trim($_GET['rq']) : '';
    }

    private function setControllerAct ($controllerInstance)
    {
        $act = (isset($_GET['act'])) ? 'set' . ucFirst(trim($_GET['act'])) : '';

        if ($act !== '') {
            
            $methodVariable = array($controllerInstance, $act);

            if (is_callable($methodVariable, true, $callable_name)) {

                $controllerInstance->{$act}();
    
            }
        }
    }

    public function getRoute ()
    {
        return $this->route;
    }

    public function getRequest ()
    {
        $RequestController = RequestController::get_instance($this->config);
        $RequestController->getRequest($this->request);
    }
    
    public function isRequest ()
    {
        return empty($this->request);
    }

    public function getRouteController ()
    {
        $controllerClass = ucfirst($this->route).'Controller';
        $controllerInstance = new $controllerClass($this->config);

        $this->setControllerAct($controllerInstance);

        return $controllerInstance;
    }
}
