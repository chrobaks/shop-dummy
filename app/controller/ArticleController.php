<?php

class ArticleController extends BaseController
{
    private $Model;

    public function __construct ()
    {
        $this->Model = new ArticleModel();
    }

    public function setCatArticles ()
    {
        $articleCat = $this->Model->getArticleCat();
        $this->setView([
            'pageTitle' => 'Kategorie / '.$articleCat['cat_name'],
            'articles' => $this->Model->getArticles(),
            'articleCat' => $articleCat,
        ]);
    }

    public function setSearch ()
    {
        $_POST = AppValidator::setValidation('articleSearch', $_POST);
        $articles = [];
            
        if (AppValidator::isValid()) {
            $articles = $this->Model->getArticleSearch($_POST['str_search']);
        }
        $this->setView([
            'pageTitle' => 'Produkt-Suche',
            'articles' => $articles,
        ]);
    }
}
