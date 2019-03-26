<?php

class OrderController extends BaseController
{
    private $ArticleModel;

    public function __construct ()
    {
        $this->ArticleModel = new ArticleModel();

        $this->setView(['pageTitle' => 'Bestellung / Warenkorb Artikel']);

        if (AppSession::hasValue('shopCart')) {
            $this->setView($this->ArticleModel->getShopCart(AppShopCart::getShopCartList()));
        }
    }

    public function setDeleteOrder ()
    {
        AppSession::setValues(['shopCart' => []]);
        AppSession::setValues(['redirectMsg' => 'Die Daten wurden erfolgreich gelöscht!']);
        AppRedirect::setHeader(AppConfig::getConfig('view', ['url']));
    }

    public function setDeleteArticle ()
    {
        AppShopCart::deleteShopCartItem($_GET['id']);

        if (AppSession::hasValue('shopCart')) {
            $this->setView(['formMsg' => 'Die Daten wurden erfolgreich gelöscht!']);
            $this->setView($this->ArticleModel->getShopCart(AppShopCart::getShopCartList()));
        } else {
            AppSession::setValues(['redirectMsg' => 'Der Warenkorb wurde erfolgreich gelöscht!']);
            AppRedirect::setHeader(AppConfig::getConfig('view', ['url']));
        }  
    }
}
