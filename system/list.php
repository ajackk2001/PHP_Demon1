<?php
    $className = $_GET['cn'];
    $classStr  = isset($_type[$className]['name']) ? $_type[$className]['name'] : "";
    if (!$classStr) {
        $classStr = unescape($_COOKIE['admin_menu_name']);
    }
    $classStr = str_replace("列表", "", $classStr);
    $class    = new $className();
    // $class->debug=true;
    $class->setKw($_GET);
    $class->p = isset($_GET['p']) ? $_GET['p'] : 1;
    if (isset($_GET['order'])) {
        $class->setOrder($_GET['order']);
    }
    $list = $class->getList();
    if (_WEB_ADMIN_LANG == "tw") {
        $pageCtrl = $class->getPageInfoHTML();
    } else {
        $pageCtrl = $class->getENPageInfoHTML();
    }
        $get = $_GET;
?>
<style>

/************ page ***************/
.news-viewpage {
	padding-bottom: 70px;
	height: 36px;
	padding-right: 30px;
}
.news-viewpage .page-left{float: right;/* background:url(../images/wan_43.jpg) no-repeat; */height: 32px;width:16px;border: 1px solid #ccc;border-right: none;border-radius: 3px 0 0px 3px;}
.news-viewpage .page-content{float: right;/* background:url(../images/wan_45.jpg) repeat-x; */height: 32px;font-size: 13px;line-height: 32px;border-bottom: 1px solid #ccc;border-top: 1px solid #ccc;}
.news-viewpage .page-right{float: right;/* background:url(../images/wan_47.jpg) no-repeat; */height: 32px;width: 16px;border: 1px solid #ccc;border-left: none;border-radius: 0px 3px 3px 0px;}
.news-viewpage a {
	display: inline;
	padding: 0px 8px;
	text-align: center;
	color: #000000;
	border-left: 1px solid #ccc;
	display: inline-block;
}
.news-viewpage a.BtnNum{padding: 0 12px}
.news-viewpage em.BtnNumSelect{padding: 0 12px}
.news-viewpage a.BtnEnd{
	border-right: 1px solid #ccc;
}
.page-content select{margin-left: 8px;border: none;background: #eeeeee;color: black;min-width: 35px;}
.news-viewpage a:hover{color: #FF9800;text-decoration: none;}
.news-viewpage  em {
	background: #0075a9;
	display: inline-block;
	padding: 0px 8px;
	text-align: center;
	color: #fff;
}
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title"><?php echo $classStr . (_WEB_ADMIN_LANG == "tw" ? "列表" : "");?></h4>
        </div>
    </div>
</div>
 <div class="admininwrappert">
  <?php include $_GET['type'] . '/' . $className . '.list.php';?>
  <?php if (isset($pageCtrl)) {?>
  <div class="news-viewpage">
	<div class="page-right">&nbsp;</div>
	<div class="page-content"><?php echo $pageCtrl;?></div>
	<div class="page-left">&nbsp;</div>
  </div>
  <?php }?>
 </div>


<script>
$('input[postType]').blur(function (){
	var param={};
	param[$(this).attr('name')]=$(this).val();
	$.post('command.php?action=edit&type='+$(this).attr('postType')+'&id='+$(this).attr('postId'),param,function (){ })
})
function filter() {
	url = 'index.php?type=<?php echo $_GET['type']; ?>&do=<?php echo $_GET['do'];?>&cn=<?php echo $_GET['cn'] . ($_GET['publication_id'] ? '&publication_id=' . $_GET['publication_id'] : '') . ($_GET['ntype'] ? '&ntype=' . $_GET['ntype'] : '') . ($_GET['lang'] ? '&lang=' . $_GET['lang'] : '');?>';
	
	data = [];
	$('.filter select, .filter input, .filter textarea').each(function(){
		val = $(this).val();
		name = $(this).attr('name');
		if(name && name!='undefined' && val && val!='*')data.push(name+"="+encodeURI(val));
	});
	str = data.join("&");
	if(str) url = url +"&"+str;
	location = url;
}
function ExcelExport() {
	url = 'export/export.php?cn=<?php echo $_GET['cn'] . ($_GET['ntype'] ? '&ntype=' . $_GET['ntype'] : '') . ($_GET['lang'] ? '&lang=' . $_GET['lang'] : '');?>';

	data = [];
	$('.filter select, .filter input, .filter textarea').each(function(){
		val = $(this).val();
		name = $(this).attr('name');
		if(name && name!='undefined' && val && val!='*')data.push(name+"="+encodeURI(val));
	});
	str = data.join("&");
	if(str) url = url +"&"+str;
	location = url;
}
</script>


<script>
$(document).ready(function(){
	
	/*
	 *是否啟用
	*/
	$("input[name=is_show][type=checkbox]").click(function(){
		var lock=$("#checkbox_lock").prop("checked");
		var op=false;
		if(lock){
			op=true;
		}else{
			if($(this).prop("checked")){
				if(confirm("確定啟用嗎？")){
					op=true;
				}else{
					op=false;
					$(this).prop("checked",false);
				}
			}else{
				if(confirm("確定不啟用嗎？")){
					op=true;
				}else{
					op=false;
					$(this).prop("checked",true);
				}
			}
		}
		var is_show=0;
		if($(this).prop("checked"))is_show=1;
		var id=$(this).attr("product_id");
		if(op){
			$.ajax({
			   type: "POST",
			   url: "command.php?action=edit&type=<?php echo $className;?>&id="+id,
			   data: "is_show="+is_show,
			   success: function(msg){}
			}); 
		}
		
	});

	/*
	 *首頁顯示
	*/
	$("input[name=is_top][type=checkbox]").click(function(){
		var lock=$("#checkbox_lock").prop("checked");
		var op=false;
		if(lock){
			op=true;
		}else{
			if($(this).prop("checked")){
				if(confirm("確定顯示首頁嗎？")){
					op=true;
				}else{
					op=false;
					$(this).prop("checked",false);
				}
			}else{
				if(confirm("確定不顯示首頁嗎？")){
					op=true;
				}else{
					op=false;
					$(this).prop("checked",true);
				}
			}
		}
		var is_top=0;
		if($(this).prop("checked"))is_top=1;
		var id=$(this).attr("product_id");
		if(op){
			$.ajax({
			   type: "POST",
			   url: "command.php?action=edit&type=<?php echo $className;?>&id="+id,
			   data: "is_top="+is_top,
			   success: function(msg){}
			}); 
		}
		
	});
	
}); 
</script>