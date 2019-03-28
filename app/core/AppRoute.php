<?php

class AppRoute
{
    private static $redirect = [
        'props' => []
    ];

    private static $route = [
        'controller' => '',
        'action' => ''
    ];

    private static $fallBack;
    private static $isRequest;

    public static function setRoute ()
    {
        self::setRouteProps();

        if (!self::$isRequest) {
            
            if (!self::setRouteValidation()) {
                AppRedirect::setHeader(AppConfig::getConfig('view', ['url']), self::$redirect['props']);
            }
        }

        return (!self::$isRequest) ? true : false;
    }

    public static function getRoute ()
    {
        return self::$route['controller'];
    }

    public static function getRouteAction ()
    {
        return self::$route['action'];
    }

    public static function getRouteController ()
    {
        $ControllerClass = ucfirst(self::$route['controller']).'Controller';
        $ControllerInstance = new $ControllerClass();

        self::setControllerAct($ControllerClass, $ControllerInstance);

        return $ControllerInstance;
    }

    public static function setRequest ()
    {
        AppRequest::setRequest(self::$route['controller']);
    }

    private static function setControllerAct ($controllerClass, $controllerInstance)
    {
        $act = (!empty(self::$route['action'])) ? 'set' . ucFirst(trim(self::$route['action'])) : '';

        if ($act !== '') {
            
            $methodVariable = array($controllerInstance, $act);

            if (method_exists($controllerClass, $act) && is_callable($methodVariable, true, $callable_name)) {

                $controllerInstance->{$act}();
    
            }
        }
    }

    private static function setRouteProps ()
    {
        self::$fallBack = AppConfig::getConfig('route', ['fallback']);
        self::$isRequest = false;
        
        $getParam = AppRequest::getRequestParam($_GET, ['rt', 'rq', 'act']);
        
        if ($getParam['rq'] !== '') {
            self::$route['controller'] = $getParam['rq'];
            self::$isRequest = true;
        } else {
            self::$route['controller'] = (!empty($getParam['rt'])) ? $getParam['rt'] : self::$fallBack;
            self::$route['action'] = $getParam['act'];
        }
    }

    private static function setRouteValidation ()
    {
        $controller = self::$route['controller'];
        $routes = ['shopFallBack', 'public', 'private', 'admin'];
        $configRoutes = AppConfig::getConfig('route');
        $isValid = true;

        if ($controller !==  self::$fallBack) {

            foreach($routes as $route) {
                if (in_array($controller, $configRoutes[$route])) {
                    $meth = 'set'.ucfirst($route).'Route';
                    if (!$isValid = self::{$meth}()) {
                        break;
                    }
                }
            }
        }
        
        return $isValid;
    }

    private static function setShopFallBackRoute ()
    {
        if ( ! AppSession::hasValue('shopCart')) {
            return false;
        } 

        return true;
    }

    private static function setAdminRoute ()
    {
        if (!AppSession::isUsersession() || AppSession::isUsersession() && AppSession::getValue('role') !== '1') {
            return false;
        }

        return true;
    }

    private static function setPublicRoute ()
    {
        if (AppSession::isUsersession() && in_array(self::$route['controller'], AppConfig::getConfig('route', ['publicFallBack']))) {
            return false;
        } 

        return true;
    }

    private static function setPrivateRoute ()
    {
        if (!AppSession::isUsersession()) {

            $redirect = AppConfig::getConfig('route', ['redirect', self::$route['controller']]);

            if (!empty($redirect)) {

                AppSession::setValues([
                    'redirect' => self::$route['controller'], 
                    'redirectMsg' => 'Bitte melden Sie sich an, um den Vorgang abzuschließen!'
                ]);

                self::$redirect['props'] = ['rt='.$redirect];
            }

            return false;

        } else {
            return true;
        }
    }

    private static function resetAct ()
    {
        unset($_GET['act']);
    }
}
