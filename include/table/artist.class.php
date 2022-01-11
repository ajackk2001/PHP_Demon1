<?php

class artist extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_artist';
        $this->key       = 'id';
        $this->keys      = 'id';
        $this->wheres    = "1";
        $this->orders    = 'sort asc,newsdt desc,id';
        $this->pageReNum = 10;
    }

    public function setKw($array)
    {
        if ($array['keywords']) {
            $this->setWhere("title like '%" . $array['keywords'] . "%'");
        }
        if ($array['is_show'] == "0" || $array['is_show'] == "1") {
            $this->setWhere($this->tableName . ".is_show=" . $array['is_show']);
        }
    }

    public function add($array)
    {
        $img = upload::img("picfile", false);
        if (!empty($img)) {
            $array['pic'] = $img['url'];
            // $array['pic']=$img['surl'];
        }
        $img2 = upload::img("product_banner", false);
        if (!empty($img2)) {
            $array['product_banner'] = $img2['url'];
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
            $small_pic = getSmallPic($info['pic']);
            if (is_file(ROOT_PATH . $small_pic)) {
                unlink(ROOT_PATH . $small_pic);
            }
            if (is_file(ROOT_PATH . $info['pic'])) {
                unlink(ROOT_PATH . $info['pic']);
            }
            $array['pic'] = $img['url'];
        }
        $img2 = upload::img("product_banner", false);
        if (!empty($img2)) {
            if (is_file(ROOT_PATH . $info['product_banner'])) {
                unlink(ROOT_PATH . $info['product_banner']);
            }
            $array['product_banner'] = $img2['url'];
        }

        $this->editData($array, $id);
        if ($array['is_top'] == 1) {
            $this->setOneTop($id);
        }
    }

    public function del($id)
    {
        $info      = $this->getInfo($id);
        $small_pic = getSmallPic($info['pic']);
        if (is_file(ROOT_PATH . $small_pic)) {
            unlink(ROOT_PATH . $small_pic);
        }
        if (is_file(ROOT_PATH . $info['pic'])) {
            unlink(ROOT_PATH . $info['pic']);
        }
        if (is_file(ROOT_PATH . $info['pic2'])) {
            unlink(ROOT_PATH . $info['pic2']);
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

    public function getPageData($page = null)
    {
        $this->setKw(['is_show' => 1]);
        $this->pageReNum = 10;
        $this->p         = isset($page) ? $page : '1';
        $list            = $this->getList();

        return $list;
    }
}
