<?php

class ShopController extends BaseController
{
    
    private $Model;

    public function __construct ()
    {
        $this->Model = new ArticleModel();
    }

    public function setCategory ()
    {
        $articleCat = $this->Model->getArticleCat();
        
        $this->setView([
            'pageTitle' => 'Shop / Kategorie / '.$articleCat['cat_name'],
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

    public function setAddArticle ()
    {
        if (isset($_POST['id'])) {

            $this->setArticleImage();

            $_POST = AppValidator::setValidation('articles', $_POST);

            if (AppValidator::isValid()) {

                $formMsg =  ($this->Model->setArticle()) 
                    ? 'Der Artikel wurde erfolgreich gespeichert!' 
                    : 'Der Artikel konnte nicht gespeichert werden!'; 

            } else {
                
                $formMsg = 'Keine Einträge gefunden für folgende Felder!'.implode(',', AppValidator::getError());
            }
            
            $this->setView(['formMsg' => $formMsg]);
        }

        $this->setView(['pageTitle' => 'Shop / Neues Produkt']);
    }

    public function setUpdateArticle ()
    {
        $_POST = AppValidator::setValidation('articles', $_POST);

        if (AppValidator::isValid()) {

            $formMsg =  ($this->Model->setArticle()) 
                ? 'Der Artikel wurde erfolgreich gespeichert!' 
                : 'Der Artikel konnte nicht gespeichert werden!';

        } else {
            
            $formMsg = 'Keine Einträge gefunden für folgende Felder!'.implode(',', AppValidator::getError());
        }
        
        $this->setView(['formMsg' => $formMsg]);
        $this->setCategory();
    }

    public function setDeleteCat ()
    {
        $this->Model->setDelete('catDelete', [$_POST['id']]);

        AppSession::setValues(['redirectMsg' => 'Die Daten wurden erfolgreich gelöscht!']);
        AppRedirect::setHeader(AppConfig::getConfig('view', ['url']));
    }

    private function setArticleImage ()
    {
        $_POST['image_url'] = 'produkt.png';

        $fileUpload = FileHandler::setUpload();

        if (!empty($fileUpload['fileName']) && empty($fileUpload['error'])) {
            $_POST['image_url'] = $fileUpload['fileName'];
        }
    }
}