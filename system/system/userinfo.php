<?php
if ($_POST) {
    $admin=new admin();
    // if($_POST['login_pass']) $_POST['login_pass']=md5($_POST['login_pass']);
    // else unset($_POST['login_pass']);
    if ($_POST['id']) {
        $id=$_POST['id'];
        $altmsg=$admin->edit($_POST, $id);
    // $admin->editData($_POST,$_POST['id']);
        // $altmsg='修改帳號成功';
    } else {
        $id=$admin->add($_POST);
        if ($id) {
            $altmsg='增加帳號成功';
        } else {
            $altmsg='登入帳號重覆';
        }
        // $admin->addData($_POST);
        // go(urlkill('altmsg').'&altmsg='.urlencode('增加帳號成功'));
    }
   
    go(urlkill('altmsg').'&altmsg='.urlencode($altmsg));
    exit;
}
!$userid && $userid=$_GET['id'];
if ($userid) {
    $admin=new admin();
    $uinfo=$admin->getInfo($userid);
}

?>
<form method="post" onsubmit="return checkForm(this);" name="form">
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">帳號資料</h4>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
						<?php if ($userid) {?><input type="hidden" name="id" value="<?php echo $userid?>"><?php }?>
            <div class="form-group row">
              <label for="example-search-input" class="col-sm-2 col-form-label">帳號</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="login_name" value="<?php echo $uinfo['login_name']?>" autocomplete="off">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-search-input" class="col-sm-2 col-form-label">密碼</label>
              <div class="col-sm-10">
                <input class="form-control" type="password" name="login_pass" value="" autocomplete="off">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-search-input" class="col-sm-2 col-form-label">確認密碼</label>
              <div class="col-sm-10">
                <input class="form-control" type="password" name="password" value="" autocomplete="off">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-search-input" class="col-sm-2 col-form-label">真實姓名</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="real_name" value="<?php echo $uinfo['real_name']?>" autocomplete="off">
              </div>
            </div>
              
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">群組</label>
              <div class="col-sm-10">
              <select name="gpid" class="form-control">
                <?php
                    $group=new group();
                    $group->setLimit(0, 1000);
                    $group=$group->getArray();
                    foreach ($group as $g) {
                        $selected=($g['id']==$uinfo['gpid'])?'selected':'';
                        echo '<option '.$selected.' value="'.$g['id'].'">'.$g['name'].'</option>';
                    }
                    ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">信箱</label>
              <div class="col-sm-10">
                <input class="form-control" name="email" type="text" value="<?php echo $uinfo['email']?>">
              </div>
            </div>
            <?php if ($uinfo['id']>99 || !$userid) {?>
            <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label">是否啟用</label>
                <div class="col-sm-10">
                <label><input type="radio" name="is_show" value="1" <?=(isset($uinfo['is_show']) && $uinfo['is_show'] != 0 ? 'checked' : '') ?>>是</label>&nbsp;&nbsp;
                <label><input type="radio" name="is_show" value="0" <?=($uinfo['is_show'] == 0 ? 'checked' : '') ?>>否</label>
                </div>
            </div>
            <?php
            }
            ?>
        
            <div class="form-group">
                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                <button type="submit" class="btn btn-primary waves-effect waves-light">送出</button>
            </div>
           
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- container-fluid -->
</form>

<script>
$(function() {

});
function checkForm(form){
	var msg='';
	if(form.login_name.value=='') msg+='請輸入該用戶的登錄名\r\n';
	if(form.real_name.value=='') msg+='請輸入該用戶的真實姓名\r\n';
	<?php if (!$userid) {?>if(form.login_pass.value=='') msg+='請輸入該用戶的密碼\r\n';<?php }?>
	if(form.login_pass.value!=form.password.value) msg+='兩次輸入的密碼需要一致\r\n';
	if(msg){
		alert(msg);
		return false;
	}else return true;
}
</script>