<?php

class LogoutController extends BaseController
{
    private $route;

    public function __construct ($appConfig)
    {
        AppSession::resetSession();
        header('Location: ' . $appConfig['view']['url'].'?rt='.$appConfig['route']['fallback']);
        exit();
    }

}