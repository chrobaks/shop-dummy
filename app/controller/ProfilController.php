<?php

class ProfilController extends BaseController
{
    
    private $Model;

    public function __construct ($appConfig)
    {
        $this->Model = new UserModel($appConfig['mysql']);
        $this->setView([
            'page' => 'profil',
            'pageTitle' => 'Benutzer-Einstellungen',
            'profil' => $this->Model->getUser(),
        ]);
    }
}