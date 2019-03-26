<?php

class UserController extends BaseController
{
    private $ArticleModel;
    private $UserModel;

    public function __construct ()
    {
        $this->ArticleModel = new ArticleModel();
        $this->UserModel = new UserModel();
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
