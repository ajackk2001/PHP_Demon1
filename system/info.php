<?php
$className = $_GET['cn'];
$classStr  = isset($_type[$className]['name']) ? $_type[$className]['name'] : "";
if (!$classStr) {
    $classStr = unescape($_COOKIE['admin_menu_name']);
}
$classStr = str_replace("資料", "", $classStr);
$class    = new $className;
if ($_POST) {
    if (isset($_GET['id'])) {
        $errmsg = $class->edit($_POST, $_GET['id']);
        if ($errmsg != "" && $errmsg != "1") {
            $altmsg = $errmsg;
        } else {
            $altmsg = '修改' . $classStr . '成功';
        }
        $backPage = $_SESSION["nowPage"];
    } else {
        $id = $class->add($_POST);
        // go(urlkill('altmsg').'&altmsg='.urlencode('新增'.$classStr.'成功'));
        if ($id) {
            $altmsg   = '新增' . $classStr . '成功';
            $backPage = $_SESSION["nowPage"];
        } else {
            $altmsg = '新增' . $classStr . '失敗';
        }
    }
    if ($_POST['back_page']) {
        $postBackPage = $_POST['back_page'];
    }
}
if (isset($_GET['id'])) {
    $info = $class->getInfo($_GET['id']);
} else {
    if ($class->permCheck && !permission::check($class->tableName, "a_tag")) {
        echo "<script>alert('對不起你沒有該操作的權限');</script>";
        exit;
    }
}
$sendBtn = "送出表單";
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title"><?php echo $_GET["id"] ? "修改" : "新增";?><?php echo $classStr ? $classStr . "資料" : "資料";?></h4>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
            <form method="post" onsubmit="return checkForm(this);" enctype="multipart/form-data" target="upload_iframe" action="" name="form">
            <?php if (isset($_GET['id'])) {?><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"><?php }?>
            <?php include $_GET['type'] . '/' . $className . '.form.php'?>
           
            <div class="form-group">
                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                <?php echo $sendBtn;?>
                </button>
            </div>
            </form>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- container-fluid -->


<?php if ($info) {?>
<script>
editFun(<?php echo jsonEncode($info)?>);
</script>
<?php }?>
