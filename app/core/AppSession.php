<?php

class AppSession
{
    public static function startSession ()
    {
        session_start();

        $_SESSION['user'] = (isset($_SESSION['user']) && !empty($_SESSION['user'])) ? $_SESSION['user'] : '';
        $_SESSION['userId'] = (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) ? $_SESSION['userId'] : '';
        $_SESSION['role'] = (isset($_SESSION['role'])) ? $_SESSION['role'] : '-1';
        $_SESSION['shopCart'] = (isset($_SESSION['shopCart']) && !empty($_SESSION['shopCart'])) ? $_SESSION['shopCart'] : '';
        $_SESSION['redirect'] = (isset($_SESSION['redirect'])) ? $_SESSION['redirect'] : '';
        $_SESSION['redirectMsg'] = (isset($_SESSION['redirectMsg'])) ? $_SESSION['redirectMsg'] : '';

    }

    public static function updateSession ($user)
    {
        $_SESSION['user'] = $user['email'];
        $_SESSION['userId'] = $user['id'];
        $_SESSION['role'] = $user['role'];
    }
    
    public static function getSessionUser ()
    {
        return (isset($_SESSION['user']) && !empty($_SESSION['user'])) ? $_SESSION['user'] : '';
    }

    public static function resetSession ()
    {
        session_destroy();
        session_regenerate_id(true);
        $_SESSION['user'] = '';
        $_SESSION['userId'] = '';
        $_SESSION['role'] = '-1';
        $_SESSION['shopCart'] = '';
        $_SESSION['redirect'] = '';
        $_SESSION['redirectMsg'] = '';
    }

    public static function isUsersession ()
    {
        $isUserSession = false;

        if (isset($_SESSION['user']) 
            && !empty($_SESSION['user']) 
            && isset($_SESSION['role']) 
            && $_SESSION['role'] !== '-1') 
        {
            $isUserSession = true;
        }

        return $isUserSession;
    }

    public static function setValues ($values)
    {
        if (!empty($values)) {
            foreach((array) $values as $key => $val) {
                $_SESSION[$key] = $val;
            }
        }
    }

    public static function hasValue ($key)
    {
        return (isset($_SESSION[$key]) && !empty($_SESSION[$key])) ? true : false;
    }

    public static function getValue ($key)
    {
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : '';
    }
}
