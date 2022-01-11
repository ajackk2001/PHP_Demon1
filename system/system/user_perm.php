
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

<?php
if ($_POST) {
    group_perm::update_permission($_POST);
    $altmsg='權限修改成功';
} else {
    if (empty($_GET['admin_id'])) {
        echo "<script>alert('沒有操作權限');location.href='index.php'</script>";
        exit;
    }
}

$admin=new admin();
$admin->permCheck=false;
$admin->setLimit(0, 1000);
$admin=$admin->getArray();

$permission=permission::getList();
$group_perm=new group_perm();
$group_perm->pageReNum=10000;
$tmpary=$group_perm->getAdminPerm($_GET['admin_id']);
$perm=array();
foreach ($tmpary as $ary) {
    $perm[$ary['perm_id']]=$ary;
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">權限管理</h4>
        </div>
    </div>
</div>
<form id="editForm" method="post" onsubmit="return checkForm(this)">
<div class="admininwrappert">
	<div class="row">
			<div class="col-12">
					<div class="card m-b-20">
							<div class="card-body">
							<div class="row">
								<div class="col-md-4">
										<div class="form-group row">
												<div class="col-sm-12">

<select name="admin_id"  class="form-control" onchange="window.location.href='<?php echo urlkill('admin_id')?>&admin_id='+this.value">
<?php foreach ($admin as $gp) {?>
<option <?php if ($_GET['admin_id']==$gp['id']) {
    echo 'selected';
}?> value="<?php echo $gp['id']?>"><?php echo $gp['real_name']?></option>
<?php }?>
</select>
												</div>
										</div>
								</div>
									<div class="col-md-4">
									<button type="submit" class="btn btn-primary waves-effect waves-light sub2" id="submitBtn" >修改</button>
									</div>
								</div>
								<p></p>
							
								<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
										<thead>
										<tr>
											<th ><label><input type="checkbox" id="menu_selectAll" value="1" onclick="power_selectAll('menu_selectAll','menu_item_')" > 選單</label></th>
											<th ><label><input type="checkbox" id="list_selectAll" value="1" onclick="power_selectAll('list_selectAll','list_')"> 列表</label></th>
											<th ><label><input type="checkbox" id="add_selectAll" value="1" onclick="power_selectAll('add_selectAll','add_')" > 新增</label></th>
											<th ><label><input type="checkbox" id="edit_selectAll" value="1" onclick="power_selectAll('edit_selectAll','edit_')" > 修改</label></th>
											<th ><label><input type="checkbox" id="delete_selectAll" value="1" onclick="power_selectAll('delete_selectAll','delete_')" > 刪除</label></th>
										</tr>
										</thead>
										<tbody>
<?php
$class = new section();
foreach (resetArray(0, $class->getList()) as $rs) {
    ?>
<tr>
<td><label><input type="checkbox" name="perm_id[]" pid="<?php echo $rs['parent_id']?>" id="menu_item_<?php echo $rs['id']; ?>_END" value="<?php echo $rs['id']; ?>" onclick="power_selectAll('menu_item_<?php echo $rs['id']; ?>_END','_item_<?php echo $rs['id']; ?>_END')" <?php if ($perm[$rs['id']]['perm_id']) {
        echo 'checked';
    } ?> ><?php echo $rs['indent']." ├─ ".$rs['name']; ?></label></td>
<td><?php if ($rs['Slist']=="0") {
        echo '&nbsp;';
    } else {?><label><input type="checkbox" onclick="menu_item_list_select(<?php echo $rs['id'];?>,'list')" id="list_item_<?php echo $rs['id'];?>_END" name="perm[<?php echo $rs['id'];?>][s_tag]" value="1" <?php if ($rs['Slist']=="0") {
        echo 'disabled="disabled"';
    }?> <?php if ($perm[$rs['id']]['s_tag']==1) {
        echo 'checked';
    }?> > 列表</label><?php } ?></td>
<td><?php if ($rs['Sadd']=="0") {
        echo '&nbsp;';
    } else {?><label><input type="checkbox" onclick="menu_item_list_select(<?php echo $rs['id'];?>,'add')" id="add_item_<?php echo $rs['id'];?>_END" name="perm[<?php echo $rs['id'];?>][a_tag]" value="1" <?php if ($perm[$rs['id']]['a_tag']==1) {
        echo 'checked';
    }?>> 新增</label><?php } ?></td>
<td><?php if ($rs['Sedit']=="0") {
        echo '&nbsp;';
    } else {?><label><input type="checkbox" onclick="menu_item_list_select(<?php echo $rs['id'];?>,'edit')" id="edit_item_<?php echo $rs['id'];?>_END" name="perm[<?php echo $rs['id'];?>][e_tag]" value="1" <?php if ($perm[$rs['id']]['e_tag']==1) {
        echo 'checked';
    }?>> 修改</label><?php } ?></td>
<td><?php if ($rs['Sdelete']=="0") {
        echo '&nbsp;';
    } else {?><label><input type="checkbox" onclick="menu_item_list_select(<?php echo $rs['id'];?>,'delete')" id="delete_item_<?php echo $rs['id'];?>_END" name="perm[<?php echo $rs['id'];?>][d_tag]" value="1" <?php if ($perm[$rs['id']]['d_tag']==1) {
        echo 'checked';
    }?>> 刪除</label><?php } ?></td>
</tr>
<?php
}?>
									</tbody>
								</table>

							</div>
					</div>
			</div> <!-- end col -->
	</div> <!-- end row -->
  
 </div>
 </form>

<script>
/*
function setSubCheck(val,checked){
	$('input[type=checkbox][pid='+val+'][name^=perm_id]').prop('checked',checked);
	$('input[type=checkbox][pid='+val+'][name^=perm_id]').each(function (){
		setSubCheck($(this).val(),$(this).prop('checked'));
	});
}
$('input[type=checkbox][name^=perm_id]').click(function (){
	setSubCheck($(this).val(),$(this).prop('checked'));
});
*/
function checkForm(form){
	var msg='';
	if(msg){
		alert(msg);
		return false;
	}else{
	    return true;
	}
}
function power_selectAll(select_name,input_name){
	
	if ($("input[id='"+select_name+"']").is(':checked')) $("input[id*='"+input_name+"']").prop("checked",true); 
	else $("input[id*='"+input_name+"']").prop("checked",false); 
	
	if(select_name.substr(0,10)=="menu_item_"){
		var allCheck=true;
		$('input[id*=menu_item_]').each(function (){
			if(!$(this).prop('checked')){
				allCheck=false;
			}
		});
		$("input[id='menu_selectAll']").prop("checked",allCheck);
		item_select("list",input_name,$("input[id='"+select_name+"']").prop('checked'));
		item_select("add",input_name,$("input[id='"+select_name+"']").prop('checked'));
		item_select("edit",input_name,$("input[id='"+select_name+"']").prop('checked'));
		item_select("delete",input_name,$("input[id='"+select_name+"']").prop('checked'));
	}
}
function menu_item_list_select(id,section){
	var menu_item_select=false;
	var list_name="list_item_"+id+"_END";
	var add_name="add_item_"+id+"_END";
	var edit_name="edit_item_"+id+"_END";
	var delete_name="delete_item_"+id+"_END";
	if($('input[id*='+list_name+']').prop('checked')) menu_item_select=true;
	if($('input[id*='+add_name+']').prop('checked')) menu_item_select=true;
	if($('input[id*='+edit_name+']').prop('checked')) menu_item_select=true;
	if($('input[id*='+delete_name+']').prop('checked')) menu_item_select=true;
	$("input[id*='menu_item_"+id+"_END']").prop("checked",menu_item_select);
	var menu_selectAll_status=$("input[id='menu_selectAll']").prop("checked");
	if(menu_selectAll_status!=menu_item_select){
		var allCheck=true;
		$('input[id*=menu_item_]').each(function (){
			if(!$(this).prop('checked')){
				allCheck=false;
			}
		});
		$("input[id='menu_selectAll']").prop("checked",allCheck);
	}
	item_action(section);
}
function item_action(section){
	var itme_allCheck=true;
	$('input[id*='+section+'_item_]').each(function (){
		if(!$(this).prop('checked')){
			itme_allCheck=false;
		}
	});
	$("input[id='"+section+"_selectAll']").prop("checked",itme_allCheck);
}
function item_select(section,end_str,current_select_status){
	var itme_allCheck=true;
	$('input[id*='+section+'_item_]').each(function (){
		if(this.id==(section+end_str)){
			if(!current_select_status){
				itme_allCheck=false;
			}
		}else{
			if(!$(this).prop('checked')){
				itme_allCheck=false;
			}
		}
	});
	$("input[id='"+section+"_selectAll']").prop("checked",itme_allCheck);
}

$(document).ready(function (){
	var allCheck=true;
	$('input[id*=menu_item_]').each(function (){
		if(!$(this).prop('checked')){
			allCheck=false;
		}
	});
	$("input[id='menu_selectAll']").prop("checked",allCheck);
	
	item_action("list");
	item_action("add");
	item_action("edit");
	item_action("delete");
});
</script>