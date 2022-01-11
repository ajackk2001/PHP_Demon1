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
print_R($info);
?>
<form method="post" onsubmit="return checkForm(this);" name="form">
<?php if ($userid) {?><input type="hidden" name="id" value="<?php echo $userid?>"><?php }?>
 <br /><h1 class="title"><span>修改帳號資料</span></h1>
 <div>
  <table cellspacing="0" cellpadding="0" class="Admin_L">
    <tr>
      <th class="T_title" scope="col" width="100">帳號資料</th>
      <th class="T_title" scope="col">&nbsp;</th>
    </tr>
    <tr>
      <td class="N_title">帳號：</td><td class="N_title">
        <input type="text" name="login_name" value="<?php echo $uinfo['login_name']?>" autocomplete="off">
      </td>
    </tr>
    <tr>
      <td class="N_title">密碼：</td><td class="N_title">
        <input type="password" name="login_pass" value="" autocomplete="off">
      </td>
    </tr>
    <tr>
      <td class="N_title">確認密碼：</td><td class="N_title">
        <input type="password" name="password" value="" autocomplete="off">
      </td>
    </tr>
    <tr>
      <td class="N_title">真實姓名：</td><td class="N_title">
        <input type="text" name="real_name" value="<?php echo $uinfo['real_name']?>" autocomplete="off">
    </tr>
    <tr>
      <td class="N_title">群組：</td><td class="N_title">
		<select name="gpid">
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
      </td>
    </tr>
    <tr>
      <td class="N_title">電子信箱：</td><td class="N_title">
        <input type="text" name="email" value="<?php echo $uinfo['email']?>" size="50" autocomplete="off">
    </tr>
	<?php if ($uinfo['id']>99 || !$userid) {?>
	<tr>
	  <td class="N_title">是否啟用：</td><td class="N_title">
		<label><input type="radio" name="is_show" value="1" <?=(isset($uinfo['is_show']) && $uinfo['is_show'] != 0 ? 'checked' : '') ?>>是</label>&nbsp;&nbsp;
		<label><input type="radio" name="is_show" value="0" <?=($uinfo['is_show'] == 0 ? 'checked' : '') ?>>否</label>
	  </td>
	</tr>
	<?php }?>
    <tr class="Ls2">
      <td class="N_title"></td>
      <td class="N_title"><input class="sub2" type="submit" value="送出"></td>
    </tr>
  </table>
  </div>
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