<?php

class HomeController extends BaseController
{
    public function __construct ($appConfig)
    {
        $this->setView([
            'page' => 'home',
            'pageTitle' => 'Startseite',
        ]);
        if (!empty($_SESSION['redirectMsg'])) {
            $this->setView(['pageText' => $_SESSION['redirectMsg']]);
            AppSession::setValues(['redirectMsg' => '']);
        }
    }
}