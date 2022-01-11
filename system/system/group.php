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
    $group=new group();
    if ($_POST['id']) {
        $group->editData($_POST, $_POST['id']);
        go(urlkill('altmsg').'&altmsg='.urlencode('群組修改成功'));
    } else {
        unset($_POST['id']);
        $group->addData($_POST);
        go(urlkill('altmsg').'&altmsg='.urlencode('增加群組成功'));
    }
}
$group=new group();
$groupary=$group->getArray();
$pageCtrl=$group->getPageInfoHTML();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">群組管理</h4>
        </div>
    </div>
</div>

<div class="admininwrappert">
	<div class="row">
			<div class="col-12">
					<div class="card m-b-20">
							<div class="card-body">
							<form id="editForm" method="post" onsubmit="return checkForm(this)">
								<div class="row">
									<div class="col-md-4">
											<div class="form-group row">
													<label for="example-text-input" class="col-sm-4 col-form-label">群組名：</label>
													<div class="col-sm-8">
													<input type="hidden" name="id">
															<input class="form-control textstyle" type="text"  name="name" id="example-text-input" value="<?=$get['keywords']?>">
													</div>
											</div>
									</div>

									<div class="col-md-4">
											<div class="form-group">
													<button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn" >增加</button>
													<button type="reset" class="btn btn-primary waves-effect waves-light" style="display: none;" id="resetBtn" onclick="$(this).hide();$('#submitBtn').val('增加');" >取消</button>
											</div>
									</div>
								</div>
  						</form>
								<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
										<thead>
										<tr>
											<th>群組名</th>
											<th>操作 </th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($groupary as $gp) {?>
										<tr>
											<td><?php echo $gp['name'];?></td>
										
											<td>
											<a href="javascript:;" onclick='editAccFun(<?php echo jsonEncode($gp);?>)'>編輯</a><?php if ($gp['id']>1) {?> | <a href="javascript:;" onclick="delFun('group','<?php echo $gp['id'];?>')">刪除</a><?php }?>
											</td>
										</tr>
										<?php }?>
										</tbody>
								</table>

							</div>
					</div>
			</div> <!-- end col -->
	</div> <!-- end row -->
  <?php if (isset($pageCtrl)) {?>
  <div class="news-viewpage">
	<div class="page-right">&nbsp;</div>
	<div class="page-content"><?php echo $pageCtrl;?></div>
	<div class="page-left">&nbsp;</div>
  </div>
  <?php }?>
 </div>

	<script>
	function checkForm(form){
		var msg='';
		if(form.name.value=='') msg='請輸入群組名稱';
		if(msg){
			alert(msg);
			return false;
		}else return true;
	}
	function editAccFun(obj){
		$('#resetBtn').show();
		$('#submitBtn').text('修改');
		editFun(obj);
	}
	</script>
	