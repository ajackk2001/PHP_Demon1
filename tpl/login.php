<?php

include 'block/head.php';
include 'block/header.php';
if ($_POST) {
    $member = new member();
    $login  = $member->login($_POST);

    if ($login) {
        echo jsCtrl::Alert_Location('登入成功', 'index.php?action=my-account');
        exit;
    } else {
        echo jsCtrl::Alert_Location('登入失敗', 'index.php?action=login');
        exit;
    }
}
if (isset($_SESSION['MEMBER_USER']['id'])) {
    echo jsCtrl::Location('index.php?action=my-account');
    exit;
}

?>
		<!-- breadcrumbs-area-start -->
		<div class="breadcrumbs-area mb-70">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumbs-menu">
							<ul>
								<li><a href="index.php">首頁</a></li>
								<li><a href="#" class="active">登入</a></li>
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
							<h2>登入</h2>
							<p>請登入您的帳號密碼，如帳戶有任何問題請聯繫客服人員，如需註冊會員請點<a href="index.php?action=register">前往註冊</a></p>
						</div>
					</div>
					
					<div class="offset-lg-3 col-lg-6 col-md-12 col-12">
						<form class="" action="" method="post" id="form">
							<div class="login-form">
								<div class="single-login">
									<label>帳號（請輸入您註冊時的信箱）<span>*</span></label>
									<input type="text" name="username" />
								</div>
								<div class="single-login">
									<label>密碼 <span>*</span></label>
									<input type="password"  name="password" />
								</div>
								<div class="single-login single-login-2">
									<a href="#" onclick="toForm();">登入</a>
									<!-- <input id="rememberme" type="checkbox" name="rememberme" value="forever">
									<span>Remember me</span> -->
								</div>
								<a href="index.php?action=forget_password">忘記密碼</a>
								
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