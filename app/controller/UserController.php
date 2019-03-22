<?php

class UserController extends BaseController
{
    private $ArticleModel;
    private $UserModel;

    public function __construct ($appConfig)
    {
        $this->ArticleModel = new ArticleModel($appConfig['mysql']);
        $this->UserModel = new UserModel($appConfig['mysql']);
    }

    public function setAllUser ()
    {
        $this->setView([
            'pageTitle' => 'Alle Benutzer',
            'pageAct' => 'allUser',
            'user' => $this->UserModel->getUser(false),
        ]);
    }

    public function setAllOrder ()
    {
        $this->setView([
            'pageTitle' => 'Benutzer-Bestellungen',
            'pageAct' => 'allOrder',
            'allOrder' => $this->UserModel->getUserOrder(),
        ]);
    }
}
