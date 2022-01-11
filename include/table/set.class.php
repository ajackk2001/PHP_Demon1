<?php
class set extends getList {
	public function __construct(){
		$this->tableName = '_web_set';
		$this->key = 'id';
		$this->wheres = "1";
		$this->pageReNum = 10;
		$this->permCheck = true;
	}
	public function edit($array, $id)
	{
		$info = $this->getInfo($id);
		$img_logo  = upload::img("logo", false);
		if (!empty($img_logo)) {
			if (is_file(ROOT_PATH . $info['web_logo'])) {
				unlink(ROOT_PATH . $info['web_logo']);
			}
			$array['web_logo'] = $img_logo['url'];
		}
		$img_banner  = upload::img("banner", false);
		if (!empty($img_banner)) {
			if (is_file(ROOT_PATH . $info['index_banner'])) {
				unlink(ROOT_PATH . $info['index_banner']);
			}
			$array['index_banner'] = $img_banner['url'];
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
		if (is_file(ROOT_PATH . $info['pic2'])) {
				unlink(ROOT_PATH . $info['pic2']);
		}
		$this->delete($id);
	}

}
?>
