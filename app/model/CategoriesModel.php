<?php

class CategoriesModel extends BaseModel
{
    public function __construct ($mysqlConfig)
    {
        parent::__construct($mysqlConfig);
    }

    public function getCategories ()
    {
        return $this->getQuery("select", "categories");
    }
}
