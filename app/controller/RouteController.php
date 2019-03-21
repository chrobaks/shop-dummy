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
        $route = $this->getShopRoute($route);

        if ($route !== $this->config['route']['fallback']) {
            if (in_array($route, $this->config['route']['public'])) {
                $route = $this->getPublicRoute($route);
            } elseif (in_array($route, $this->config['route']['private'])) {
                $route = $this->getPrivateRoute($route);
            } elseif (in_array($route, $this->config['route']['admin'])) {
                $route = $this->getAdminRoute($route);
            } else {
                $route = $this->config['route']['fallback'];
                $this->resetAct();
            }
        }

        $this->route = $route;
    }

    public function setRequest ()
    {
        $this->request = (isset($_GET['rq']) && !empty(trim($_GET['rq']))) ? trim($_GET['rq']) : '';
    }

    private function setControllerAct ($controllerClass, $controllerInstance)
    {
        $act = (isset($_GET['act'])) ? 'set' . ucFirst(trim($_GET['act'])) : '';

        if ($act !== '') {
            
            $methodVariable = array($controllerInstance, $act);

            if (method_exists($controllerClass, $act) && is_callable($methodVariable, true, $callable_name)) {

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

        $this->setControllerAct($controllerClass, $controllerInstance);

        return $controllerInstance;
    }

    private function getAdminRoute ($route)
    {
        if (!AppSession::isUsersession() || AppSession::isUsersession() && $_SESSION['role'] !== '1') {
            $route = $this->config['route']['fallback'];
            $this->resetAct();
        }

        return $route;
    }

    private function getShopRoute ($route)
    {
        if ( ! AppSession::hasValue('shopCart') && in_array($route, $this->config['route']['shopFallBack'])) {
            $route = $this->config['route']['fallback'];
            $this->resetAct();
        } 

        return $route;
    }

    private function getPublicRoute ($route)
    {
        if (AppSession::isUsersession() && $route === 'login') {
            $route = $this->config['route']['fallback'];
            $this->resetAct();
        } 

        return $route;
    }

    private function getPrivateRoute ($route)
    {
        if (!AppSession::isUsersession()) {
            if (isset($this->config['route']['redirect'][$route])) {
                AppSession::setValues([
                    'redirect' => $route, 
                    'redirectMsg' => 'Bitte melden Sie sich an, um den Vorgang abzuschließen!'
                ]);
                $route = $this->config['route']['redirect'][$route];
                $this->resetAct();
            } else {
                $route = $this->config['route']['fallback'];
                $this->resetAct();
            }
        } 

        return $route;
    }

    private function resetAct ()
    {
        unset($_GET['act']);
    }
}
