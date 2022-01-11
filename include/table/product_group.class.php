<?php

class product_group extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_product_group';
        $this->key       = 'id';
        $this->wheres    = "1";
        $this->pageReNum = 10;
        $this->permCheck = true;
    }
}
