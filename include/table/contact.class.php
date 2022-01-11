<?php

class contact extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_contact';
        $this->key       = 'id';
        $this->wheres    = '1';
        $this->orders    = "add_time desc";
        $this->pageReNum = 10;
    }

    public function setKw($array)
    {
        //$this->setWhere("lang=".$_SESSION['langid']);
        if ($array['keywords']) {
            $this->setWhere("(name like '%" . $array['keywords'] . "%' or tel like '%" . $array['keywords'] . "%' or email like '%" . $array['keywords'] . "%')");
        }
        if ($array['is_deal'] == '1' || $array['is_deal'] == '0') {
            $this->setWhere("is_deal='" . $array['is_deal'] . "'");
        }
    }

    public function add($array)
    {
        $array['add_time'] = date("Y-m-d H:i:s");

        return $this->addData($array);
    }

    public function edit($array, $id)
    {
        if ($array['remark']) {
            $array['is_deal'] = 1;
        }
        if ($array['is_deal'] == 1) {
            $array['deal_time'] = date("Y-m-d H:i:s");
        } else {
            $array['deal_time'] = 'null';
        }
        $this->editData($array, $id);
    }
}
