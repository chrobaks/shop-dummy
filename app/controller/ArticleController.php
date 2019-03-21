<?php

class ArticleController extends BaseController
{
    
    private $Model;
    private $config;

    public function __construct ($appConfig)
    {
        $this->Model = new ArticleModel($appConfig['mysql']);
        $this->config = $appConfig;
        $this->setView([
            'page' => 'article'
        ]);

        $act = (isset($_GET['act'])) ? 'set' . ucFirst(trim($_GET['act'])) : '';

        if ($_SESSION['role'] !== '1' || $act === '') {

            $this->setUserArticles();

        } elseif ($_SESSION['role'] === '1' && $act !== '' && method_exists('ArticleController', $act)) {

            $this->{$act}();

        }
    }

    private function setUserArticles ()
    {
        $articleCat = $this->Model->getArticleCat();
        
        $this->setView([
            'pageTitle' => 'Kategorie / '.$articleCat['cat_name'],
            'articles' => $this->Model->getArticles(),
            'articleCat' => $articleCat,
        ]);
    }

    private function setAddArticle ()
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

        $this->setView(['subPage' => 'articleNew', 'pageTitle' => 'Neues Produkt']);
    }

    private function setUpdateArticle ()
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
        $this->setUserArticles();
    }

    private function setCatDelete ()
    {
        $this->Model->setDelete('catDelete', [$_POST['id']]);

        AppSession::setValues([
            'redirectMsg' => 'Die Daten wurden erfolgreich gelöscht!'
        ]);
        
        header('Location: ' . $this->config['view']['url'].'?rt='.$this->config['route']['fallback'] );
        exit();
    }

    private function setAdminArticles ()
    {
        $act = (isset($_GET['act'])) ? trim($_GET['act']) : '';

        if ($act !== '') {
            $this->Model->setDelete($act, [$_POST['id']]);
            AppSession::setValues([
                'redirectMsg' => 'Die Daten wurden erfolgreich gelöscht!'
            ]);
            $route = $this->config['view']['url'].'?rt='.$this->config['route']['fallback'];
            header('Location: ' . $route);
            exit();
        } else {
            $this->setArticle();
        }
    }

    private function setArticle ()
    {
        
        $cat = (isset($_GET['cat'])) ? trim($_GET['cat']) : '';
        

        if(isset($_POST['article_name'])) {

            if ($cat === '0') { 
                $this->setArticleImage(); 
            } 

            $_POST = Validator::setValidation('articles', $_POST);

            if (Validator::isValid()) {
                if ($this->Model->setArticle()) {
                    $formMsg = 'Der Artikel wurde erfolgreich gespeichert!';
                } else {
                    $formMsg = 'Der Artikel konnte nicht gespeichert werden!';
                }
            } else {
                
                $formMsg = 'Keine Einträge gefunden für folgende Felder!'.implode(',', Validator::getError());
            }
            
            $this->setView(['formMsg' => $formMsg]);
        }

        if ($cat === '0') {
            $this->setView(['subPage' => 'articleNew', 'pageTitle' => 'Neues Produkt']);
        } else {
            $articleCat = $this->Model->getArticleCat();
            $this->setView([
                'pageTitle' => 'Kategorie / '.$articleCat['cat_name'],
                'articles' => $this->Model->getArticles(),
                'articleCat' => $articleCat,
            ]);
        }
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