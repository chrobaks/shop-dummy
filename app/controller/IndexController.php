<?php

class IndexController
{
    private static $instance;
    private $RouteController;
    private $View;
    private $CatModel;
    private $ArticleModel;
    private $UserModel;

    public function __construct ($appConfig) 
    {
        AppConfig::setConfig($appConfig);
        Validator::setConfig($appConfig['validation']);

        $this->RouteController = RouteController::get_instance();
        $this->View = BaseView::get_instance();
        $this->CatModel = new CategoriesModel();
        $this->ArticleModel = new ArticleModel();
        $this->UserModel = new UserModel();
    }

    public static function get_instance($appConfig)
    {
        if( ! isset(self::$instance)){self::$instance = new IndexController($appConfig);}

        return self::$instance;
    }

    public function setRouteController ()
    {
        $this->RouteController->setRoute();
        $this->RouteController->setRequest();

        if ($this->RouteController->isRequest()) {
            return false;
        } else {

            $Controller = $this->RouteController->getRouteController();

            $this->View->setView([
                "page" => $this->RouteController->getRoute(),
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

    public function setRequestController ()
    {
        $this->RouteController->getRequest();
    }

    public function getView ()
    {
        return $this->View->getView();
    }
}
