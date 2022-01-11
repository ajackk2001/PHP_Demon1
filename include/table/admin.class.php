<?php

class admin extends getList
{
    public $errMsg = '';

    public function __construct()
    {
        $this->tableName = '_sys_admin';
        $this->key       = $this->tableName . '.id';
        $this->wheres    = '1';
        $this->orders    = $this->tableName . '.id desc';
        $this->pageReNum = 10;
    }

    public function add($array)
    {
        global $webdb;
        $userAry = $webdb->getValue("select * from " . $this->tableName . " where login_name = '" . trim($array['login_name']) . "'");
        if (!$userAry['id']) {
            $array['login_pass'] = md5($array['login_pass']);
            $id                  = $this->addData($array);

            return $id;
        }
    }

    public function edit($array, $id)
    {
        global $webdb;
        $userAry = $webdb->getValue("select * from " . $this->tableName . " where login_name = '" . trim($array['login_name']) . "' and id!=" . $id);
        if (!$userAry['id']) {
            if ($array['login_pass']) {
                $array['login_pass'] = md5($array['login_pass']);
            } else {
                unset($array['login_pass']);
            }
            $this->editData($array, $id);

            return '修改帳號成功';
        } else {
            return "登入帳號重覆!";
        }
    }

    public function getList()
    {
        $this->permCheck   = false;
        $this->fieldList   = $this->tableName . '.*,gp.name as gp_name';
        $this->wheres      = $this->wheres . " and " . $this->tableName . ".gpid=gp.id";
        $this->groupby     = $this->key;
        $this->exTableName = '_sys_group as gp' . ($_SESSION['ADMIN_GROUP'] == 10 ? ',_web_category as c' : '');

        return $this->getArray();
    }
}
