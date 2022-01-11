<?php

class order extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_order';
        $this->key       = 'id';
        $this->wheres    = "1";
        $this->orders    = 'id asc';
        $this->pageReNum = 10;
        $this->permCheck = true;
    }

    public function setKw($array)
    {
        // $this->setWhere(" pay_status= '100' ");
        if ($array['keywords']) {
            $this->setWhere("title like '%" . $array['keywords'] . "%'");
        }
        if ($array['user_id']) {
            $this->setWhere("user_id='" . $array['user_id'] . "'");
        }
        if ($array['pay_type']) {
            $this->setWhere("pay_type='" . $array['pay_type'] . "'");
        }
        if ($array['pay_status']) {
            $this->setWhere("pay_status='" . $array['pay_status'] . "'");
        }
    }

    public function getUserOrder($user_id, $p)
    {
        global $webdb;
        // echo "select * from " . $this->tableName . " where user_id = '" . $user_id . "' && pay_status = 100 order by " . $this->orders . " limit 1000";
        return $webdb->getList("select * from " . $this->tableName . " where user_id = '" . $user_id . "'  order by " . $this->orders . " limit 1000");
    }

    public function getOrderNumber($order_number)
    {
        global $webdb;
        //echo "select * from " . $this->tableName . " where order_number = '" . $order_number . "'  limit 1";
        return $webdb->getValue("select * from " . $this->tableName . " where order_number = '" . $order_number . "'  limit 1");
    }

    public function getOrderLogNumber($order_number)
    {
        global $webdb;
        //echo "select * from " . $this->tableName . " where order_number = '" . $order_number . "'  limit 1";
        return $webdb->getValue("select * from " . $this->tableName . " where log_order_number = '" . $order_number . "'  limit 1");
    }
}
