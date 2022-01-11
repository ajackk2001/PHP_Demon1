<?php
class classes extends getList {
		var $errMsg='';
		
        public function __construct(){
                $this->tableName = 'classes';
                $this->key = 'id';
                $this->wheres = '1';
                $this->orders = 'id';
                $this->pageReNum = 15;
        }
}
?>