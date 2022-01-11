<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">名稱</label>
    <div class="col-sm-10">
        <input class="form-control" name="name" type="text" id="example-search-input">
    </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">身高體重</label>
    <div class="col-sm-10">
        <input class="form-control" name="size" type="text" id="example-search-input">
    </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">youtube</label>
    <div class="col-sm-10">
        <input class="form-control" name="youtube" type="text" id="example-search-input">
    </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">instagram</label>
    <div class="col-sm-10">
        <input class="form-control" name="instagram" type="text" id="example-search-input">
    </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">facebook</label>
    <div class="col-sm-10">
        <input class="form-control" name="facebook" type="text" id="example-search-input">
    </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">經紀公司</label>
    <div class="col-sm-10">
        <input class="form-control" name="company" type="text" id="example-search-input">
    </div>
</div>
<div class="form-group row">
    <label for="example-search-input" class="col-sm-2 col-form-label">個人網頁</label>
    <div class="col-sm-10">
        <input class="form-control" name="web" type="text" id="example-search-input">
    </div>
</div>
<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">簡述</label>
    <div class="col-sm-10">
    <textarea class="form-control" name="description"></textarea>
    </div>
</div>
<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">內容</label>
    <div class="col-sm-10">
    <?php echo htmlEdit('content', $info['content'])?>
    </div>
</div>
<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">大頭照圖片</label>
    <div class="col-sm-10">
    <input type="file" name="picfile" class="form-control" >

    </div>
</div>
<?php
    if (is_file(ROOT_PATH . $info['pic'])) {
        ?>

<div class="form-group row">
  <label for="example-text-input" class="col-sm-2 col-form-label">圖片顯示</label>
  <div class="col-sm-10">
    <div class="zoom-gallery">
      <a class="float-left" href="<?=ROOT_URL . $info['pic']?>"><img src="<?=ROOT_URL . $info['pic']?>" alt="" width="200"></a>

    </div>
  </div>
</div>
<?php
    }
    ?>

<div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">商品形象圖片</label>
    <div class="col-sm-10">
    <input type="file" name="product_banner" class="form-control" >

    </div>
</div>
<?php
    if (is_file(ROOT_PATH . $info['product_banner'])) {
        ?>

<div class="form-group row">
  <label for="example-text-input" class="col-sm-2 col-form-label">圖片顯示</label>
  <div class="col-sm-10">
    <div class="zoom-gallery">
      <a class="float-left" href="<?=ROOT_URL . $info['product_banner']?>"><img src="<?=ROOT_URL . $info['product_banner']?>" alt="" width="200"></a>

    </div>
  </div>
</div>
<?php
    }
    ?>
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
<!-- <div class="form-group row">
    <label for="example-text-input" class="col-sm-2 col-form-label">是否上架</label>
    <div class="col-sm-10">
    <label><input type="radio" name="is_top" value="0" checked>否</label>&nbsp;&nbsp;
    <label><input type="radio" name="is_top" value="1">是</label>
    </div>
</div> -->


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