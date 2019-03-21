<?php

class OrderController extends BaseController
{
    private $ArticleModel;

    public function __construct ($appConfig)
    {
        $this->ArticleModel = new ArticleModel($appConfig['mysql']);

        $this->setView([
            'page' => 'order',
            'pageTitle' => 'Bestellung / Warenkorb Artikel',
        ]);

        if (!empty($_SESSION['shopCart'])) {
            $this->setView($this->ArticleModel->getShopCart(AppSession::getShopCartList()));
        }
    }
}