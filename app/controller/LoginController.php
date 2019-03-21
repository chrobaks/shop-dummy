<?php

class LoginController extends BaseController
{
    private $Model;
    private $route;
    private $loginRedirect;

    public function __construct ($appConfig)
    {
        $this->Model = new UserModel($appConfig['mysql']);
        $this->route = $appConfig['view']['url'].'?rt='.$appConfig['route']['fallback'];
        $this->loginRedirect = ($_SESSION['redirect'] !== '') ? $appConfig['view']['url'].'?rt='.$_SESSION['redirect'] : '';

        $this->setView([
            'page' => 'login',
            'pageTitle' => 'Kunden-Login',
            'pageText' => (isset($_SESSION['redirectMsg']) && $_SESSION['redirectMsg'] !== '') ?  $_SESSION['redirectMsg'] : '',
        ]);

        $this->setLogin();
    }

    private function setLogin ()
    {
        $_POST = Validator::setValidation('login', $_POST);

        if (!empty($_POST)) {

            if (!Validator::isValid()) {
                $this->setView(['formMsg' => 'Die Logindaten waren nicht vollständig']);
            } else {

                if ($this->Model->getLoginUser($_POST)) {

                    if ($this->loginRedirect !== '') {
                        AppSession::setValues(['redirect' => '', 'redirectMsg' => '']);
                        $this->route = $this->loginRedirect;
                    }

                    header('Location: ' . $this->route);
                    exit();

                }else {
                    $this->setView(['formMsg' => 'Die Logindaten waren nicht korrekt']);
                }
            } 
        }
    }
}