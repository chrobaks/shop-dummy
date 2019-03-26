<?php

class ContactController extends BaseController
{
    
    public function __construct ()
    {
        $this->setView(['pageTitle' => 'Kontaktformular']);
    }
    
    public function setContact ()
    {
        $this->setView(['formMsg' => 'Deine Nachricht wurde erfolgreich versendet!']);
    }
}

