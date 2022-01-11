<?php

class shipping extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_shipping';
        $this->key       = 'id';
        $this->wheres    = "1";
        $this->pageReNum = 10;
        $this->permCheck = true;
    }
}
