<?php

class banner_footer extends getList
{
    public function __construct()
    {
        $this->tableName = '_web_banner_footer';
        $this->key       = 'id';
        $this->keys      = 'id';
        $this->wheres    = "1";
        $this->orders    = 'sort asc,id';
        $this->pageReNum = 10;
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
            // $array['pic']=$img['surl'];
        }

        $id = $this->addData($array);

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

        $this->editData($array, $id);
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

        $this->delete($id);
    }
}
