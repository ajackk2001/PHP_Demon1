<?php

class faq_group extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_faq_group';
        $this->key       = 'id';
        $this->wheres    = "1";
        $this->orders    = 'sort asc,id';
        $this->pageReNum = 10;
        $this->permCheck = true;
    }

    public function setKw($array)
    {
        if ($array['is_show'] == "0" || $array['is_show'] == "1") {
            $this->setWhere($this->tableName . ".is_show=" . $array['is_show']);
        }
    }

    public function add($array)
    {
        $img = upload::img("picfile", false);
        if (!empty($img)) {
            $array['pic'] = $img['url'];
        }
        $id = $this->addData($array);
        if ($array['is_top'] == 1) {
            $this->setOneTop($id);
        }

        return $id;
    }

    public function edit($array, $id)
    {
        $info = $this->getInfo($id);
        $img  = upload::img("picfile", false);
        if (!empty($img)) {
            if (is_file(ROOT_PATH . $info['pic'])) {
                unlink(ROOT_PATH . $info['pic']);
            }
            $array['pic'] = $img['url'];
        }
        $this->editData($array, $id);
        if ($array['is_top'] == 1) {
            $this->setOneTop($id);
        }
    }

    public function del($id)
    {
        $info = $this->getInfo($id);
        if (is_file(ROOT_PATH . $info['pic'])) {
            unlink(ROOT_PATH . $info['pic']);
        }

        $this->delete($id);
    }

    public function is_index_list()
    {
        global $webdb;

        return $webdb->getList("select * from " . $this->tableName . " where is_top = 1 && is_show = 1 order by " . $this->orders . " ");
    }

    public function setOneTop($id)
    {
        // global $webdb;
        // $sql = "UPDATE `" . $this->tableName . "` set is_top=0 WHERE id!=" . $id;
        // $webdb->query($sql);
    }
}
