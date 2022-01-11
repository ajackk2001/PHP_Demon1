<?php

include_once 'common.inc.php';

$subPage = "welcome.php";
if (isset($_GET['do'])) {
    if (isset($_GET['type'])) {
        if (isset($_GET['cn'])) {
            $subPage = $_GET['do'] . '.php';
        } else {
            $subPage = $_GET['type'] . '/' . $_GET['do'] . '.php';
        }
    } else {
        $subPage = $_GET['do'] . '.php';
    }
}

?>
<?php include 'includes/head.php'; ?>


        <link rel="stylesheet" href="assets/plugins/morris/morris.css">

<?php include 'includes/css.php'; ?>
<?php include 'includes/script.php'; ?>
    <body>

        <!-- Begin page -->
        <div id="wrapper">


<?php
    include 'includes/topbar.php';
    include 'includes/sidebar.php';
?>


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Dashboard</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">
                                            Welcome to Lexa Dashboard
                                        </li>
                                    </ol>
                                    
                                </div>
                            </div>
                        </div> -->
						<?php
                        if ($subPage) {
                            include $subPage;
                        }
                        ?>
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

<?php include 'includes/footer.php'; ?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
            



        <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!--Morris Chart-->
        <!-- <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>
        <script src="assets/pages/dashboard.js"></script> -->

<?php include 'includes/script-bottom.php'; ?>
<script>
<?php

if (isset($altmsg) && ($altmsg || $altmsg = $_GET['altmsg'])) {?>
alert('<?php echo $altmsg;?>');


top.location.href='<?=$postBackPage ? $postBackPage : $_SERVER['REQUEST_URI']?>';
<?php

unset($altmsg);
}?>
<?php if (@$_SESSION['nowCn'] == $_GET['cn'] && isset($backPage) && $backPage > 0) {?>
// 單筆
top.location.href='<?php echo urlkill('do|id') . "&do=list&p=" . $backPage . $postBackPage;?>';
// 連續新增
// top.location.href='<?php echo urlkill('do|id') . "&do=info";?>';
<?php }?>
</script>
</body>

</html>