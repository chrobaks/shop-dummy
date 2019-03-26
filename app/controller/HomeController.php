<?php

class HomeController extends BaseController
{
    public function __construct ()
    {
        $this->setView(['pageTitle' => 'Startseite']);
    }
}