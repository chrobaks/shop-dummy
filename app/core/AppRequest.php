<?php

class AppRequest
{
    private static $response = ['status'=>'error'];

    public static function setRequest ($request)
    {
        $method = 'set'.ucfirst($request);

        if (method_exists( 'AppRequest' ,$method)) {
            self::{$method}();
        } else {
            self::setResponse();
        }
    }

    
    private static function setShopCart ()
    {
        AppShopCart::updateShopCart($_POST);

        if (!empty($_SESSION['shopCart'])) {

            $Model = new ArticleModel();

            self::setResponse(array_merge([
                'callBack' => 'shopCart',
                'msg' => 'Der Warenkorb wurde aktualisiert!'
            ], $Model->getShopCart(AppShopCart::getShopCartList())));
        }

        self::setResponse();
    }

    private static function setUpdateOrder ()
    {
        AppShopCart::updateShopCart($_POST);
        
        self::setResponse([
            'status' => 'success',
            'callBack' => 'shopOrderMsg',
            'msg' => 'Die Daten wurde aktualisiert!',
            'orderSum' => AppShopCart::getShopCartSum(),
        ]);
    }

    private static function setUpdateShopCart ()
    {
        AppShopCart::updateShopCart($_POST['shopCart'], true);
        
        self::setResponse([
            'status' => 'success',
            'callBack' => 'shopCartMsg',
            'msg' => 'Der Warenkorb wurde aktualisiert!',
        ]);
    } 

    private static function setDeleteShopCart ()
    {
        AppShopCart::updateShopCart([], true);

        self::setResponse([
            'status' => 'success',
            'callBack' => 'shopCartDelete',
            'msg' => 'Der Warenkorb wurde geleert!',
        ]);
    } 

    private static function setResponse ($response = [])
    {
        if (!empty($response)) {
            echo json_encode($response);
        } else {
            echo json_encode(self::$response);
        }
        
        exit();
    }
}
