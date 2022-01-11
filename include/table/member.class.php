<?php

class member extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_member';
        $this->key       = 'id';
        $this->wheres    = "1";
        $this->orders    = 'id asc';
        $this->pageReNum = 20;
        $this->permCheck = false;
    }

    public function setKw($array)
    {
        if ($array['keywords']) {
            $this->setWhere("(fullname like '%" . $array['keywords'] . "%' or username like '%" . $array['keywords'] . "%' )");
        }
        if ($array['is_show'] == "0" || $array['is_show'] == 1) {
            $this->setWhere("is_show=" . $array['is_show']);
        }
    }

    public function register($array)
    {
    }

    public function forgetPassword($array)
    {
    }

    public function send_register_mail($array)
    {
    }

    public function getNoVerificationUser($username)
    {
        global $webdb;
        $sql = "select 
					* 
				from 
					" . $this->tableName . " 
				where 
                    username = '" . $username . "' 
                    &&
                    is_show =0
                    &&
                    type='web'
				LIMIT 1";
        $data = $webdb->getValue($sql);

        return $data;
    }

    public function checkUser($array)
    {
        global $webdb;
        $sql = "select 
					* 
				from 
					" . $this->tableName . " 
				where 
					username = '" . $array['username'] . "' 
				LIMIT 1";
        $data = $webdb->getValue($sql);
        if ($data['username'] != '') {
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }

        return $data;
    }

    public function checkUserEmail($array)
    {
        global $webdb;
        $sql = "select 
						* 
					from 
						" . $this->tableName . " 
					where 
						username = '" . $array['username'] . "' 
					LIMIT 1";
        $data = $webdb->getValue($sql);

        if ($data['username'] != '') {
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }

        return $data;
    }

    public function contentData()
    {
        global $webdb;
        $sql = "select 
					* 
				from 
					" . $this->tableName . " 
				where 
                    username = '" . $_SESSION['MEMBER_USER']['email'] . "' 
				&& 
					id = '" . $_SESSION['MEMBER_USER']['id'] . "'  LIMIT 1";

        return $webdb->getValue($sql);
    }

    public function login_google($array)
    {
        global $webdb;
        $sql = "select 
					* 
				from 
					" . $this->tableName . " 
				where 
					username = '" . $array['username'] . "' 
				&&
					type = 'Google'
				LIMIT 1";

        $data = $webdb->getValue($sql);

        if ($data['is_show'] == 1) {
            session_start();
            $_SESSION['MEMBER_USER']           = $data;
            $level                             = $webdb->getValue("select * from _web_member_level where id = '" . $data['level'] . "'");
            $_SESSION['MEMBER_USER']['rebate'] = $level['rebate'];

            return true;
        }

        return false;
    }

    public function login_facebook($array)
    {
        global $webdb;
        $sql = "select 
					* 
				from 
					" . $this->tableName . " 
				where 
					username = '" . $array['username'] . "' 
				&&
					type = 'Facebook'
				LIMIT 1";

        $data = $webdb->getValue($sql);

        if ($data['is_show'] == 1) {
            session_start();
            $_SESSION['MEMBER_USER']           = $data;
            $level                             = $webdb->getValue("select * from _web_member_level where id = '" . $data['level'] . "'");
            $_SESSION['MEMBER_USER']['rebate'] = $level['rebate'];

            return true;
        }

        return false;
    }

    public function login($array)
    {
        global $webdb;
        $sql = "select 
					* 
				from 
					" . $this->tableName . " 
				where 
					username = '" . $array['username'] . "' 
				&& 
					password = '" . md5($array['password']) . "' 
				&&
					is_show = '1'
				LIMIT 1";

        $data = $webdb->getValue($sql);

        if ($data['is_show'] == 1) {
            session_start();
            $_SESSION['MEMBER_USER'] = $data;

            return true;
        }

        return false;
    }

    public function add($array)
    {
        global $webdb;
        $array['insert_time'] = date('Y-m-d H:i:s');
        $array['password']    = md5($array['password']);

        $id = $this->addData($array);

        return $id;
    }

    public function edit($array, $id)
    {
        if ($array['pwd'] != '') {
            $array['password'] = md5($array['pwd']);
        }
        $this->editData($array, $id);
    }

    public function del($id)
    {
        //$this->delete($id);
    }
}
