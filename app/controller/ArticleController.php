<?php

class ArticleController extends BaseController
{
    private $Model;

    public function __construct ()
    {
        $this->Model = new ArticleModel();

        $articleCat = $this->Model->getArticleCat();
        
        $this->setView([
            'pageTitle' => 'Kategorie / '.$articleCat['cat_name'],
            'articles' => $this->Model->getArticles(),
            'articleCat' => $articleCat,
        ]);
    }
}
