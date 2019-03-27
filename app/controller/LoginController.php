<?php

class LoginController extends BaseController
{
    private $Model;
    private $route;
    private $loginRedirect;

    public function __construct ()
    {
        $this->Model = new UserModel();
        $this->route = AppConfig::getConfig('view', ['url']);
        $this->loginRedirect = ($_SESSION['redirect'] !== '') ? AppConfig::getConfig('view', ['url']).'?rt='.$_SESSION['redirect'] : '';

        $this->setView([
            'pageTitle' => 'Kunden-Login',
        ]);
    }

    public function setLogin ()
    {
        $_POST = AppValidator::setValidation('login', $_POST);

        if (!empty($_POST)) {

            if (!AppValidator::isValid()) {
                $this->setView(['formMsg' => 'Die Logindaten waren nicht vollständig']);
            } else {

                if ($this->Model->getLoginUser($_POST)) {

                    if ($this->loginRedirect !== '') {
                        AppSession::setValues(['redirect' => '', 'redirectMsg' => '']);
                        $this->route = $this->loginRedirect;
                    }
                    
                    AppRedirect::setHeader($this->route);

                }else {
                    $this->setView(['formMsg' => 'Die Logindaten waren nicht korrekt']);
                }
            } 
        }
    }
}