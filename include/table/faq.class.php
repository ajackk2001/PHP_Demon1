<?php

class faq extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_faq';
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
        if ($array['category_id']) {
            $this->setWhere("category_id = '" . $array['category_id'] . "'");
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
        $img2 = upload::img("picfile2", true, 280, 151, false);
        if (!empty($img2)) {
            $array['pic2'] = $img2['surl'];
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
        $img2 = upload::img("picfile2", true, 280, 151, false);
        if (!empty($img2)) {
            if (is_file(ROOT_PATH . $info['pic2'])) {
                unlink(ROOT_PATH . $info['pic2']);
            }
            $array['pic2'] = $img2['surl'];
        }

        $img_list = upload::multi_img("picfile_list", false, 0, 0);

        if ($img_list && count($img_list > 0)) {
            $_SESSION['img'] = $img_list;
            $news_pic        = new news_pic();
            foreach ($img_list as $val) {
                if ($val['url']) {
                    $news_pic->add([
                        "news_id" => $id,
                        "pic"     => $val['url'],
                        "is_show" => 1,
                        "sort"    => 100,
                    ]);
                }
            }
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

        return $webdb->getList("select * from " . $this->tableName . " where is_top = 1 && is_show = 1 order by " . $this->orders . " limit 3");
    }

    public function setOneTop($id)
    {
        global $webdb;
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
