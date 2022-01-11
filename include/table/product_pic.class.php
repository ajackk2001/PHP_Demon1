<?php

class product_pic extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_product_pic';
        $this->key       = 'id';
        $this->wheres    = "1";
        $this->pageReNum = 10000;
        $this->orders    = 'sort asc,id desc';
        $this->permCheck = false;
    }

    public function setKw($array)
    {
        $this->setWhere("product_id  = '" . $array['product_id'] . "'");

        if ($array['is_show'] == "0" || $array['is_show'] == "1") {
            $this->setWhere("is_show=" . $array['is_show']);
        }
    }

    public function add($array)
    {
        $id = $this->addData($array);

        return $id;
    }

    public function edit($array, $id)
    {
        $this->editData($array, $id);
    }

    public function del($id)
    {
        $info = $this->getInfo($id);
        if (is_file(ROOT_PATH . $info['pic'])) {
            unlink(ROOT_PATH . $info['pic']);
        }
        $this->delete($id);
    }
}
