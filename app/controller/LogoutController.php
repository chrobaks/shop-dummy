<?php

class LogoutController extends BaseController
{
    private $route;

    public function __construct ()
    {
        AppSession::resetSession();
        AppRedirect::setHeader(AppConfig::getConfig('view', ['url']).'?rt='.AppConfig::getConfig('route', ['fallback']));
    }

}