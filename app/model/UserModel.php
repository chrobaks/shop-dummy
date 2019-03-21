<?php

class UserModel extends BaseModel
{
    public $error;

    public function __construct ($mysqlConfig)
    {
        parent::__construct($mysqlConfig);
        $this->error = [];
    }

    public function getLoginUser ($user)
    {
        $result = $this->getQuery("select", 'loginUser', [$user['email']], true);
        $loginOk = false;

        if (!empty($result) && password_verify($user['pass'], $result['pass'])) {
            AppSession::updateSession($result);
            $loginOk = true;
        }
        
        return $loginOk;
    }

    public function getUser ($getSessUser = true)
    {
        if ($getSessUser) {
            $sessUser = AppSession::getSessionUser();
            $result = $this->getQuery("select", 'loginUser', [$sessUser], true);
        } else {
            $result = $this->getQuery("select", 'user');
        }
        
        return $result;
    }

    public function getUserOrder ()
    {
        $result = $this->getQuery("select", 'userOrder');
        
        return $result;
    }

    public function setUserOrder ($shopCart)
    {
        $setOK = false;

        if (!empty($_POST['payment_type']) && !empty($_SESSION['userId'])) {

            if ($userOrderId = $this->setInsert('user_order', [$_SESSION['userId'], $_POST['payment_type'], str_replace(',', '.', $shopCart['orderSum'])])) {

                $values = [];

                foreach($shopCart['shopCountList'] as $item) {
                    $item = $this->getColModel(
                        'user_order_article', 
                        ['article_id' => $item['id'],'article_price' => $item['article_price'] ,'amount' => $item['article_count']], 
                        ['user_order_id' => $userOrderId]
                    );
                    $values[] = "(".implode(',', array_values($item)).")";
                }

                $values = implode(',', $values);
                $this->setInsert('user_order_article', $values, true);
                
                $setOK = true;

            }
        }

        return $setOK;
    }
}
