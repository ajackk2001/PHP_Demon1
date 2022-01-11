<?php

if ($_SESSION['MEMBER_USER']['id'] != '') {
    echo "<script>location.href='index.php';</script>";
    exit;
} else {
    if ($_POST) {
        $class     = new member();
        $checkUser = $class->checkUserEmail($_POST);
        if ($checkUser['status'] == true) {
            $data['password'] = substr(md5(rand()), 0, 8);
            $update           = "update  _web_member set password ='" . md5($data['password']) . "' where username = '" . $_POST['username'] . "'";
            $webdb->query($update);
            $email_content = file_get_contents("mail/forgetpass.tpl.html");
            $email_content = str_replace('{password}', $data["password"], $email_content);
            $email_content = str_replace('{name}', $checkUser["name"], $email_content);
            $email_content = str_replace('{url}', ROOT_URL, $email_content);

            include_once 'conf/email.conf.php';
            $subject = WEB_NAME . ' - 忘記密碼'; //信件標題
            smtp_mail($_POST['username'], $subject, $email_content, $name);

            echo jsCtrl::Alert_Location('已經發送新密碼信件至您的註冊信箱', 'index.php');
            exit;
        } else {
            echo jsCtrl::Alert_Location('失敗，請重新嘗試一次', 'index.php');
            exit;
        }
    }
}

include 'block/head.php';
include 'block/header.php';
?>
	<!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="index.php">首頁</a></li>
								<li><a href="#" class="active">忘記密碼</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- breadcrumbs-area-end -->
		<!-- user-login-area-start -->
		<div class="user-login-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="login-title text-center mb-30">
							<h2>忘記密碼</h2>
							<p>如帳戶有任何問題請聯繫客服人員，如需註冊會員請點<a href="index.php?action=register">前往註冊</a></p>
						</div>
					</div>
					
					<div class="offset-lg-3 col-lg-6 col-md-12 col-12">
						<form class="" action="" method="post" id="form">
							<div class="login-form">
								<div class="single-login">
									<label>帳號（請輸入您註冊時的信箱）<span>*</span></label>
									<input type="text" name="username" />
								</div>
								<div class="single-login single-login-2">
									<a href="#" onclick="toForm();">送出</a>
									<!-- <input id="rememberme" type="checkbox" name="rememberme" value="forever">
									<span>Remember me</span> -->
								</div>
							
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</div>
		<script>
		function toForm(){
			$('#form').submit();
		}
		</script>
		<!-- user-login-area-end -->
		<?php

include 'block/footer.php';
?>
