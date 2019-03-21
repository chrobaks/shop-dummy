<?php

class ArticleController extends BaseController
{
    private $Model;

    public function __construct ($appConfig)
    {
        $this->Model = new ArticleModel($appConfig['mysql']);

        $articleCat = $this->Model->getArticleCat();
        
        $this->setView([
            'pageTitle' => 'Kategorie / '.$articleCat['cat_name'],
            'articles' => $this->Model->getArticles(),
            'articleCat' => $articleCat,
        ]);
    }
}
