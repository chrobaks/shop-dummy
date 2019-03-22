<?php

class ProfilController extends BaseController
{
    
    private $Model;

    public function __construct ($appConfig)
    {
        $this->Model = new UserModel($appConfig['mysql']);
        $this->setView([
            'pageTitle' => 'Benutzer-Einstellungen',
        ]);
    }

    public function setProfil ()
    {
        $this->setView([
            'pageTitle' => 'Benutzer-Einstellungen',
            'profil' => $this->Model->getUser(),
            'subPage' => 'profil',
        ]);
    }

    public function setOrder ()
    {
        $this->setView([
            'pageTitle' => 'Benutzer-Bestellungen',
            'userOrder' => $this->Model->getUserOrder(AppSession::getValue('userId')),
            'subPage' => 'order',
        ]);
    }
}