<?php

class HomeController extends BaseController
{
    public function __construct ($appConfig)
    {
        $this->setView(['pageTitle' => 'Startseite']);
        
        if (!empty($_SESSION['redirectMsg'])) {
            $this->setView(['pageText' => $_SESSION['redirectMsg']]);
            AppSession::setValues(['redirectMsg' => '']);
        }
    }
}