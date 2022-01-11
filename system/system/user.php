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
$admin=new admin();
// $admin->debug=true;
// $admin->permCheck = true;
$userlist=$admin->getList();
$pageCtrl=$admin->getPageInfoHTML();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">帳號列表</h4>
        </div>
    </div>
</div>

<div class="admininwrappert">
	<div class="row">
			<div class="col-12">
					<div class="card m-b-20">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="button-items">
											<a href="index.php?type=system&do=userinfo" class="btn btn-primary btn-lg waves-effect waves-light">增加帳號</a>
										</div>
										<p></p>
									</div>
								</div>
								<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
										<thead>
										<tr>
											<th>帳號</th>
											<th>姓名</th>
											<th>權限群組</th>
											<th>是否啟用</th>
											<th>操作 </th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($userlist as $user) {?>
										<tr>
											<td class="N_title"><?php echo $user['login_name']?></td>
											<td><?php echo $user['real_name']?></td>
											<td><?php echo $user['gp_name']?></td>
											<td>
												<?php if ($user['id']>99) {?>
													<input type="checkbox" value="1" name="is_show" product_id="<?php echo $user['id'];?>" 
												<?php if ($user['is_show']==1) {
    echo "checked";
} ?>
											><?php }?>
</td>
											<td class="E_bd"><a href="index.php?type=system&do=userinfo&id=<?php echo $user['id']?>">編輯</a>
											| <a href="index.php?type=system&do=user_perm&admin_id=<?php echo $user['id']?>">私有權限</a>
											<?php if ($user['id']>99) {?> | <a href="javascript:;" onclick="delFun('admin','<?php echo $user['id']?>')">刪除</a><?php }?></td>
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
$(document).ready(function(){
	/*
	 *是否啟用
	*/
	$("input[name=is_show][type=checkbox]").click(function(){
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
		var is_show=0;
		if($(this).prop("checked"))is_show=1;
		var id=$(this).attr("product_id");
		if(op){
			$.ajax({
			   type: "POST",
			   url: "command.php?action=edit&type=admin&id="+id,
			   data: "is_show="+is_show,
			   success: function(msg){}
			}); 
		}
		
	});
}); 
</script>
