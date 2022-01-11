
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">留言時間</label>
    <div class="col-sm-10">
    <?=$info['add_time']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">處理時間</label>
    <div class="col-sm-10">
    <?=$info['deal_time']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
    <?=$info['email']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">姓名</label>
    <div class="col-sm-10">
    <?=$info['name']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">電話</label>
    <div class="col-sm-10">
    <?=$info['phone']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">主旨</label>
    <div class="col-sm-10">
    <?=$info['subject']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">內容</label>
    <div class="col-sm-10">
    <?=$info['content']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">處理說明</label>
    <div class="col-sm-10">
    <textarea class="form-control" name="remark"></textarea>
  </div>
</div>

<script>
function checkForm(form){
	// var ckField,msg='';
	
	// // ckField=$("input[name=change_c_name]");
	// // if(ckField.val()==''){
	// // 	msg+='請輸入選單名稱\n';
	// // 	ckField.focus();
	// // }
	// if(msg){
	// 	alert(msg);
	// 	return false;
	// }else{
	//     return true;
	// }
}
function delfile(obj){
	if(confirm("確定要刪除圖檔嗎？")){
		$.ajax({
		   type: "POST",
		   url: "ajax/ajax_fun.php?do=del_file",
		   data: "cn=<?php echo $_GET['cn']?>&id=<?php echo $_GET['id'];?>&obj="+obj,
		   success: function(msg){
		     $("#"+obj).remove();
		   }
		});
	}
}
</script> 
