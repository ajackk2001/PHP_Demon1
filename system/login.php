<?php
$noLocation = true;
include_once 'common.inc.php';

@session_start();
$_SESSION['ADMIN_ID'] = "";
@session_destroy();
/*
 * 如果用戶有提交數據
 */
if (isset($_POST['username']) && isset($_POST['password'])) {
    $error = "";

    if (isset($_SESSION['authnum']) && $_SESSION['authnum'] == $_POST['verifycode']) {
        /*
         * 加載用戶類
         */
        $userClass = new user();
        $reInt     = false;
        /*
         * 檢查用戶合法性
         */
        $reInt = $userClass->check($_POST['username'], $_POST['password']);

        if ($reInt > 0) {
            header("Location: index.php");
        } else {
            switch ($reInt) {
                case -1: $error = '帳號錯誤';
                break;
                case -2: $error = '密碼錯誤';
                break;
                case -3: $error = '沒有登入權限';
                break;
            }
            $_SESSION['ADMIN_ID'] = "";
            @session_destroy();
        }
    } else {
        $error = '驗證碼錯誤';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php echo _WEB_SITE_NAME ? _WEB_SITE_NAME . ' ' : '';?>後台登入</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <!-- Begin page -->
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <!-- <h3 class="text-center m-0">
                        <a href="index.html" class="logo logo-admin"><img src="assets/images/logo.png" height="30" alt="logo"></a>
                    </h3> -->

                    <div class="p-3">
						<h4 class="text-muted font-18 m-b-5 text-center"><?php echo _WEB_SITE_NAME ? _WEB_SITE_NAME . ' ' : '';?>後台登入</h4>
						<p></p>
                        <p class="text-center" style="color:red;"><?php echo isset($error) ? $error : "";?></p>

                        <form class="form-horizontal m-t-30" method="post" action="">

                            <div class="form-group">
                                <label for="username">帳號</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="帳號">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">密碼</label>
                                <input type="password" name="password" class="form-control" id="userpassword" placeholder="密碼">
							</div>

							<div class="form-group">
                                <label for="userpassword">驗證碼</label>
								<input name="verifycode" id="verifycode" class="form-control" type="text" placeholder="驗證碼/Verify Code" autocomplete="off"/>
								
							</div>
							<div class="form-group">
                               
								<img src="code.php" height="25" id="rand-img" alt="驗證碼" title="驗證碼" />
                            </div>
						
                            <div class="form-group row m-t-20">
                                <div class="col-6">
                                    <!-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Remember me</label>
                                    </div> -->
                                </div>
                                <div class="col-6 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">登入</button>
                                </div>
                            </div>

                          
                        </form>
                    </div>

                </div>
            </div>


        </div>
        

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.min.js"></script>

        <script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>