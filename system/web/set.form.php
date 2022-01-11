<tr>
  <td class="N_title">聯絡我們-信箱：</td><td class="N_title" colspan="7">
	<input type="text" name="contract_email" size="60" required>
  </td>
</tr>
<tr>
  <td class="N_title">聯絡我們-地址：</td><td class="N_title" colspan="7">
    <input type="text" name="contract_address" size="60" required>
  </td>
</tr>
<tr>
  <td class="N_title">聯絡我們-電話：</td><td class="N_title" colspan="7">
    <input type="text" name="contract_tel" size="60" required>
  </td>
</tr>
<tr>
  <td class="N_title">聯絡我們-敘述：</td><td class="N_title" colspan="7">
    <textarea name="contract_content" rows="15" cols="100" required></textarea>
  </td>
</tr>
<tr>
  <td class="N_title">ICON-電話：</td><td class="N_title" colspan="7">
    <textarea name="mobile" rows="15" cols="100" required></textarea>
  </td>
</tr>
<tr>
  <td class="N_title">ICON-LINE：</td><td class="N_title" colspan="7">
    <textarea name="line" rows="15" cols="100" required></textarea>
  </td>
</tr>
<tr>
  <td class="N_title">Logo：</td><td class="N_title" colspan="7">
    <input type="file" name="logo"> (319 x 42 像素)
	<?php
    if (is_file(ROOT_PATH . $info['web_logo'])) {
        echo '<div id="logo"><img src="' . ROOT_URL . $info['web_logo'] . '" width="300"></div>';
    }
    ?>
  </td>
</tr>
<!-- <tr>
  <td class="N_title">首頁Banner：</td><td class="N_title" colspan="7">
    <input type="file" name="banner"> (1862 x 490 像素)
	<?php
    if (is_file(ROOT_PATH . $info['index_banner'])) {
        echo '<div id="banner"><img src="' . ROOT_URL . $info['index_banner'] . '" width="300"></div>';
    }
    ?>
  </td>
</tr> -->
<script>
function checkForm(form){
	var ckField,msg='';
	
	if(msg){
		alert(msg);
		return false;
	}else{
	    return true;
	}
}
</script>
