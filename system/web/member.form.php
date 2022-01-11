

<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">帳號</label>
    <div class="col-sm-10">
    <?=$info['username']?>
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">密碼</label>
    <div class="col-sm-10">
    <input type="password"  class="form-control" name="pwd" size="60">
  </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">姓名</label>
    <div class="col-sm-10">
    <input type="text"  class="form-control" name="name" size="60">
  </div>
</div>
<div class="form-group row">
  <label for="example-search-input" class="col-sm-2 col-form-label">生日</label>
  <div class="col-sm-10">
    <input type="date"  class="form-control" name="address" size="60">
  </div>
</div>
<div class="form-group row">
  <label for="example-search-input" class="col-sm-2 col-form-label">地址</label>
  <div class="col-sm-10">
    <input type="text"  class="form-control" name="address" size="60">
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-sm-2 col-form-label">性別</label>
  <div class="col-sm-10">
    <select name="gender" class="form-control" >
    <option value="男">男</option>
    <option value="女">女</option>
    </select>
    </div>
</div>
<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">是否啟用</label>
    <div class="col-sm-10">
    <label><input type="radio" name="is_show" value="0">否</label>&nbsp;&nbsp;
    <label><input type="radio" name="is_show" value="1" checked>是</label>
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
