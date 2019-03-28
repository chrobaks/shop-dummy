<?php

/**
 * Set $appConfig
 * --------------------------------------------- 
 */
$appConfig = [];

/**
 * Set $appConfig route
 * --------------------------------------------- 
 */
$appConfig['route'] = [
    'public' => [
        'aboutUs',
        'article',
        'contact',
        'home',
        'login',
        'logout',
        'order',
        'shopcart',
        'signUp',
    ],
    'private' => [
        'payment',
        'profil',
    ],
    'admin' => [
        'shop',
        'user',
    ],
    'redirect' => [
        'payment' => 'login'
    ],
    'publicFallBack' => [
        'login',
        'signUp'
    ],
    'shopFallBack' => [
        'payment',
        'order'
    ],
    'fallback' => 'home',
];

/**
 * Set $appConfig view
 * --------------------------------------------- 
 */
$appConfig['view'] = [
    'url' => 'http://localhost/shop-dummy/index.php',
    'title' => 'NetCoDev / SHOP-Dummy',
    'appTpl' => 'app.tpl'
];

/**
 * Set $appConfig view
 * --------------------------------------------- 
 */
$appConfig['mysql'] = [
    'select' => [
        'categories' => 'SELECT DISTINCT cat.*, (SELECT count(*) FROM articles_map WHERE cat_id=cat.id) AS acount 
            FROM categories cat 
            JOIN articles_map am ON cat.id=am.cat_id
            ORDER BY cat.cat_name',
        'articlesByCatId' => "SELECT DISTINCT a.*, REPLACE(a.price, '.', ',') AS str_price FROM articles AS a 
            JOIN articles_map am ON a.id = am.article_id
            WHERE am.cat_id = ? ORDER BY a.article_name",
        'articles' => "SELECT DISTINCT *, REPLACE(price, '.', ',') AS str_price FROM articles",
        'articleSum' => "SELECT DISTINCT price * %d AS price FROM articles WHERE id = %d",
        'articleSearch' => "SELECT a.*, REPLACE(a.price, '.', ',') AS str_price, cat.cat_name, cat.id 
            FROM articles a
            JOIN articles_map am ON a.id=am.article_id
            JOIN categories cat ON cat.id=am.cat_id
            WHERE a.article_name LIKE '%s'
            ORDER BY cat.cat_name, a.article_name",
        'articleShopCart' => "SELECT a.*, REPLACE(a.price, '.', ',') AS str_price, cat.cat_name 
            FROM articles a
            JOIN articles_map am ON a.id=am.article_id
            JOIN categories cat ON cat.id=am.cat_id
            WHERE a.id IN ( %s )
            ORDER BY cat.cat_name, a.article_name",
        'articleCat' => "SELECT cat.*, (SELECT count(*) FROM articles_map WHERE cat_id=cat.id) AS acount 
            FROM categories cat 
            JOIN articles_map am ON cat.id=am.cat_id
            WHERE cat.id = ?
            LIMIT 1",
        'user' => "SELECT DISTINCT *, DATE_FORMAT(create_at, '%d.%m.%Y %h:%i') AS createAt FROM user ORDER BY role, email",
        'userOrder' => "SELECT DISTINCT user_order.id, user_order.payment_type, user_order.order_price, DATE_FORMAT(user_order.create_at, '%d.%m.%Y %h:%i') AS createAt
            FROM user_order
            WHERE user_order.user_id = ? ",
        'allOrder' => "SELECT DISTINCT user_order.id, user_order.payment_type, user_order.order_price, DATE_FORMAT(user_order.create_at, '%d.%m.%Y %h:%i') AS createAt, user.email 
            FROM user_order
            JOIN user ON user_order.user_id = user.id 
            ORDER BY user_order.id",
        'userOrderCount' => "SELECT DISTINCT count(user_order.id) AS count
            FROM user_order
            JOIN user ON user_order.user_id = ?",
        'loginUser' => "SELECT * FROM user WHERE email = ? LIMIT 1",
        'userById' => "SELECT * FROM user WHERE id = ? LIMIT 1",
        'catDelete' => "DELETE categories, articles_map, articles 
            FROM categories, articles_map, articles
            WHERE categories.id = ?
            AND categories.id = articles_map.cat_id
            AND articles_map.article_id = articles.id",
    ],
    'tables' => [
        'user_order' => ['user_id', 'payment_type', 'order_price'],
        'user_order_article' => ['user_order_id', 'article_id', 'article_price', 'amount'],
        'categories' => ['cat_name', 'description'],
        'articles' => ['article_name', 'article_description', 'price', 'image_url', 'delivery_status'],
        'articles_map' => ['article_id', 'cat_id'],
        'profil' => ['email'],
    ],
    'replace' => [
        'db' => [
            'price' => [',', '.'],
        ],
    ]
];

$appConfig['validation'] = [
    'login' => [
        'required' => ['email', 'pass', 'role']
    ],
    'signUp' => [
        'required' => ['email', 'pass']
    ],
    'resetPass' => [
        'required' => ['email']
    ],
    'articles' => [
        'required' => ['id', 'cat_id', 'article_name', 'article_description', 'price'],
        'optional' => ['image_url', 'delivery_status', 'cat_name', 'description'],
    ],
    'articleSearch' => [
        'required' => ['str_search'],
    ],
    'categories' => [
        'required' => ['cat_name', 'description'],
    ],
    'user_order' => [
        'required' => ['user_id', 'payment_type', 'order_price'],
    ],
    'user_order_article' => [
        'required' => ['user_order_id', 'article_id', 'article_price', 'amount'],
    ],
    'articles_map' => [
        'required' => ['article_id', 'cat_id'],
    ],
    'profil' => [
        'required' => ['id', 'email'],
    ],
];