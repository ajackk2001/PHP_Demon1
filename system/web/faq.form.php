<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">分類</label>
    <div class="col-sm-10">
      <select class="form-control" name="category_id">
          <option value="">請選擇</option>
          <?php
          $category = $webdb->getList("select * from _web_faq_group order by sort,id");
          foreach ($category as $value) {
              echo '<option value="' . $value['id'] . '">' . $value['title'] . '</option>';
          }
          ?>
      </select>
    </div>
</div>
 
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">問題</label>
    <div class="col-sm-10">
        <input class="form-control" name="title" type="text" id="example-search-input">
    </div>
</div>
<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">答案</label>
    <div class="col-sm-10">
    <?php echo htmlEdit('content', $info['content'])?>
    <!-- <textarea class="form-control" name="content"></textarea> -->
    </div>
</div>

<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">排序</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" name="sort" value="100" size="10" onKeyPress="Check_num();" onBlur="Cls_event();"/>
    </div>
</div>
<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">是否上架</label>
    <div class="col-sm-10">
    <label><input type="radio" name="is_show" value="0">否</label>&nbsp;&nbsp;
    <label><input type="radio" name="is_show" value="1" checked>是</label>
    </div>
</div>
<script>
function checkForm(form){
	var ckField,msg='';
	
	ckField=$("input[name=title]");
	if(ckField.val()==''){
		msg+='請輸入標題\n';
		ckField.focus();
	}
	if(msg){
		alert(msg);
		return false;
	}else{
	    return true;
	}
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