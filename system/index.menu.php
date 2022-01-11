<?php 
// get_group_id_by_admin_id($_SESSION["ADMIN_ID"]);
echo createmenu(getMenuData($_SESSION["ADMIN_ID"]),"","admin");
?>
<div class="tree_menu">
<div width="100%"><img class="Outline" alt="" src="style/images/showtag_00.gif">&nbsp;<a href="login.php?out=yes"><?php echo (_WEB_ADMIN_LANG=="tw")?"登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;出":"Logout";?></a></div>
</div>