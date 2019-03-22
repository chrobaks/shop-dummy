<?php

class AppShopCart
{
    public static function updateShopCart ($data, $updateAll = false)
    {
        if ($updateAll) {

            AppSession::setValues(['shopCart' => $data]);
            
        } else {

            $shopCart = $_SESSION['shopCart'];
            $articleExsist = false;
            
            if (AppSession::hasValue('shopCart')) {
                foreach ($shopCart as $index => $item) {
                    if ($item['id'] === $data['id']) {
                        $shopCart[$index]['article_count'] = (int) $data['article_count'];
                        $articleExsist = true;
                        break;
                    }
                }
            }
            if (!$articleExsist || empty($shopCart)) {
                if (empty($shopCart)) {
                    $shopCart = [
                        ['id' => $data['id'], 'article_count' => $data['article_count'], 'article_price' => $data['basic_price']]
                    ];
                } else {
                    $shopCart[] = ['id' => $data['id'], 'article_count' => $data['article_count'], 'article_price' => $data['basic_price']];
                }
            }

            AppSession::setValues(['shopCart' => $shopCart]);
        }
    }

    public static function deleteShopCartItem ($id)
    {
        
        if (AppSession::hasValue('shopCart')) {

            $result = [];

            foreach ($_SESSION['shopCart'] as $item) {
                if ($id !== $item['id']) {
                    $result[] = $item;
                }
            }

            AppSession::setValues(['shopCart' => $result]);
        }
    }

    public static function getShopCartList ()
    {
        $result = [];
        $items = (isset($_SESSION['shopCart']['id'])) ? [$_SESSION['shopCart']] : $_SESSION['shopCart'];

        foreach($items as $item) {
            $result[$item['id']] = $item['article_count'];
        }

        return $result;
    }
    
    public static function getShopCartSum ()
    {
        $result = 0;

        foreach($_SESSION['shopCart'] as $item) {
            $result += $item['article_count'] * $item['article_price'];
        }

        $result = str_replace('.', ',', $result);
        $decm = explode(',',$result);

        if (strlen($decm[1]) === 1) { $result .= "0"; }


        return $result;
    }
}
