<?php

class ArticleModel extends BaseModel
{
    private $catId;

    public function __construct ()
    {
        parent::__construct();
        $this->catId = (isset($_GET['cat']) && !empty(trim($_GET['cat']))) ? trim($_GET['cat']) : '';
    }

    public function setDelete ($tbl, $where)
    {
        $this->setQuery($tbl, $where);
    }

    public function setArticle ()
    {
        if ((int)  $_POST['id'] === 0) {

            if ((int) $_POST['cat_id'] === 0) {
                $_POST['cat_id'] = $this->setInsert ('categories', $this->getPostModel('categories'));
            }

            if ((int) $_POST['cat_id'] !== 0) {

                $_POST['id'] = $this->setInsert ('articles', $this->getPostModel('articles'));
            
                if ((int)  $_POST['id'] !== 0) {
                    $this->setInsert ('articles_map', [ $_POST['id'], $_POST['cat_id']]);
                }
            }
        } else {
            
            $this->setUpdate('articles', $this->getPostModel('articles', ['id' =>  $_POST['id']]));
        }

        return (empty($this->modelError)) ? true : false;
    }

    public function getArticles ()
    {
        $queryId = ($this->catId === '') ? 'articles' : 'articlesByCatId';
        $param = ($this->catId === '') ? [] : [$this->catId];

        return $this->getQuery("select", $queryId, $param);
    }

    public function getArticleCat ()
    {
        return ($this->catId !== '') ? $this->getQuery("select", 'articleCat', [$this->catId], true) : [];
    }

    public function getShopCart ($countList)
    {
        $idList = implode(',', array_keys($countList));
        $result = [
            'shopCountList' => $countList,
            'orderShopCart' => $this->getArticleShopCart($idList),
            'orderSum' => AppShopCart::getShopCartSum(),
        ];
        
        return $result;
    } 

    public function getArticleShopCart ($idList)
    {
        return $this->getQuery(vsprintf($this->mysqlConfig["select"]['articleShopCart'], [$idList]));
    }

    public function getArticleSearch ($strSearch)
    {
        return $this->getQuery(vsprintf($this->mysqlConfig["select"]['articleSearch'], ['%'.$strSearch.'%']));
    }
}
