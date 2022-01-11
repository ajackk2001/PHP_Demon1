<?php

class order_product extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_order_product';
        $this->key       = 'id';
        $this->wheres    = "1";
        $this->orders    = 'id asc';
        $this->pageReNum = 20;
        $this->permCheck = false;
    }

    public function setKw($array)
    {
        if ($array['order_id']) {
            $this->setWhere("order_id = '" . $array['order_id'] . "'");
        }
        if ($array['product_code']) {
            $this->setWhere("product_code = '" . $array['product_code'] . "'");
        }
    }

    public function add($array)
    {
        $this->addData($array);
    }

    public function addProduct($array, $order_id)
    {
        $array['order_id'] = $order_id;
        $this->addData($array);
    }

    public function edit($array, $id)
    {
        $this->editData($array, $id);
    }

    public function del($id)
    {
        // $this->delete($id);
    }

    public function orderProductList($id)
    {
        $this->setKw(array('order_id' => $id));
        $this->pageReNum = 10000;

        return $this->getList();
    }
}
