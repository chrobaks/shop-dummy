<?php

class AboutUsController extends BaseController
{
    public function __construct ()
    {
        $this->setView(['pageTitle' => 'Über Uns']);
    }

    public function setImpressum ()
    {
        $this->setView(['pageTitle' => 'Impressum']);
    }
    public function setPrivacy ()
    {
        $this->setView(['pageTitle' => 'Datenschutzrichtlinien']);
    }
    public function setAgb ()
    {
        $this->setView(['pageTitle' => 'Allgemeine Geschäftsbedingungen']);
    }
    public function setFaq ()
    {
        $this->setView(['pageTitle' => 'FAQ']);
    }
}