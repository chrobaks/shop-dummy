<?php

class ProfilController extends BaseController
{
    
    private $Model;

    public function __construct ()
    {
        $this->Model = new UserModel();
        $this->setView([
            'pageTitle' => 'Benutzer-Einstellungen',
        ]);
    }

    public function setProfil ()
    {
        if (isset($_POST['id'])) {

            $_POST = AppValidator::setValidation('profil', $_POST);

            if (AppValidator::isValid()) {

                $formMsg = 'Die Daten konnten nicht gespeichert werden!';

                if ($this->Model->setUser()) {
                    AppSession::updateSession($this->Model->getUser(true, $_POST['id']));
                    $formMsg = 'Die Daten wurden erfolgreich gespeichert!';
                }

            } else {
                
                $formMsg = 'Keine Einträge gefunden für folgende Felder!'.implode(',', AppValidator::getError());
            }
            
            $this->setView(['formMsg' => $formMsg]);
        }

        $this->setView([
            'pageTitle' => 'Benutzer-Einstellungen',
            'profil' => $this->Model->getUser(),
        ]);

    }

    public function setOrder ()
    {
        $this->setView([
            'pageTitle' => 'Benutzer-Bestellungen',
            'userOrder' => $this->Model->getUserOrder(AppSession::getValue('userId')),
        ]);
    }
}