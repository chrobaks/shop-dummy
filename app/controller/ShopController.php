<?php

class ShopController extends BaseController
{
    
    private $Model;
    private $config;

    public function __construct ($appConfig)
    {
        $this->Model = new ArticleModel($appConfig['mysql']);
        $this->config = $appConfig;
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

    public function setAddArticle ()
    {
        if (isset($_POST['id'])) {

            $this->setArticleImage();

            $_POST = Validator::setValidation('articles', $_POST);

            if (Validator::isValid()) {

                $formMsg =  ($this->Model->setArticle()) 
                    ? 'Der Artikel wurde erfolgreich gespeichert!' 
                    : 'Der Artikel konnte nicht gespeichert werden!'; 

            } else {
                
                $formMsg = 'Keine Einträge gefunden für folgende Felder!'.implode(',', Validator::getError());
            }
            
            $this->setView(['formMsg' => $formMsg]);
        }

        $this->setView(['subPage' => 'articleNew', 'pageTitle' => 'Shop / Neues Produkt']);
    }

    public function setUpdateArticle ()
    {
        $_POST = Validator::setValidation('articles', $_POST);

        if (Validator::isValid()) {

            $formMsg =  ($this->Model->setArticle()) 
                ? 'Der Artikel wurde erfolgreich gespeichert!' 
                : 'Der Artikel konnte nicht gespeichert werden!';

        } else {
            
            $formMsg = 'Keine Einträge gefunden für folgende Felder!'.implode(',', Validator::getError());
        }
        
        $this->setView(['formMsg' => $formMsg]);
        $this->setCategory();
    }

    public function setDeleteCat ()
    {
        $this->Model->setDelete('catDelete', [$_POST['id']]);

        AppSession::setValues(['redirectMsg' => 'Die Daten wurden erfolgreich gelöscht!']);
        AppRedirect::setHeader($this->config['view']['url'], ['rt='.$this->config['route']['fallback']]);
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