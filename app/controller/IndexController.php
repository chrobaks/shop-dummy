<?php

class IndexController
{
    private static $instance;
    private $View;
    private $CatModel;
    private $ArticleModel;
    private $UserModel;

    public function __construct () 
    {
        $this->View = BaseView::get_instance();
        $this->CatModel = new CategoriesModel();
        $this->ArticleModel = new ArticleModel();
        $this->UserModel = new UserModel();
    }

    public static function get_instance()
    {
        if( ! isset(self::$instance)){self::$instance = new IndexController();}

        return self::$instance;
    }

    public function setRouteController ()
    {
        if (!AppRoute::setRoute()) {
            return false;
        } else {

            $Controller = AppRoute::getRouteController();

            $this->View->setView([
                "page" => AppRoute::getRoute(),
                "pageAction" => AppRoute::getRouteAction(),
                "cats" => $this->CatModel->getCategories()
            ]);
            $this->View->setView($Controller->getView());

            if (AppSession::isUsersession() && AppSession::getValue('role') === '0') {
                $this->View->setView(["userHasOrder" => $this->UserModel->getUserHasOrder(AppSession::getValue('userId'))]);
            }

            if (AppSession::hasValue('shopCart')) {
                $this->View->setView(["shopCart" => $this->ArticleModel->getShopCart(AppShopCart::getShopCartList())]);
            }

            if (AppSession::hasValue('redirectMsg')) {
                $this->View->setView(['pageText' => $_SESSION['redirectMsg']]);
                AppSession::setValues(['redirectMsg' => '']);
            }

            return true;
        }
    }

    public function setRequest ()
    {
        AppRoute::setRequest();
    }

    public function getView ()
    {
        return $this->View->getView();
    }
}
