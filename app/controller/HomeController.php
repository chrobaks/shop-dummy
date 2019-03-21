<?php

class HomeController extends BaseController
{
    public function __construct ($appConfig)
    {
        $this->setView(['pageTitle' => 'Startseite']);
    }
}