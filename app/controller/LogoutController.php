<?php

class LogoutController extends BaseController
{
    private $route;

    public function __construct ($appConfig)
    {
        AppSession::resetSession();
        AppRedirect::setHeader($appConfig['view']['url'], ['rt='.$appConfig['route']['fallback']]);
    }

}