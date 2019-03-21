<?php

class RequestController
{
    private static $instance;
    private $config;
    private $response;

    public function __construct ($config) 
    {
        $this->config = $config;
        $this->response = ['status'=>'error'];
    }

    public static function get_instance($config)
    {
        if( ! isset(self::$instance)){
            self::$instance = new RequestController($config);
        }

        return self::$instance;
    }

    public function getRequest ($request)
    {
        $method = 'set'.ucfirst($request);

        if (method_exists( 'RequestController' ,$method)) {
            $this->{$method}();
        } else {
            $this->setResponse();
        }
    }
    private function setShopCart ()
    {
        $countList = [];
        $Model = new ArticleModel($this->config['mysql']);
        AppSession::updateShopCart($_POST);

        if (!empty($_SESSION['shopCart'])) {
            $this->response = array_merge(['callBack' => 'shopCart'], $Model->getShopCart(AppSession::getShopCartList()));
        }
        $this->setResponse();
    }

    private function setUpdateOrder ()
    {
        $Model = new ArticleModel($this->config['mysql']);
        AppSession::updateShopCart($_POST);
        $this->response['status'] = 'success';
        $this->response['callBack'] = 'shopOrderMsg';
        $this->response['msg'] = 'Die Daten wurde aktualisiert!';
        $this->response['orderSum'] = $Model->getArticleSum(AppSession::getShopCartList());
        $this->setResponse();
    }

    private function setUpdateShopCart ()
    {
        AppSession::updateShopCart($_POST['shopCart'], true);
        $this->response['status'] = 'success';
        $this->response['callBack'] = 'shopCartMsg';
        $this->response['msg'] = 'Der Warenkorb wurde aktualisiert!';
        $this->setResponse();
    } 

    private function setDeleteShopCart ()
    {
        AppSession::updateShopCart([], true);
        $this->response['status'] = 'success';
        $this->response['callBack'] = 'shopCartDelete';
        $this->response['msg'] = 'Der Warenkorb wurde geleert!';
        $this->setResponse();
    } 

    private function setResponse ()
    {
        echo json_encode($this->response);
        exit();
    }
}
