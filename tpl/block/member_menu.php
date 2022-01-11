<div class="col-lg-3 col-md-4">
    <div class="myaccount-tab-menu nav" role="tablist">
        <a href="index.php?action=my-account" <?=($_GET['action'] == 'my-account' ? 'class="active"' : '')?>><i class="fa fa-dashboard"></i>
            會員中心</a>
        <a href="index.php?action=member_order"  <?=($_GET['action'] == 'member_order' ? 'class="active"' : '')?>><i class="fa fa-cart-arrow-down"></i>
            訂單資料</a>
        <a href="index.php?action=member_edit"  <?=($_GET['action'] == 'member_edit' ? 'class="active"' : '')?>><i class="fa fa-user"></i> 修改個人資料</a>
        <a href="index.php?action=logout"><i class="fa fa-sign-out"></i> 登出</a>
    </div>
</div>