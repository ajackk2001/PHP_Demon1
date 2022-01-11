<?php

class text extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_text';
        $this->key       = 'id';
        $this->wheres    = "1";
        $this->orders    = 'descno asc';
        $this->pageReNum = 10;
        $this->permCheck = true;
    }
}
