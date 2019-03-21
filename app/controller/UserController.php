<?php

class UserController extends BaseController
{
    private $ArticleModel;
    private $UserModel;

    public function __construct ($appConfig)
    {
        $this->ArticleModel = new ArticleModel($appConfig['mysql']);
        $this->UserModel = new UserModel($appConfig['mysql']);

        $this->setView([
            'page' => 'user',
            'pageTitle' => 'Benutzer',
        ]);

        $this->setPostAction();
    }

    private function setPostAction ()
    {
        $act = (isset($_GET['act'])) ? $_GET['act'] : '';

        if ($act) {

            $this->setView([
                'pageTitle' => ($act === 'allOrder') ? 'Benutzer-Bestellungen' : 'Alle Benutzer',
                'pageAct' => $act,
            ]);

            if ($act === 'allUser') {
                $this->setView([
                    'user' => $this->UserModel->getUser(false),
                ]);
            } else {
                $this->setView([
                    'userOrder' => $this->UserModel->getUserOrder(),
                ]);
            }

        }
    }
}