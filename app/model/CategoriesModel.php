<?php

class CategoriesModel extends BaseModel
{
    public function __construct ()
    {
        parent::__construct();
    }

    public function getCategories ()
    {
        return $this->getQuery("select", "categories");
    }
}
