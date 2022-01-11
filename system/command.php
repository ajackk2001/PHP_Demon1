<?php
include('common.inc.php');
/*
 * 提交后的处理页
 * 其中GET中的type为操作类型,可以让command对应的command.type,即各个类型的单独的处理文件中
 * GET中的action为操作,一般包括edit/delete等等
 * GET中的id为需要edit或者delete的记录的ID
 */

$id=intval($_GET['id']);
$type=$_GET['type'];
$action=$_GET['action'];
if($type){
	if(class_exists($type) && in_array($action,array('info','add','edit','del','sysSet'))){
		$class=new $type;
		switch($action){
			case 'info':
				dis($class->getInfo($id));
				exit;
				break;
			case 'add':
				$id=$class->add($_POST);
				echo "{id:".intval($id).",ok:'yes'}";
				exit;
				break;
			case 'edit':
				$result=$class->edit($_POST,$id);
				if ($_POST['DO']) {echo $result;exit;}
				break;
			case 'del':
				$class->del($id);
				break;
			case 'sysSet':
				$class->setVal($_GET['skey'],$_POST[$_GET['skey']]);
				break;
		}
	}else{
		include('command.'.$type.'.php');
	}
	echo "{ok:'yes'}";
	exit;
}
?>